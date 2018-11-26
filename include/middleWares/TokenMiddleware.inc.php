<?php

Class TokenMiddleware
{

 

    public function __invoke($request, $response, $next)
    {

    	if($session_token = $_GET['token'] ?  $_GET['token'] : $_POST['token']) {
    		session_start($session_token);
    	}
    	$routes_publiques = array(
    		'ping',
//    		'members/signin'
    	);
        $cle = trim(str_replace('Bearer ','',$request->getHeaders()['HTTP_AUTHORIZATION'][0]));
        $granted = false;
        $route = str_replace('api/','',$request->getUri()->getPath());
        if(in_array($route, $routes_publiques)!==false) {
        	$granted = true;
        } else if($cle) {
        	if(getCle($cle)) {
        		$granted=true;
        		$GLOBALS['API_KEY'] = $cle;
        	} else {
        		$message = 'Token inconnu';
        	}
        } else {
        	$message = 'Token manquant';
        }

        if($granted) {
        	return $next($request, $response);
		} else {
			return $response->withStatus(401)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode(array('message'=>$message)));
		}
    }
}


