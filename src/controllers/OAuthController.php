<?php namespace Thomaswelton\LaravelOauth;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\Controller;

class OAuthController extends Controller {

	public function missingMethod($parameters)
	{
		$oauth = App::make('oauth');
	    $provider = $parameters[0];

	    $redirect = $oauth->getRedirectFromState($provider);

	    try{
	    	$oauth->requestAccessToken($provider);
	    }catch(ServiceNotSupportedException $e){
	    	$errors = new MessageBag(
	    		array("oauth_error" => 'Unknown OAuth Error')
	    	);
	    	return Redirect::to('/')->withErrors($errors);
	    }catch(UserDeniedException $e){
	    	$errors = new MessageBag(
	    		array("oauth_error_{$provider}" => 'User Denied')
	    	);
	    	return Redirect::to($redirect)->withErrors($errors);
	    }catch(Exception $e){
	    	$errors = new MessageBag(
	    		array("oauth_error_{$provider}" => $e->getMessage())
	    	);
	    	return Redirect::to($redirect)->withErrors($errors);
	    }

	    return Redirect::to($redirect);
	}

	public function login($provider){
		$oauth = App::make('oauth');
		$redirect = Input::get('redirect');
		$scope = Input::get('scope');

		$authUrl = $oauth->getAuthorizationUri($provider, $redirect, $scope);

		return Redirect::to(htmlspecialchars_decode($authUrl));
	}


}
