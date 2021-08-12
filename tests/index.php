<?php
require __DIR__ . '/../vendor/autoload.php';

use ConsulManager\App\Application;

$config = array(
    'host' => '49.233.105.235:',
    'port' => 8500
);

$app = new Application($config);