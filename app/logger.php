<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;

return function (Container $container) {
    $container->set(LoggerInterface::class, function (ContainerInterface $container) {
        $settings = $container->get('settings')['logger'];

        $logger = new Logger($settings['name']);

        $processor = new UidProcessor();
        $logger->pushProcessor($processor);

        $handler = new StreamHandler($settings['path'], $settings['level']);
        $logger->pushHandler($handler);

        return $logger;
    });
};
