<?php

function getCle($cle) {
	$sth = prepare("SELECT * FROM cles WHERE cle = :cle");
	$sth->bindParam("cle", $cle);
	$sth->execute();
	$keys = $sth->fetchAll();	
	if(count($keys)) {
		return $keys[0];
	}	
}
function hashCle($email) {
	return sha1($email.CHEMIN_SITE);
}
function ajouterCle($email) {
	$cle = hashCle($email);
	if($data = getCle($cle)) {
		return $data['cle'];
	} else {
		$sql = "INSERT INTO cles (cle, email) VALUES (:cle, :email)";
		$sth = prepare($sql);
		$sth->bindParam("email", $email);
		$sth->bindParam("cle", $cle);
		try {
			$sth->execute();
			return $cle;
		}
		catch(PDOException $exception){ 
			me($exception);
		}	
	}
}