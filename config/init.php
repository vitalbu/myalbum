<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("LIBS", ROOT . '/vendor/vitalbu/myblog/src/libs');
define("TMP", ROOT . '/tmp');
define("ALBUMS", ROOT . '/public/images/albums');
define("CACHE", ROOT . '/tmp/cache');
define("CONF", ROOT . '/config');
define("LAYOUT", 'default');

define("PATH", $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);

require_once ROOT . '/vendor/autoload.php';