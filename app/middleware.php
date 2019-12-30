<?php
declare(strict_types=1);

use Slim\App;
use App\Application\Middleware\ExampleAfterMiddleware;
use App\Application\Middleware\ExampleBeforeMiddleware;

return function (App $app) {
    $app->add(ExampleAfterMiddleware::class);
    $app->add(ExampleBeforeMiddleware::class);
    $app->addErrorMiddleware(true, true, false);
};
