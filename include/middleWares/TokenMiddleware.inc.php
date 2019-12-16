<?php

Class TokenMiddleware
{

 

    public function __invoke($request, $response, $next)
    {
        $cle = trim(str_replace('Bearer ','',$request->getHeaders()['HTTP_AUTHORIZATION'][0]));
        $GLOBALS['API_KEY'] = $cle;

        $granted = false;
        $message = false;
        $GLOBALS['membre']=false;
        if($session_token = $_GET['token'] ?  $_GET['token'] : $_POST['token']) {
            if($session = getSession($session_token)) {
                if($member = member_get($session['member_hash'],'hash')) {
                    $GLOBALS['membre'] = $member;
                    $GLOBALS['token'] = $session_token;
                }
            }
        }



    	$routes_publiques = array(
    		'ping',
    	);
        if(!$message) {
            $route = str_replace('api/','',$request->getUri()->getPath());
            $token_declaration = ' Vous devez déclarer votre token au préalable en consultant la page '.URL_API.'key.php';
            if(in_array($route, $routes_publiques)!==false) {
                $granted = true;
            } else if($cle) {
                if(getCle($cle)) {
                    $granted=true;
            	} else {
            		$message = 'Token inconnu.'.$token_declaration;
            	}
            } else {
            	$message = 'Token manquant. Vous devez envoyer un token dans les headers de votre appel. Exemple : {"Authorization":"montoken"}.'.$token_declaration;
            }
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


