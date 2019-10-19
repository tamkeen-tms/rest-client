# Tamkeen REST API Php client

## What is this?
This is the Php client for Tamkeen's REST API. You can use this in your Php applications to communicate with a copy of Tamkeen application. Before you start you need to acquire an API "key". Ask the system administrator for it, it can be found under Administration > API.

## Installation
You can require this library into your project using `composer`, using the following command:
```shell
composer install tamkeen/rest-client
```
Later you can use it in your project through the namespace `Tamkeen\Client`

## How it works
This library merely sends requests to Tamkeen's API endpoints. So, you need to know what endpoints are available and how to pick the correct one! A list of the endpoints are available on Tamkeen's website.

### Creating a client
Before sending requests you need to initiate a new "Client" instance, and pass it the API path and key. Through this client you will be able to make the requests. Each "Request" must be made through a "Client". You can instantiate multiple clients to make requests to multiple copies of the application! 
```php
$client = new Tamkeen\Client
	
$client->setBaseUrl( ... ) // Url to the Tamkeen copy
    ->setApiKey( ... ) // The API key
```

## Examples:
Here is an example for fetching the branches list:
```php
$request = $client->request('get', 'branches'); // Create the request
$response = $request->send(); // Send it, returns the response
```