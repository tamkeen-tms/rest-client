<?php namespace Tamkeen\Exceptions;

	use GuzzleHttp\Exception\ClientException;

	/**
	 * @package Tamkeen\ApiClient\Exceptions
	 */
	class RequestException extends \Exception{
		/**
		 * RequestException constructor.
		 *
		 * @param \GuzzleHttp\Exception\ClientException $exception
		 */
		public function __construct(ClientException $exception){
			$this->message = $exception->getMessage();
			$this->file = $exception->getFile();
			$this->line = $exception->getLine();
		}
	}