<?php

use Symfony\Component\Dotenv\Dotenv;

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
require dirname(__DIR__) . '/vendor/autoload.php';



if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

$env = 'test';
