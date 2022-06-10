<?php

// все прописано без слеша на конце
define('DEBUG', 1);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('WWW', ROOT . '/public');
define('APP', ROOT . '/app');
define('CORE', ROOT . '/vendor/myframework/core');
define('LIBS', ROOT . '/vendor/myframework/core/libs');
define('CACHE', ROOT . '/tmp/cache');
define('CONF', ROOT . '/config');
define('LAYOUT', 'watches');

//http://myframework.theo/public/index.php
$appPath = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";

//http://myframework.theo/public/
$appPath = preg_replace("#[^/]+$#", '', $appPath);

//http://myframework.theo/
$appPath = str_replace("/public/", '', $appPath);

define('PATH', $appPath);
define('ADMIN', PATH . '/admin');

require_once ROOT . '/vendor/autoload.php';
