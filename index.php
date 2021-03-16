<?php


#error_reporting(-1);ini_set('display_errors', 'On');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PATCH, PUT, DELETE');
header('Access-Control-Allow-Headers: *');
//header('Access-Control-Allow-Headers: append,delete,entries,foreach,get,has,keys,set,values,Authorization');

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

foreach(glob(CHEMIN_SITE.'routes/*.php') as $route) {
	include $route;
}



$app->run();
