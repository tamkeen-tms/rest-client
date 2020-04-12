<?php namespace Tamkeen\Exceptions;

    /**
     * Class RequestException
     * @package Tamkeen\Exceptions
     */
    class RequestException extends \Exception
    {
        /**
         * Error creating/sending the request
         */
        const EXCEPTION_REQUEST_ERROR = 'request_error';
        /**
         * The API is not currently active
         */
        const EXCEPTION_API_NOT_ACTIVE = 'api_not_active';
        /**
         * Authentication failed. The key is not valid.
         */
        const EXCEPTION_AUTH_FAILED = 'auth_failed';
        /**
         * The requests limit reached
         */
        const EXCEPTION_LIMIT_REACHED = 'limit_reached';
        /**
         * Page was not found (400)
         */
        const EXCEPTION_INVALID_PATH = 'invalid_path';
        /**
         * An error happened at the API's end (500)
         */
        const EXCEPTION_API_ERROR = 'api_error';
    }