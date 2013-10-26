<?php namespace Thomaswelton\LaravelOauth;

use \Config;
use \URL;
use \Auth;
use \Route;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class OAuthController extends Controller
{
    public function __construct(){
        $action = Route::currentRouteAction();
        $method = explode('@', $action)[1];

        if($method == 'authorize' || $method == 'destroy'){
            $this->beforeFilter('csrf');
        }

        $this->oauth = App::make('oauth');
    }

    public function index($provider)
    {
        $state = $this->oauth->getState($provider);

        $redirect = (property_exists($state, 'redirect')) ? $state->redirect : null;

        try {
            $token = $this->oauth->requestAccessToken($provider);

            if (property_exists($state, 'login')) {
                // Login user based on provider token
                $this->oauth->login($provider);
            }

            if (property_exists($state, 'link')) {
                if (Auth::check()){
                    //Link logged in user to provider
                    $this->oauth->link($provider);
                }else{
                    throw new NotLoggedInException("NOT_LOGGED_IN", 1);
                }
            }

            return Redirect::to($redirect);

        } catch (NotLoggedInException $e){
            $errors = new MessageBag(
                array("oauth_error" => 'User linking failed. Not logged in')
            );
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
            'login' => Input::get('login'),
            'link' => Input::get('link')
        );

        $authUrl = $this->oauth->getAuthorizationUri($provider, $scope, $state);

        return Redirect::to(htmlspecialchars_decode($authUrl));
    }

    public function destroy($provider)
    {
        $redirect = Input::get('redirect');

        if (Auth::check()){
            $user = Auth::user();

            $model = $this->oauth->getEloquentModel($provider);

            $relation = $model->where('user_id', '=', $user->id)->first();
            if($relation){
                $relation->delete();
            }
        }else{
            $errors = new MessageBag(
                array("oauth_error" => 'User unlink failed. User not logged in')
            );

            return Redirect::to($redirect)->with('errors', $errors);
        }

        return Redirect::to($redirect);
    }

}
