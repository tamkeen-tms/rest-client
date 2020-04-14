<?php namespace Tamkeen;

    /**
     * @package Tamkeen
     */
    class Client
    {
        /**
         * The API base url
         * @var string
         */
        private $baseUrl;

        /**
         * @var string
         */
        private $apiKey;

        /**
         * The API's version
         * @var int
         */
        private $apiVersion = 1;

        /**
         * @var array
         */
        private $requestOptions = [];

        /**
         * The default locale for the data fetched by the Api
         * @var string
         */
        private $defaultLocale = 'en';

        /**
         * Client constructor.
         * @param null $baseUrl
         * @param null $key
         * @param array $options
         */
        public function __construct($baseUrl = null, $key = null, array $options = [])
        {
            if($baseUrl){
                $this->setBaseUrl($baseUrl);
            }

            if($key){
                $this->setApiKey($key);
            }

            // The default request options
            $this->setRequestsOptions($options);
        }

        /**
         * @param $url
         *
         * @return $this
         */
        public function setBaseUrl($url)
        {
            $this->baseUrl = rtrim($url, '/') . '/';

            return $this;
        }

        /**
         * @param $key
         *
         * @return $this
         */
        public function setApiKey($key)
        {
            $this->apiKey = $key;

            return $this;
        }

        /**
         * @param array $options
         * @return $this
         */
        public function setRequestsOptions(array $options)
        {
            $this->requestOptions = $options;

            return $this;
        }

        /**
         * @return array
         */
        public function getRequestOptions()
        {
            return $this->requestOptions;
        }

        /**
         * Set the API version
         * @param $version
         *
         * @return $this
         */
        public function setApiVersion($version)
        {
            $this->apiVersion = $version;

            return $this;
        }

        /**
         * @return string
         */
        public function getBaseUrl()
        {
            return $this->baseUrl;
        }

        /**
         * @return string
         */
        public function getApiKey()
        {
            return $this->apiKey;
        }

        /**
         * @return int
         */
        public function getApiVersion()
        {
            return $this->apiVersion;
        }

        /**
         * Sets the default locale
         * @param $locale
         * @return $this
         */
        public function setDefaultLocale($locale)
        {
            $this->defaultLocale = $locale;

            return $this;
        }

        /**
         * The default locale
         * @return string
         */
        public function getDefaultLocale()
        {
            return $this->defaultLocale;
        }

        /**
         * Creates a new request
         * @param $method
         * @param $path
         * @param $query
         * @param $data
         * @param $options
         *
         * @return Request
         */
        public function request($method, $path, array $query = [], array $data = [], array $options = [])
        {
            return new Request($this, $method, $path, $query, $data, $options);
        }
    }