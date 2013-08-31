<?php namespace Thomaswelton\LaravelOauth\Common\Storage;

use \Session;
use OAuth\Common\Token\TokenInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use OAuth\Common\Storage\Exception\TokenNotFoundException;

class LaravelSession implements TokenStorageInterface
{
    private $sessionVariableName;

    public function __construct($sessionVariableName = 'lusitanian_oauth_token')
    {
        $this->sessionVariableName = $sessionVariableName;

        if (!Session::has($sessionVariableName)) {
            Session::set($sessionVariableName, array());
        }
    }

    /**
     * @return \OAuth\Common\Token\TokenInterface
     * @throws TokenNotFoundException
     */
    public function retrieveAccessToken($service)
    {
        if ($this->hasAccessToken($service)) {
            // get from session
            $tokens = Session::get($this->sessionVariableName);

            // one item
            return $tokens[$service];
        }

        throw new TokenNotFoundException('Token not found in session, are you sure you stored it?');
    }

    public function storeAccessToken($service, TokenInterface $token)
    {
        // get previously saved tokens
        $tokens = Session::get($this->sessionVariableName);

        if (is_array($tokens)) {
            // add to array
            $tokens[$service] = $token;
        } else {
            // new array
            $tokens = array(
                $service => $token,
            );
        }

        // save
        Session::set($this->sessionVariableName, $tokens);

        // allow chaining
        return $this;
    }

    /**
    * @return bool
    */
    public function hasAccessToken($service)
    {
        // get from session
        $tokens = Session::get($this->sessionVariableName);

        return is_array($tokens) &&
               isset($tokens[$service]) &&
               $tokens[$service] instanceof TokenInterface;
    }

    /**
     * Delete the user's token. Aka, log out.
     */
    public function clearToken($service)
    {
        // get previously saved tokens
        $tokens = Session::get($this->sessionVariableName);

        if (array_key_exists($service, $tokens)) {
            unset($tokens[$service]);
        }

        // Replace the stored tokens array
        Session::set($this->sessionVariableName, $tokens);

        // allow chaining
        return $this;
    }

    /**
     * Delete *ALL* user tokens. Use with care. Most of the time you will likely
     * want to use clearToken() instead.
     */
    public function clearAllTokens()
    {
        Session::remove($this->sessionVariableName);

        // allow chaining
        return $this;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return App::make('Session');
    }
}
