<?php namespace Tamkeen;

	/**
	 * @package Tamkeen
	 */
	class Client{
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
		 */
		public function __construct(){}

		/**
		 * @param $url
		 *
		 * @return $this
		 */
		public function setBaseUrl($url){
			$this->baseUrl = rtrim($url, '/') . '/';

			return $this;
		}

		/**
		 * @param $key
		 *
		 * @return $this
		 */
		public function setApiKey($key){
			$this->apiKey = $key;

			return $this;
		}

		/**
		 * Set the API version
		 * @param $version
		 *
		 * @return $this
		 */
		public function setApiVersion($version){
			$this->apiVersion = $version;

			return $this;
		}

		/**
		 * @return string
		 */
		public function getBaseUrl(){
			return $this->baseUrl;
		}

		/**
		 * @return string
		 */
		public function getApiKey(){
			return $this->apiKey;
		}

		/**
		 * @return int
		 */
		public function getApiVersion(){
			return $this->apiVersion;
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
		public function request($method, $path, array $query = [], array $data = [], array $options = []){
			return new Request($this, $method, $path, $query, $data, $options);
		}
	}