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
        const EXCEPTION_API_DISABLED = 'api_disabled';
        /**
         * Authentication failed. The key is either missing or invalid
         */
        const EXCEPTION_MISSING_OR_INVALID_KEY = 'missing_or_invalid_key';
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