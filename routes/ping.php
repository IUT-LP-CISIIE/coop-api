<?php

/**
 * @api {POST} /ping
 * @apiName ping
 * @apiGroup API
 *
 * @apiSuccess {String} etat L'état de l'API
 */
$app->get('/api/ping', function ($request, $response, $args) {
	return $response->write('true');
});
