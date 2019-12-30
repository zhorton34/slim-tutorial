<?php

declare(strict_types=1);

use Slim\App;
use App\Application\Middleware\ExampleAfterMiddleware;
use App\Application\Middleware\ExampleBeforeMiddleware;

return function (App $app) {
    // Add Global Middleware
    $app->addErrorMiddleware(true, true, false);
    $app->add(ExampleBeforeMiddleware::class);
    $app->add(ExampleAfterMiddleware::class);
};
