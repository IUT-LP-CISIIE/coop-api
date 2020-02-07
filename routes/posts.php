<?php


/**
 * @api {DELETE} /channels/:channel_id/posts/:id Effacer un message
 * @apiName deleteMessage
 * @apiGroup Message
 *
 * @apiParam {String} channel_id Identifiant de la conversation
 * @apiParam {String} id Identifiant du message
 * @apiParam {String} token Le token de session
 */
$app->DELETE('/api/channels/{channel_id}/posts/{id}', function ($request, $response, $args) {
	$id = $args['id'];
	post_delete($id);
	$error = array('message'=>'Post effacé.');
	return $response->withStatus(200)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($error));
});


/**
 * @api {PUT} /channels/:channel_id/posts/:id Editer un message
 * @apiName editMessage
 * @apiGroup Message
 *
 * @apiParam {String} channel_id Identifiant de la conversation
 * @apiParam {String} id Identifiant du message
 * @apiParam {String} message Le contenu du message
 * @apiParam {String} token Le token de session
 */
$function_update_post = function ($request, $response, $args) {
	$params = array_merge($request->getQueryParams(), $_POST);
	$id = $args['id'];
	if(post_update($id, $params)) {
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode(post_get($id,'hash')));		
	}
}; 
$app->PUT('/api/channels/{channel_id}/posts/{id}', $function_update_post);
$app->PATCH('/api/channels/{channel_id}/posts/{id}', $function_update_post);

/**
 * @api {GET} /channels/:channel_id/posts/:id Récupérer un message
 * @apiName getMessage
 * @apiGroup Message
 *
 * @apiParam {String} channel_id Identifiant de la conversation
 * @apiParam {String} id Identifiant du message
 * @apiParam {String} token Le token de session
 */
$app->GET('/api/channels/{channel_id}/posts/{id}', function ($request, $response, $args) {
	if($post = post_get($args['id'],'hash')) {
		if($post['channel_id'] == $args['channel_id']) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($post));
		}
	} 
	$error = array('message'=>'Impossible de trouver ce message.');
	return $response->withStatus(500)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($error));

});

/**
 * @api {GET} /channels/:channel_id/posts Récupérer les messages d'une conversation 
 * @apiName getMessages
 * @apiGroup Message
 *
 * @apiParam {String} channel_id Identifiant de la conversation
 * @apiParam {String} token Le token de session
 */
$app->GET('/api/channels/{channel_id}/posts', function ($request, $response, $args) {
	$posts = post_getAll($args['channel_id']);
	return $response->withStatus(200)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($posts));
});



/**
 * @api {POST} /channels/:channel_id/posts Poster un message 
 * @apiName setMessage
 * @apiGroup Message
 *
 * @apiParam {String} channel_id Identifiant de la conversation
 * @apiParam {String} member_id Identifiant de l'auteur
 * @apiParam {String} message Contenu du message
 * @apiParam {String} token Le token de session
 *
 * @apiSuccess {Object} post Le message posté
 */

$app->post('/api/channels/{channel_id}/posts', function ($request, $response, $args) {
	$params = array_merge($request->getQueryParams(), $_POST);
	$params['channel_id']=$args['channel_id'];
	$params['member_id']=$GLOBALS['membre']['id'];
	$messages = verifier($params,array('member_id','channel_id','message'));
	if(!$messages) {
		$ret = post_create($params);
		if(is_array($ret)) {
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($ret));
		} else {
			$error = array('post'=>$params,'message'=>$ret);
			return $response->withStatus(500)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($error));
		}
	} else {
		$error = array('post'=>$params,'message'=>implode(' ',$messages));
		return $response->withStatus(500)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($error));
	}
});