<?php

function channel_create($channel) {
	$sql = "INSERT INTO channels (hash, cle, label, topic) VALUES (:hash, :cle, :label, :topic)";
	$sth = prepare($sql);
	$sth->bindParam("hash", ID($channel['label']));
	$sth->bindParam("label", $channel['label']);
	$sth->bindParam("topic", $channel['topic']);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);
	try {
		$sth->execute();
		return channel_get($GLOBALS['DB']->lastInsertId());
	}
	catch(PDOException $exception){ 
		if($exception->getCode() == '23000') {
			return "Un channel existe déjà avec le même nom.";
		}
	}	
}	


function channel_getAll() {
	$sth = prepare("SELECT * FROM channels WHERE cle = :cle ORDER BY modified_at DESC");
	$sth->bindParam("cle", $GLOBALS['API_KEY']);

	$sth->execute();
	if($channels = $sth->fetchAll()) {
		return array_map('prepareData',$channels);	
	} else {
		return array();
	}
}
function channel_update($hash, $params){
	if($channel = channel_get($hash,'hash')) {
		foreach(array('label','topic') as $field) {
			if(isset($params[$field])) {
				$channel[$field] = $params[$field];
				$sth = prepare("UPDATE channels SET ".$field." = :valeur WHERE cle = :cle AND hash = :hash");
				$sth->bindParam("cle", $GLOBALS['API_KEY']);		
				$sth->bindParam("hash", $hash);		
				$sth->bindParam("valeur", $params[$field]);
				$sth->execute();
			}
		}
		return $channel;
	}
}

function channel_get($valeur,$key='id') {
	$sth = prepare("SELECT * FROM channels WHERE cle = :cle AND ".$key." = :valeur");
	$sth->bindParam("valeur", $valeur);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);

	$sth->execute();
	$channels = $sth->fetchAll();	
	if(isset($channels[0])) {
		return prepareData($channels[0]);
	}
}

function channel_delete($hash) {
	$sth = prepare("DELETE FROM channels WHERE cle = :cle AND hash = :hash");
	$sth->bindParam("hash", $hash);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);
	$sth->execute();

	$sth = prepare("DELETE FROM posts WHERE cle = :cle AND channel_id = :hash");
	$sth->bindParam("hash", $hash);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);
	$sth->execute();
}