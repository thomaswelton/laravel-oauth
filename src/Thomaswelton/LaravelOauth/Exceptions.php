<?php namespace Thomaswelton\LaravelOauth;

use Exception as BaseException;

class Exception extends BaseException{}
class UserDeniedException extends Exception{}
class ServiceNotSupportedException extends Exception{}
class InvalidArgumentException extends Exception{}
class NotLoggedInException extends Exception{}
