<?php
include 'include/main.inc.php';
require 'vendor/autoload.php';


$configuration = [
	'settings' => [
		'displayErrorDetails' => true,
	],
];
$c = new \Slim\Container($configuration);

$app = new Slim\App($c);

$app->add( new TokenMiddleware() );

// $app->get('/hello/{name}', function ($request, $response, $args) {
//     return $response->write("Hello, " . $args['name']);
// });


$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


foreach(glob(CHEMIN_SITE.'routes/*.php') as $route) {
	include $route;
}



$app->run();
