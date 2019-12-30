<?php

declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;

return function (App $app) {
    $app->get('/', function (RequestInterface $request, ResponseInterface $response, $args) {
        $response->getBody()->write("Hello World");
        return $response;
    });

    $app->get('/user/{name}', function (RequestInterface $request, ResponseInterface $response, $args)
    {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");
        return $response;
    });

    $container = $app->getContainer();

    $app->group('', function (RouteCollectorProxy $view)
    {
        $view->get('/example/{name}', function($request, $response, $args) {
            $name = $args['name'];

            return $this->get('view')->render($response, 'example.twig', compact('name'));
        });

        $view->get('/views/{name}', function ($request, $response, $args) {
            $view = 'example.twig';
            $name = $args['name'];

            return $this->get('view')->render($response, $view, compact('name'));
        });

    })->add($container->get('viewMiddleware'));
};
