<?php
require __DIR__ . '/../vendor/autoload.php';

use ConsulManager\App\Kernel\Container;
use ConsulManager\Configures\Configure;

$container2 = new Container();
$container2->bind('config', Configure::class);


$config = $container2->make('config')->get('app');

var_dump($config);