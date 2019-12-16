<?php

function deleteSession($token) {
	$sth = prepare("DELETE FROM sessions WHERE token = :token");
	$sth->bindParam("token", $token);
	$sth->execute();
}
function getSession($token) {
	$sth = prepare("SELECT * FROM sessions WHERE token = :token");
	$sth->bindParam("token", $token);
	$sth->execute();
	$keys = $sth->fetchAll();	
	if(isset($keys[0])) {
		return $keys[0];
	}		
}

function createSession($member_hash) {
	$token = ID();
	$sql = "REPLACE INTO sessions (member_hash, token) VALUES (:member_hash, :token)";
	$sth = prepare($sql);
	$sth->bindParam("token", $token);
	$sth->bindParam("member_hash", $member_hash);
	try {
		$sth->execute();
		return $token;
	}
	catch(PDOException $exception){ 
		// me($exception);
	}	

}