<?php

declare(strict_types=1);

// require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/./vendor/autoload.php';

$router = new AltoRouter();

// $router->setBasePath('/system');

// スクリプトを直で呼び出す
// test
$router->map('GET|POST', '/phpinfo', function () {
    echo phpinfo();
});

$router->map('GET|POST', '/', function () {
    require_once __DIR__ . '/./app/controller/conIndex.php';
});

$match = $router->match();

// print_r($router);


if( is_array($match) && is_callable( $match['target'] ) ) {
    // var_dump(is_callable($match['target']));
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}