<?php

function member_create($member) {
	$sql = "INSERT INTO members (hash, cle, fullname, email, password) VALUES (:hash, :cle, :fullname, :email, :password)";
	$sth = prepare($sql);
	$sth->bindParam("hash", ID($member['email']));
	$sth->bindParam("email", $member['email']);
	$sth->bindParam("password", $member['password']);
	$sth->bindParam("fullname", $member['fullname']);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);
	try {
		$sth->execute();
		return member_get($GLOBALS['DB']->lastInsertId());
	}
	catch(PDOException $exception){ 
		if($exception->getCode() == '23000') {
		    return "Un utilisateur existe déjà avec cette adresse mail.";
		}
	}	
}	



function member_get($valeur,$key='id') {
	$sth = prepare("SELECT * FROM members WHERE cle = :cle AND ".$key." = :valeur");
	$sth->bindParam("valeur", $valeur);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);

	$sth->execute();
	$members = $sth->fetchAll();	
	if(isset($members[0])) {
		return prepareData($members[0]);
	}
}

function member_getAll() {
	$sth = prepare("SELECT * FROM members WHERE cle = :cle ORDER BY fullname ASC");
	$sth->bindParam("cle", $GLOBALS['API_KEY']);

	$sth->execute();
	if($members = $sth->fetchAll()) {
		return array_map('prepareData',$members);	
	} else {
		return array();
	}
}


function member_delete($hash) {
	$sth = prepare("DELETE FROM members WHERE cle = :cle AND hash = :hash");
	$sth->bindParam("hash", $hash);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);
	$sth->execute();
}