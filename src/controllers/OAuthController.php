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
            $token = $this->oauth->requestAccessToken($provider);

            if (property_exists($state, 'login')) {
                $uid = $this->oauth->user($provider)->getUID();

                $modelName = "Thomaswelton\\LaravelOauth\\Eloquent\\Oauth";
                $model = new $modelName();

                $user = $model->where('oauth_uid', '=', $uid)->where->('provider', '=', $provider)->firstOrFail();
                Auth::loginUsingId($user->user_id);
            }

            if (property_exists($state, 'associate')) {
                if (Auth::check()){
                    $uid = $this->oauth->user($provider)->getUID();

                    $providerClass = ucfirst($provider);

                    $user = Auth::user();

                    // Check for an existing relation
                    if(is_object($user->$providerClass)){
                        $model = $user->$providerClass;
                    }else{
                        $modelName = "Thomaswelton\\LaravelOauth\\Eloquent\\Oauth";
                        $model = new $modelName();
                    }

                    $model->oauth_uid = $uid;
                    $model->access_token = $token->getAccessToken();
                    $model->expire_time = $token->getEndOfLife();
                    $model->provider = $provider;
                    $user->$provider()->save($model);
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
            'associate' => Input::get('associate')
        );

        $authUrl = $this->oauth->getAuthorizationUri($provider, $scope, $state);

        return Redirect::to(htmlspecialchars_decode($authUrl));
    }

    public function destroy($provider)
    {
        $redirect = Input::get('redirect');

        if (Auth::check()){
            $user = Auth::user();
            $user->$provider()->delete();
        }else{
            $errors = new MessageBag(
                array("oauth_error" => 'User unlink failed. User not logged in')
            );

            return Redirect::to($redirect)->with('errors', $errors);
        }

        return Redirect::to($redirect);
    }

}
