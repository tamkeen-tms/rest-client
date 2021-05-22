<?php namespace Tamkeen;

    /**
     * @package Tamkeen
     */
    class Client
    {
        /**
         * The tenant's id
         * @var string
         */
        public $tenant;

        /**
         * Auth secret key. Available at Administration / API.
         * @var string
         */
        private $key;

        /**
         * The API's version
         * @var int
         */
        protected $version = 1;

        /**
         * The API base url to Tamkeen API
         */
        public $baseUrl = 'https://tamkeenapp.com/';

        /**
         * @var array
         */
        protected $requestOptions = [];

        /**
         * The default locale for the data fetched by the Api
         * @var string
         */
        public $defaultLocale = 'en';

        /**
         * @param null $tenant
         * @param null $key
         * @param array $options
         */
        public function __construct($tenant, $key = null, array $options = [])
        {
            // Set the tenant's id
            $this->setTenant($tenant);

            if($key){
                $this->setKey($key);
            }

            // The default request options
            $this->setRequestsOptions($options);
        }

	    /**
         * @param $baseUrl
         *
         * @return $this
         */
        public function setBaseUrl($baseUrl){
            $this->baseUrl = $baseUrl;

            return $this;
        }

	    /**
         * @return string
         */
        public function getBaseUrl(){
            return $this->baseUrl;
        }

        /**
         * @param $tenant
         *
         * @return $this
         */
        public function setTenant($tenant)
        {
            $this->tenant = $tenant;

            return $this;
        }

        /**
         * @return string
         */
        public function getTenant()
        {
            return $this->tenant;
        }

        /**
         * @param $key
         *
         * @return $this
         */
        public function setKey($key)
        {
            $this->key = $key;

            return $this;
        }

        /**
         * @return string
         */
        public function getKey()
        {
            return $this->key;
        }

        /**
         * Set the API version
         * @param $version
         *
         * @return $this
         */
        public function setVersion($version)
        {
            $this->version = $version;

            return $this;
        }

        /**
         * @return int
         */
        public function getVersion()
        {
            return $this->version;
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