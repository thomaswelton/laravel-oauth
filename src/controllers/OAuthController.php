<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \URL;
use \Auth;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Thomaswelton\LaravelOauth\OAuthUser;

class OAuthController extends Controller
{
    public function __construct(){
        $this->oauth = App::make('oauth');
    }

    public function index($provider)
    {
        $state = $this->oauth->getState($provider);

        $redirect = (property_exists($state, 'redirect')) ? $state->redirect : null;

        try {
            $this->oauth->requestAccessToken($provider);

            if (property_exists($state, 'login')) {
                $uid = $this->oauth->user($provider)->getUID();

                $user = OAuthUser::where($provider . '_uid', '=', $uid)->firstOrFail();
                Auth::loginUsingId($user->user_id);
            }

            return Redirect::to($redirect);

        } catch (ModelNotFoundException $e){
            $errors = new MessageBag(
                array("oauth_error" => 'Login Failed: No User found')
            );
        } catch (ServiceNotSupportedException $e) {
            $errors = new MessageBag(
                array("oauth_error" => 'Unknown OAuth Error')
            );
        } catch (UserDeniedException $e) {
            $errors = new MessageBag(
                array("oauth_error_{$provider}" => 'User Denied')
            );
        } catch (Exception $e) {
            $errors = new MessageBag(
                array("oauth_error_{$provider}" => $e->getMessage())
            );
        }

        return Redirect::to($redirect)->withErrors($errors);
    }

    public function authorize($provider)
    {
        $scope = Input::get('scope');

        $state = array(
            'redirect' => Input::get('redirect'),
            'login' => Input::get('login')
        );

        $authUrl = $this->oauth->getAuthorizationUri($provider, $scope, $state);

        return Redirect::to(htmlspecialchars_decode($authUrl));
    }

}
