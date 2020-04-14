# Tamkeen REST API PHP client

## What is this?
This is the official PHP client for Tamkeen's REST API. You can use this in your PHP applications to communicate with Tamkeen. Before you start you need to acquire an API "key". Ask the system administrator for it, it can be found under Administration > API.

## Installation
You can require this library into your project using `composer`, using the following command:
```shell
composer install TamkeenLMS/rest-client
```
Later you can use it in your project through the namespace `Tamkeen`

## How it works
This library merely sends requests to Tamkeen's API endpoints. So, you need to know what endpoints are available and how to pick the correct one! A list of the endpoints are available on Tamkeen's website.

### Creating a client
Before sending requests you need to initiate a new "Client" instance, and pass it the API base url and key. Through this client you will be able to make the requests. Each "Request" must be made through a "Client". You can instantiate multiple clients to make requests to multiple copies of the application! 
```PHP
$client = new Tamkeen\Client // New client instance
	
$client->setBaseUrl( ... ) // Base url, to the Tamkeen url e.g https://example.com/
    ->setApiKey( ... ) // The API key
```
### Sending a request
Using the created client you can send new requests, for example:
```PHP
$request = new Tamkeen\Request($client, 'GET', 'branches'); // Create the request
$response = $request->send();
```
You need to call `->send()`, which will send the request to the application and return the response. The response will be in JSON format.

## Examples:
Here is an example for fetching the branches list:
```PHP
$client = new Tamkeen\Client;

$client->setBaseUrl('https://example.com')
    ->setApiKey(' ... ');

try{
    $request = $client->request('get', 'branches'); // Create the request
    $response = $request->send(); // Send it, returns the response

}catech(RequestException $e){
    /**
    * Calling $e->getMessage() returns one of these messages:
    * request_error: Error while creating/sending the request
    * api_not_active: The API interface is disabled on Tamkeen's end, and needs to be enabled.
    * auth_failed: Authentication failed; the API key is invalid
    * limit_reached: Reached the limit on the number of API requests, configured in Tamkeen.
    * invalid_path: The endpoint requested was not found
    * api_error: An error happened on the API's end 
    **/
}
```

The `$response` in this case would return:
```json
{
    "branches": [{
        'id': 1,
        'name': "HQ"
    }]
}
```