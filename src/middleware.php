<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
use Psr7Middlewares\Middleware;

$app->add(
    Middleware::Https(true)   //(optional) True to force https, false to force http (true by default)
        ->maxAge(1000000)     //(optional) max-age directive for the Strict-Transport-Security header. By default is 31536000 (1 year)
        ->includeSubdomains() //(optional) To add the "includeSubDomains" attribute to the Strict-Transport-Security header.
    );
