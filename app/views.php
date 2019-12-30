<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Loader\FilesystemLoader;

return function (App $app) {
    $container = $app->getContainer();

    $container->set('view', function() use ($container) {
        $settings = $container->get('settings')['views'];
        $loader = new FilesystemLoader($settings['path']);

        return new Twig($loader, $settings['settings']);
    });

    $container->set('viewMiddleware', function() use ($app, $container) {
        return new TwigMiddleware($container->get('view'), $app->getRouteCollector()->getRouteParser());
    });
};
