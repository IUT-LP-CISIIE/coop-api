<?php 


include 'settings.inc.php';

$files = glob(CHEMIN_SITE.'include/classes/*.php');
$files = array_merge($files,glob(CHEMIN_SITE.'include/lib/*.php'));
$files = array_merge($files,glob(CHEMIN_SITE.'include/middleWares/*.php'));

foreach($files as $file) {
	include $file;
}
$pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'],
    $settings['user'], $settings['pass']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$GLOBALS['DB'] = $pdo;

//$GLOBALS['API_KEY']='test';
