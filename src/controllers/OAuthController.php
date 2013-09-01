<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \URL;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\Controller;

class OAuthController extends Controller
{
    public function index($provider)
    {
        $oauth = App::make('oauth');

        $state = $oauth->getState($provider);

        $redirect = (property_exists($state, 'redirect')) ? $state->redirect : null;

        try {
            $oauth->requestAccessToken($provider);
        } catch (ServiceNotSupportedException $e) {
            $errors = new MessageBag(
                array("oauth_error" => 'Unknown OAuth Error')
            );

            return Redirect::to($redirect)->withErrors($errors);
        } catch (UserDeniedException $e) {
            $errors = new MessageBag(
                array("oauth_error_{$provider}" => 'User Denied')
            );

            return Redirect::to($redirect)->withErrors($errors);
        } catch (Exception $e) {
            $errors = new MessageBag(
                array("oauth_error_{$provider}" => $e->getMessage())
            );

            return Redirect::to($redirect)->withErrors($errors);
        }

        if (property_exists($state, 'login')) {
            $routePrefix = Config::get('laravel-oauth::route');

            $loginUrl = new \Purl\Url(URL::to("{$routePrefix}/{$provider}/login"));
            $loginUrl->query->set('redirect', $redirect);

            return Redirect::to($loginUrl->getUrl());
        }

        return Redirect::to($redirect);
    }

    public function authorize($provider)
    {
        $oauth = App::make('oauth');
        $scope = Input::get('scope');

        $state = array(
            'redirect' => Input::get('redirect'),
            'login' => Input::get('login')
        );

        $authUrl = $oauth->getAuthorizationUri($provider, $scope, $state);

        return Redirect::to(htmlspecialchars_decode($authUrl));
    }

    public function login($provider)
    {
        throw new \Exception('No login route defined in routes.php');
    }

}
