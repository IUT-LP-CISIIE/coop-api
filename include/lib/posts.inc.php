<?php

function post_getAll($channel_id) {
	$sth = prepare("SELECT * FROM posts WHERE cle = :cle AND channel_id = :channel_id ORDER BY id DESC");
	$sth->bindParam("cle", $GLOBALS['API_KEY']);
	$sth->bindParam("channel_id", $channel_id);

	$sth->execute();
	if($posts = $sth->fetchAll()) {
		return array_map('prepareData',$posts);	
	} else {
		return array();
	}
}

function post_update($hash, $params){
	if($post = post_get($hash,'hash')) {
		if(isset($params['message'])) {
			$post['message'] = $params['message'];
			$sth = prepare("UPDATE posts SET message = :valeur WHERE cle = :cle AND hash = :hash");
			$sth->bindParam("cle", $GLOBALS['API_KEY']);		
			$sth->bindParam("hash", $hash);		
			$sth->bindParam("valeur", $params['message']);
			$sth->execute();
		}
		return $post;
	}
}
function post_create($post) {
	$sql = "INSERT INTO posts (hash, cle, channel_id, message, member_id) VALUES (:hash, :cle, :channel_id, :message, :member_id)";
	$sth = prepare($sql);
	$sth->bindParam("hash", ID($post['message']));
	$sth->bindParam("cle", $GLOBALS['API_KEY']);
	$sth->bindParam("channel_id", $post['channel_id']);
	$sth->bindParam("message", $post['message']);
	$sth->bindParam("member_id", $post['member_id']);

	$sth->execute();
	return post_get($GLOBALS['DB']->lastInsertId());
}	


function post_get($valeur,$key='id') {
	$sth = prepare("SELECT * FROM posts WHERE cle = :cle AND ".$key." = :valeur");
	$sth->bindParam("valeur", $valeur);
	$sth->bindParam("cle", $GLOBALS['API_KEY']);

	$sth->execute();
	$posts = $sth->fetchAll();	
	if(isset($posts[0])) {
		return prepareData($posts[0]);
	}
}
