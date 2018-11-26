<?php

$app->get('/api/ping', function ($request, $response, $args) {
	return $response->write('true');
});
