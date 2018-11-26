<?php

$app->DELETE('/api/members/{id}', function ($request, $response, $args) {
	member_delete($args['id']);
});

$app->GET('/api/members', function ($request, $response, $args) {
	$membres = member_getAll();
	return $response->withStatus(200)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($membres));
});

$app->GET('/api/members/signout', function ($request, $response, $args) {
	unset($_SESSION['member']);
});
$app->GET('/api/members/{id}/signedin', function ($request, $response, $args) {
	$id = $args['id'];
	$member = $_SESSION['member'];
	if($member) {
		if($member['id'] == $id) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode(array('member'=>$member)));
		}
	}
	$error = array('message'=>'Cet utilisateur n\'est pas connecté');
	return $response->withStatus(500)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($error));
});

$app->POST('/api/members/signin', function ($request, $response, $args) {
	$params = $request->getQueryParams();
	$member = member_get($params['email'],'email');
	if($member['password'] == $params['password']) {
		session_start();
		$id = session_id();
		$_SESSION['member'] = $member;
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode(array('token'=>$id,'member'=>$member)));
	} else {
		$error = array('message'=>'Email ou mot de passe incorrect');
		return $response->withStatus(500)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($error));
	}
});

$app->post('/api/members', function ($request, $response, $args) {
	$params = $request->getQueryParams();
	$messages = verifier($params,array('fullname','email','password'));
	if(!$messages) {
		$ret = member_create($params);
		if(is_array($ret)) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($ret));
		} else {
			$error = array('member'=>$params,'message'=>$ret);
			return $response->withStatus(500)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($error));
		}
	} else {
		$error = array('member'=>$params,'message'=>implode(' ',$messages));
		return $response->withStatus(500)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($error));
	}
});