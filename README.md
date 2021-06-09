# Tamkeen REST API PHP client

## What is this?
This is the official PHP client for Tamkeen's REST API. You can use this in your PHP applications to communicate with Tamkeen. 
Before you start you need to acquire an the "Tenant id" and the secret auth "key"; you can find this info under Administration > API.

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
    * Possible error messages include:
    * tenant_not_identified: The tenant id was not provided, or invalid
    * api_disabled: API is disabled for the tenant. (Contact the support team to enable it).
    * api_key_missing: The authentication key missing.
    * api_key_invalid: The authentication key is invalid.
    * api_error: An error happened at the API's level; server error (500).
    **/
}
```

The `$response` in this case would return:
```json
{
    "branches": [{
        "id": 1,
        "name": "Headquarters",
        "code": "HQ"
        "currency": "USD"
    }]
}
```

For any further questions please feel free to create a new issue here.