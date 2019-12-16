<?php



function ID($id=false) {
	return sha1(CHEMIN_SITE.$GLOBALS['API_KEY'].$id.microtime().rand());
}

function prepareData($data) {
	unset($data['cle']);
	$data['id'] = $data['hash'];
	unset($data['hash']);
	return $data;
}


function prepare($sql) {
	return $GLOBALS['DB']->prepare($sql);
}
function me($data) {
	print_r($data);
	exit;
}

function verifier($data,$fields) {

	$erreurs = array();
	foreach ($fields as $field) {
		if(empty($data[$field])) {
			$erreurs[$field] = 'Le champ '.$field.' est vide.';
		}
	}

	if(count($erreurs)) {
		return $erreurs;
	}
}