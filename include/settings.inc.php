<?php


if($_SERVER['HTTP_HOST'] == 'tools.sopress.net') {
	$settings = array();
	$settings['host'] = 'tools.sopress.net';
	$settings['dbname'] = 'coop';
	$settings['user'] = 'sopress';
	$settings['pass'] = 'qpok7510';

	define('CHEMIN_SITE','/home/sopress/www/iut/coop/');
	define('URL_API','http://tools.sopress.net/iut/coop/');	
} else {
	$settings = array();
	$settings['host'] = 'localhost';
	$settings['dbname'] = 'coop';
	$settings['user'] = 'root';
	$settings['pass'] = 'root';

	define('CHEMIN_SITE',realpath(dirname(__FILE__).'/..').'/');
	define('URL_API','http://dev.local/iut/coop-api/');
}

