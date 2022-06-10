<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';
require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';

new \myframework\App();

//throw new Exception('Страница не найдена', 404);

//debug(\myframework\Router::getRoutes());