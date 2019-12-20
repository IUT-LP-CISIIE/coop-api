<?php



/**
 * @api {GET} /members Liste des membres
 * @apiName getMembres
 * @apiGroup Membre
 *
 * @apiParam {String} session_token Le token de session
 *
 * @apiSuccess {Array} members Liste des membres
 */
$app->GET('/api/members', function ($request, $response, $args) {
	$membres = member_getAll();
	return $response->withStatus(200)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($membres));
});


/**
 * @api {DELETE} /members/signout Se déconnecter
 * @apiName signOutMembre
 * @apiGroup Membre
 *
 * @apiParam {String} session_token Le token de session
 */
$app->DELETE('/api/members/signout', function ($request, $response, $args) {
//	unset($_SESSION['member']);
	deleteSession($GLOBALS['token']);
	return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode(['message'=>'Utilisateur déconnecté']));
});

/**
 * @api {DELETE} /members/:id Effacer un membre
 * @apiName deleteMembre
 * @apiGroup Membre
 *
 * @apiParam {String} id L'identifiant du membre
 * @apiParam {String} session_token Le token de session
 */
$app->DELETE('/api/members/{id}', function ($request, $response, $args) {
	member_delete($args['id']);
	return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode(['message'=>'Utilisateur supprimé']));
});

/**
 * @api {GET} /members/:id/signedin Etat de la session
 * @apiName signedInMembre
 * @apiGroup Membre
 *
 * @apiParam {String} id L'identifiant du membre
 * @apiParam {String} session_token Le token de session
 */
$app->GET('/api/members/{id}/signedin', function ($request, $response, $args) {
	$id = $args['id'];
	$member = $GLOBALS['membre'];
	if($member) {
		if($member['id'] == $id) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode(array('member'=>$member,'token'=>$GLOBALS['token'])));
		}
	}
	$error = array('message'=>'Cet utilisateur n\'est pas connecté');
	return $response->withStatus(401)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($error));
});

/**
 * @api {POST} /members/signin Se connecter
 * @apiName signInMembre
 * @apiGroup Membre
 *
 * @apiParam {String} email Le mail du membre
 * @apiParam {String} password Le mot de passe
 */
$app->POST('/api/members/signin', function ($request, $response, $args) {
	$params = array_merge($request->getQueryParams(), $_POST);
	$member = member_get($params['email'],'email');
	if($member['password'] == $params['password']) {
		unset($member['password']);
		if($token = createSession($member['id'])) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode(array('token'=>$token,'member'=>$member)));
		}
	} else {
		$error = array('message'=>'Email ou mot de passe incorrect');
		return $response->withStatus(401)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($error));
	}
});

/**
 * @api {POST} /members Créer un membre
 * @apiName setMembre
 * @apiGroup Membre
 *
 * @apiParam {String} fullname Le nom complet du membre
 * @apiParam {String} email Le mail du membre
 * @apiParam {String} password Le mot de passe
 *
 * @apiSuccess {Object} member Le membre créé
 */
$app->post('/api/members', function ($request, $response, $args) {
	$params = array_merge($request->getQueryParams(), $_POST);
	$messages = verifier($params,array('fullname','email','password'));

	if(!$messages) {
		$ret = member_create($params);
		if(is_array($ret)) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($ret));
		} else {
			$error = array('member'=>$params,'message'=>$ret);
			return $response->withStatus(400)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($error));
		}
	} else {
		$error = array('member'=>$params,'message'=>implode(' ',$messages));
		return $response->withStatus(400)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($error));
	}
});