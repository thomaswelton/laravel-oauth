<?php namespace Thomaswelton\LaravelOauth\Common\User;

use OAuth\Common\Service\ServiceInterface;

class AbstractUser implements UserInterface
{
    /**
     * API endpoint to get user data
     * @var string
     */
    protected $userEndpoint;

    /**
     * user data
     * @var object
     */
    protected $user;

    /**
     * Key name for the uid in the user object
     * @var string
     */
    protected $uidKey = 'id';

    public function __construct(ServiceInterface $service)
    {
        try {
            $response = $service->request($this->userEndpoint);
        } catch (\OAuth\Common\Storage\Exception\TokenNotFoundException $e) {
            throw $e;
        } catch (\OAuth\Common\Http\Exception\TokenResponseException $e) {
            throw $e;
        } catch (\OAuth\Common\Token\Exception\ExpiredTokenException $e) {
            throw $e;
        }

        $object = $this->decodeResponse($response);
        $this->user = $this->getUserResponse($object);
    }

    /**
     * Get the user data
     * @return object
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the unique ID for the user as defined
     * by the service provider
     * @return string
     */
    public function getUID()
    {
        $uidKey = $this->uidKey;

        return $this->user->$uidKey;
    }

    /**
     * Decode the API response
     * @param  string $response API response
     * @return object decoded response
     */
    protected function decodeResponse($response)
    {
        return json_decode($response);
    }

    /**
     * Get the user portion of the API respon
     * @param  object $response Decoded API resonse
     * @return object the user portion of the response
     */
    protected function getUserResponse($response)
    {
        return $response;
    }

}
