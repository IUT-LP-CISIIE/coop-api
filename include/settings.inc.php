<?php
if($_SERVER['HTTP_HOST'] == 'allweb.fun' || $_SERVER['HTTP_HOST'] == 'www.allweb.fun') {
	$settings = array();
	$settings['host'] = 'localhost';
	$settings['dbname'] = 'coop';
	$settings['user'] = 'sopress';
	$settings['pass'] = '*EVpoYUF*j8$236ycw8j$%d';

	define('CHEMIN_SITE','/home/sopress/allweb/coop/');
	define('URL_API','https://allweb.fun/coop/');	
} else {
	$settings = array();
	$settings['host'] = 'localhost';
	$settings['dbname'] = 'coop';
	$settings['user'] = 'root';
	$settings['pass'] = 'root';

	define('CHEMIN_SITE',realpath(dirname(__FILE__).'/..').'/');
	define('URL_API','http://dev.local/iut/coop-api/');
}

