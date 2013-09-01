<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \Input;
use \Str;
use \URL;
use \Session;

use OAuth\ServiceFactory;
use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Http\Exception\TokenResponseException;

class OAuth extends ServiceFactory
{
    /**
     * Get an OAuthLoginUrl for a given provider
     * @param  string        $provider Provider name
     * @param  string        $redirect url to redirect to after login
     * @return OAuthLoginUrl
     */
    public function authorize($provider)
    {
        return new OAuthLoginUrl($provider);
    }

    public function login($provider)
    {
        return $this->authorize($provider)->login();
    }

    public function associate($provider){
        return $this->authorize($provider)->associate();
    }

    /**
     * @return \OAuth\Common\Token\TokenInterface
     * @throws TokenNotFoundException
     */
    public function token($provider)
    {
        $service = $this->getServiceFactory($provider);
        $serviceName = $service->service();

        return $service->getStorage()->retrieveAccessToken($serviceName);
    }

    public function hasToken($provider)
    {
        $service = $this->getServiceFactory($provider);
        $serviceName = $service->service();

        return $service->getStorage()->hasAccessToken($serviceName);
    }

    public function user($provider)
    {
        $service = $this->getServiceFactory($provider);
        $serviceName = $service->service();
        $className = "Thomaswelton\\LaravelOauth\\Common\\User\\$serviceName";

        $service = $this->getServiceFactory($provider);

        return new $className($service);
    }

    public function getAuthorizationUri($service, $scope, array $state = array())
    {
        $factory = $this->getServiceFactory($service, $scope);

        $encodedState = $this->encodeState($state);

        if ($this->isOAuth2($service)) {
            $authUriArray = array('state' => $encodedState);
        } else {
            $token = $factory->requestRequestToken();
            $requestToken = $token->getRequestToken();

            // No state in OAuth 1.0
            // Handles custom redirects by setting the redirect in a session
            $this->setOAuth1State($token->getRequestToken(), $encodedState);

            $authUriArray = array( 'oauth_token' => $requestToken);
        }

        $authUrl = $factory->getAuthorizationUri($authUriArray);

        return htmlspecialchars_decode($authUrl);
    }

    public function getServiceFactory($service, $scope = null)
    {
        if (!$this->serviceExists($service)) {
            throw  new ServiceNotSupportedException( Str::studly($service) . ' is not a supported OAuth1 or OAuth2 service provider');
        }

        $credentials = $this->getCredentials($service);
        $scopes 	 = (!is_null($scope)) ? array_map("trim", explode(',', $scope)) : array_values( $this->getScopes($service) );

        $storage 	 = $this->getStorage();

        if ($this->isOAuth2($service)) {
            return $this->createService($service, $credentials, $storage, $scopes);
        } else {
            return $this->createService($service, $credentials, $storage);
        }
    }

    public function getCredentials($service)
    {
        return new Credentials(
            Config::get("laravel-oauth::{$service}.key"),
            Config::get("laravel-oauth::{$service}.secret"),
            url("oauth/{$service}")
        );
    }

    public function getScopes($service)
    {
        $array = explode(',', Config::get("laravel-oauth::{$service}.scope"));

        return array_map("trim", $array);
    }

    public function getStorage()
    {
        // LaravelSession implements TokenStorageInterface
        return new Common\Storage\LaravelSession();
    }

    public function serviceExists($service)
    {
        return ($this->isOAuth2($service) || $this->isOAuth1($service));
    }

    public function isOAuth2($service)
    {
        $serviceName = ucfirst($service);
        $className = "\\OAuth\\OAuth2\\Service\\$serviceName";

        return class_exists($className);
    }

    public function isOAuth1($service)
    {
        $serviceName = ucfirst($service);
        $className = "\\OAuth\\OAuth1\\Service\\$serviceName";

        return class_exists($className);
    }

    public function encodeState($state)
    {
        // remove all keys with empty values
        $state = array_filter($state, function($var){
            return (!is_null($var));
        });

        return base64_encode(json_encode($state));
    }

    public function decodeState($state)
    {
        return json_decode(base64_decode($state));
    }

    public function getState($provider)
    {
        if ($this->isOAuth2($provider)) {
            $state = Input::get('state');
        } else {
            $service = $this->getServiceFactory($provider);

            $namespace  = $this->getStorageNamespace($service);
            $token      = $this->getStorage()->retrieveAccessToken($namespace);

            $state = $this->getOAuth1State($token->getRequestToken());
        }

        return (object) $this->decodeState($state);
    }

    public function setOAuth1State($requestToken, $state)
    {
        Session::put($requestToken . '_state', $state);
    }

    public function getOAuth1State($requestToken)
    {
        return Session::get($requestToken . '_state');
    }

    public function getStorageNamespace($service)
    {
        // get class name without backslashes
        $classname = get_class($service);

        return preg_replace('/^.*\\\\/', '', $classname);
    }

    public function requestAccessToken($provider)
    {
        $service = $this->getServiceFactory($provider);

        if ($this->isOAuth2($provider)) {
            // error required by OAuth 2.0 error_description optional
            $error = Input::get('error');

            if ($error) {
                $errorDescription = Input::get('error_description');
                $errorMessage = ($errorDescription) ? $errorDescription : $error;

                if ($error == 'access_denied') {
                    throw new UserDeniedException($errorMessage, 1);
                } else {
                    throw new Exception($errorMessage, 1);
                }
            }

            try {
                return $service->requestAccessToken(Input::get('code'));
            } catch (TokenResponseException $e) {
                throw new Exception($e->getMessage(), 1);
            }
        } else {
            if (Input::get('denied') || Input::get('oauth_token') == 'denied') {
                throw new UserDeniedException('User Denied OAuth Permissions', 1);
            }

            if (!Input::get('oauth_token')) {
                throw new Exception("OAuth token not found", 1);
            }

            $namespace 	= $this->getStorageNamespace($service);
            $token 		= $this->getStorage()->retrieveAccessToken($namespace);

            try {
                return $service->requestAccessToken( Input::get('oauth_token'), Input::get('oauth_verifier'), $token->getRequestTokenSecret() );
            } catch (TokenResponseException $e) {
                throw new Exception($e->getMessage(), 1);
            }
        }
    }
}
