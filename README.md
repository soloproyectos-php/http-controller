# http-controller
A simple HTTP Controller. This library is part of the SoloProyectos PHP API.

## Install

Install [Composer Package Manager](https://getcomposer.org/) and execute the following command:
```bash
composer require soloproyectos-php/http-controller
```

## Relevant methods

The following methods are used to process HTTP requests.

  * `addRequestHandler(string $method, callable $handler)`: processes a HTTTP requests.
  * `addGetRequestHandler(callable $handler)`: processes GET requests.
  * `addPostRequestHandler(callable $handler)`: processes POST requests.
  * `addOpenRequestHandler(callable $handler)`: processes 'OPEN' requests (this method is called at first place).
  * `addCloseRequestHandler(callable $handler)`: processes 'CLOSE' requests (this method is called in last place).
  
The following methods are used to get parameters:

  * `getParam(string $name, string $defaultValue)`: gets a HTTP parameter.
  * `getCookie(string $name, string $defaultValue)`: gets a cookie parameter.
  * `getSession(string $name, string $defaultValue)`: gets a session variable.
  
For more information, see the following classes: `HttpControllerParamTrait`, `HttpControllerCookieTrait` and `HttpControllerSessionTrait`.

## Example

See the `demo` folder for a more detailed example.

```php
<?php
require_once "vendor/autoload.php";
use soloproyectos\http\controller\HttpController;

$c = new HttpController();

/**
 * This is a good place to initiate variables or open resources, such as
 * database connections, etc...
 */
$c->addOpenRequestHandler(function () {
    echo "Initializing variables and opening resources...\n";
});

/**
 * Processes GET requests.
 */
$c->addGetRequestHandler(function () use ($c) {
    // parameters
    $param1 = $c->getParam("param1");
    $param2 = $c->getParam("param2");
    
    echo "Processing GET request...\n";
});


/**
 * Processes POST requests.
 */
$c->addPostRequestHandler(function () use ($c) {
    // parameters
    $param1 = $c->getParam("param1");
    $param2 = $c->getParam("param2");
    
    echo "Processing POST request...\n";
});

$c->processRequest();
```
