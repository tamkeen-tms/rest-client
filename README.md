# Tamkeen REST API PHP client

## What is this?
This is the official PHP client for Tamkeen's REST API. You can use this in your PHP applications to communicate with Tamkeen. 
Before you start you need to acquire an the "Tenant id" and the secret "key"; you can find this info under Administration > API.

## Installation
You can require this library into your project using `composer`, via the following command:
```shell
composer require tamkeen-tms/rest-client
```
Next, you will be able to use it inside your project through the namespace `Tamkeen`

## How it works
This library merely sends requests to Tamkeen's API endpoints. 
So, you need to know what endpoints are available and how to pick the correct one! A list of the endpoints are available on Tamkeen's website.

### Creating a client
Before sending requests you need to initiate a new "Client" instance, and pass it the "Tenant" and authorization key. Through this client you will be able to make the requests. Each "Request" must be made through a "Client". You can instantiate multiple clients to make requests to multiple copies of the application! 
```PHP
$client = new Tamkeen\Client([tenant], [secret key]) // New client instance
```
### Sending a request
Using the created client you can now send new requests, for example:
```PHP
$request = new Tamkeen\Request($client, 'GET', 'branches'); // Create the request
$response = $request->send();
```
You need to call `->send()`, which will send the request to the application and return the response. The response will be in JSON format.

## Examples:
Here is an example for fetching the branches list:
```PHP
try{
    $request = $client->request('get', 'branches'); // Create the request
    $response = $request->send(); // Send it, returns the response

}catch(RequestException $e){
    /**
    * Calling $e->getMessage() returns one of these messages:
    * 
    * request_error: Error while creating/sending the request.
    * api_disabled: The API interface is disabled on Tamkeen's end, and needs to be enabled.
    * missing_or_invalid_key: Authentication failed; key missing or invalide
    * api_error: An error happened on the API's end.
    *
    * limit_reached: Reached the limit on the number of API requests, configured in Tamkeen.
    * invalid_path: The endpoint requested was not found.
    **/
}
```

The `$response` in this case would return:
```json
{
    "branches": [{
        "id": 1,
        "name": "HQ",
        "currency": "USD"
    }]
}
```

For any further questions please feel free to create a new issue here.