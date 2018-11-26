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

foreach(glob(CHEMIN_SITE.'routes/*.php') as $route) {
	include $route;
}



$app->run();
