<?php

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

$app->GET('/api/channels/{id}/posts', function ($request, $response, $args) {
	$posts = post_getAll($args['id']);
	return $response->withStatus(200)
	->withHeader('Content-Type', 'application/json')
	->write(json_encode($posts));
});


$app->post('/api/channels/{id}/posts', function ($request, $response, $args) {
	$params = array_merge($request->getQueryParams(), $_POST);
	$params['channel_id']=$args['id'];
	$params['member_id']=$_SESSION['member']['id'];
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