<?php


/**
 * @api {GET} /channels/:id Une conversation
 * @apiName getConversation
 * @apiGroup Conversation
 *
 * @apiParam {String} id Identifiant de la conversation
 * @apiParam {String} token Le token de session
 *
 * @apiSuccess {Object} channel La conversation
 */
$app->GET('/api/channels/{id}', function ($request, $response, $args) {
	$id = $args['id'];
	$channel = channel_get($id, 'hash');
	return $response->withStatus(200)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($channel));
});


/**
 * @api {GET} /channels Liste des conversations
 * @apiName getConversations
 * @apiGroup Conversation
 *
 * @apiParam {String} token Le token de session
 *
 * @apiSuccess {Array} channels Les conversations
 */
$app->GET('/api/channels', function ($request, $response, $args) {
	$channels = channel_getAll();
	return $response->withStatus(200)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($channels));
});

/**
 * @api {POST} /channels Poster une conversation
 * @apiName setConversation
 * @apiGroup Conversation
 *
 * @apiParam {String} label Etiquette de la conversation
 * @apiParam {String} topic Sujet de la conversation
 * @apiParam {String} token Le token de session
 *
 * @apiSuccess {Object} channel La conversation créé
 */

$app->post('/api/channels', function ($request, $response, $args) {
	$params = array_merge($request->getQueryParams(), $_POST);
	$messages = verifier($params,array('label','topic'));
	if(!$messages) {
		$ret = channel_create($params);
		if(is_array($ret)) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($ret));
		} else {
			$error = array('channel'=>$params,'message'=>$ret);
			return $response->withStatus(500)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($error));
		}
	} else {
		$error = array('channel'=>$params,'message'=>implode(' ',$messages));
		return $response->withStatus(500)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($error));
	}
});



/**
 * @api {PUT} /channels/:id Modifier la conversation
 * @apiName editConversation
 * @apiGroup Conversation
 *
 * @apiParam {String} id Identifiant de la conversation
 * @apiParam {String} label Etiquette de la conversation
 * @apiParam {String} topic Sujet de la conversation
 * @apiParam {String} token Le token de session
 *
 * @apiSuccess {Object} channel La conversation modifiée
 */

$function_update_channel = function ($request, $response, $args) {
	$params = array_merge($request->getQueryParams(), $_POST);
	$id = $args['id'];
	if(channel_update($id, $params)) {
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode(channel_get($id,'hash')));		
	}
}; 
$app->PUT('/api/channels/{id}', $function_update_channel);
$app->PATCH('/api/channels/{id}', $function_update_channel);


/**
 * @api {DELETE} /channels/:id Effacer la conversation
 * @apiName deleteConversation
 * @apiGroup Conversation
 *
 * @apiParam {String} id Identifiant de la conversation
 * @apiParam {String} token Le token de session
 *
 */
$app->DELETE('/api/channels/{id}', function ($request, $response, $args) {
	if(channel_get($args['id'],'hash')) {
		channel_delete($args['id']);
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode(array('message'=>'Channel effacé.')));		
	} else {
		return $response->withStatus(500)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode(array('message'=>'Ce channel n\'existe pas.')));		
	}
});
