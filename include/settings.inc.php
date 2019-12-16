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
	$settings['host'] = 'sopress.local';
	$settings['dbname'] = 'coop';
	$settings['user'] = 'sopress';
	$settings['pass'] = 'sopress';

	define('CHEMIN_SITE','/home/sopress/dev/iut/coop-api/');
	define('URL_API','http://sopress.local/iut/coop-api/');
}

