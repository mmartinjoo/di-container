<?php

use Container\Container\ContainerManual;
use Container\Container\ContainerAuto;
use Container\ExampleService;
use Container\File;
use Container\Logger;

include __DIR__ . '/vendor/autoload.php';

$container = new ContainerManual();
$container->set(File::class, fn (ContainerManual $c) => new File());
$container->set(Logger::class, fn (ContainerManual $c) => new Logger($c->get(File::class)));
$container->set(ExampleService::class, fn (ContainerManual $c) => new ExampleService($c->get(Logger::class)));
$service = $container->get(ExampleService::class);
$service->create();

$container = new ContainerAuto();
$service = $container->get(ExampleService::class);
$service->create();