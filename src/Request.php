<?php namespace Tamkeen;

use GuzzleHttp\Exception\RequestException;

/**
     * @package Tamkeen\ApiClient
     */
    class Request
    {
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
         * @param Client $client The Api client this request will be executed through
         * @param                           $method string The method e.g GET, POST, PUT, ...
         * @param                           $path string url endpoint path
         * @param array $query [optional] The url query string params
         * @param array $data [optional] Any data to pass along with the request
         * @param array $options [optional] Options for the GuzzleHttp client
         */
        public function __construct(Client $client, $method, $path, array $query = [], array $data = [], array $options = [])
        {
            $this->client = $client;
            $this->method = strtoupper($method);
            $this->path = $path;
            $this->query = $query;
            $this->data = $data;
            $this->options = $options;

            // Set the default locale
            $this->setLocale($this->client->getDefaultLocale());
        }

        /**
         * Sets the POST data
         * @param array $data
         *
         * @return $this
         */
        public function setData(array $data)
        {
            $this->data = $data;

            return $this;
        }

        /**
         * @param array $params
         *
         * @return $this
         */
        public function setQuery(array $params)
        {
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
        public function setQueryParam($key, $value)
        {
            $this->query[$key] = $value;

            return $this;
        }

        /**
         * Sets the locale of the response
         * @param $locale
         *
         * @return $this
         */
        public function setLocale($locale)
        {
            $this->setQueryParam('locale', $locale);

            return $this;
        }

        /**
         * Passes the id of the branch meant to be sent along with the request
         * @param $branchId
         *
         * @return $this
         */
        public function setBranch($branchId)
        {
            $this->setQueryParam('branch', $branchId);

            return $this;
        }

        /**
         * @param array $options
         *
         * @return $this
         */
        public function setOptions(array $options = [])
        {
            $this->options = $options;

            return $this;
        }

        /**
         * @param $option
         * @param $value
         *
         * @return $this
         */
        public function setOption($option, $value)
        {
            $this->options[$option] = $value;

            return $this;
        }

        /**
         * Sends the request to the API server
         * @return mixed
         * @throws \Exception
         */
        public function send()
        {
            try {
                // The client
                $request = new \GuzzleHttp\Client([
                    'base_uri' => $this->client->getBaseUrl()
                ]);

                // Options
                $options = array_merge($this->client->getRequestOptions(), $this->options, [
                    'query' => $this->query,
                    'form_params' => $this->data,
                    'headers' => [
                        'X-Tenant' => $this->client->getTenant(),
                        'Authorization' => "Bearer " . $this->client->getKey()
                    ]
                ]);

                // Send the request
                $response = $request->request($this->method, 'api/v' . $this->client->getVersion() . '/' . $this->path, $options);

                // Decode the response
                $responseBody = @json_decode((string) $response->getBody());

                // If the response isn't json
                if(json_last_error() !== JSON_ERROR_NONE){
                    throw new \Exception('api_error');
                }

                return $responseBody;

            } catch (\Exception $e) {
                // Guzzle Request Exception?
                if($e instanceof RequestException && $e->getResponse() !== null){
                    // Decode the error
                    $response = @json_decode( (string) $e->getResponse()->getBody(), true );

                    if(isset($response['error'])){
                        throw new \Exception($response['error']);
                    }
                }

                throw $e;
            }
        }
    }