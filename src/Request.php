<?php namespace Tamkeen;

	use Tamkeen\Exceptions\ApiErrorException;
	use Tamkeen\Exceptions\InvalidPathException;
	use Tamkeen\Exceptions\LimitReachedException;
	use Tamkeen\Exceptions\RequestException;

	/**
	 * @package Tamkeen\ApiClient
	 */
	class Request{
		/**
		 * @var Client
		 */
		public $client;
		/**
		 * @var string
		 */
		public $method;
		/**
		 * @var string
		 */
		public $path;
		/**
		 * @var array
		 */
		public $query = [];
		/**
		 * @var array
		 */
		public $data = [];
		/**
		 * @var array
		 */
		public $options = [];

		/**
		 * @param Client                    $client The Api client this request will be executed through
		 * @param                           $method string The method e.g GET, POST, PUT, ...
		 * @param                           $path string url endpoint path
		 * @param array                     $query [optional] The url query string params
		 * @param array                     $data [optional] Any data to pass along with the request
		 * @param array                     $options [optional] Options for the GuzzleHttp client
		 */
		public function __construct(Client $client, $method, $path, array $query = [], array $data = [], array $options = []){
			$this->client = $client;
			$this->method = strtoupper($method);
			$this->path   = $path;
			$this->query  = $query;
			$this->data   = $data;
			$this->options= $options;
		}

		/**
		 * Sets the POST data
		 * @param array $data
		 *
		 * @return $this
		 */
		public function setData(array $data){
			$this->data = $data;

			return $this;
		}

		/**
		 * @param array $params
		 *
		 * @return $this
		 */
		public function setQuery(array $params){
			$this->query = $params;

			return $this;
		}

		/**
		 * Passes a URI query segment
		 * @param $key
		 * @param $value
		 *
		 * @return $this
		 */
		public function setQueryParam($key, $value){
			$this->query[$key] = $value;

			return $this;
		}

		/**
		 * Sets the locale of the response
		 * @param $locale
		 *
		 * @return $this
		 */
		public function setLocale($locale){
			$this->setQueryParam('locale', $locale);

			return $this;
		}

		/**
		 * Passes the id of the branch meant to be sent along with the request
		 * @param $branchId
		 *
		 * @return $this
		 */
		public function setBranch($branchId){
			$this->setQueryParam('branch', $branchId);

			return $this;
		}

		/**
		 * @param array $options
		 *
		 * @return $this
		 */
		public function setOptions(array $options = []){
			$this->options = $options;

			return $this;
		}

		/**
		 * @param $option
		 * @param $value
		 *
		 * @return $this
		 */
		public function setOption($option, $value){
			$this->options[$option] = $value;

			return $this;
		}

        /**
         * Sends the request to the API server
         * @return mixed
         * @throws ApiErrorException When there is an error in the API itself
         * @throws InvalidPathException When the path you specified was not found (404)
         * @throws LimitReachedException When the requests limit is reached
         * @throws RequestException When an error occurs with the request itself, mainly from the Guzzle library.
         */
        public function send(){
			try{
				// The client
				$request = new \GuzzleHttp\Client([
					'base_uri' => $this->client->getBaseUrl()
				]);

				// Add the API Key to the request
				$this->query['key'] = $this->client->getApiKey();

				// Options
				$options = array_merge([
					'verify'        => false,
					'query'         => $this->query,
					'form_params'   => $this->data

				], $this->options);

				// The url
				$path = 'api/v' . $this->client->getApiVersion() . '/' . $this->path;

				// Send the request
				$response = $request->request($this->method, $path, $options);

				// Decode the response
				$response = \GuzzleHttp\json_decode((string) $response->getBody());

				return $response;

			}catch (\GuzzleHttp\Exception\ClientException $exception){
				switch($exception->getResponse()->getStatusCode()){
					case 429:
						throw new LimitReachedException;
						break;

					case 404:
						throw new InvalidPathException;
						break;

					case 500:
						throw new ApiErrorException;
						break;
				}

				throw new RequestException($exception);
			}
		}
	}