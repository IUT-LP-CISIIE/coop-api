<?php

Class TokenMiddleware
{

 

    public function __invoke($request, $response, $next)
    {


        $cle = trim(str_replace('Bearer ','',$request->getHeaders()['HTTP_AUTHORIZATION'][0]));
        $GLOBALS['API_KEY'] = $cle;

        $granted = isset($_GET['granted']);
        $message = false;
        $GLOBALS['membre']=false;
        $session_token = $_GET['token'] ?  $_GET['token'] : $_POST['token'];
        if(!$session_token) {
            $session_token = $_GET['session_token'] ?  $_GET['session_token'] : $_POST['session_token'];
        }

        if(!$session_token) {
            $data = json_decode(file_get_contents("php://input"), TRUE);
            $session_token = isset($data['token']) ?  $data['token'] : false;
            if(!$session_token) {
                $session_token = isset($data['session_token']) ?  $data['session_token'] : false;
            }
        }

        $routes_publiques = array(
            'ping',
            'members',
            'members/signin'
        );
        if(!$message) {
            $route = str_replace('api/','',$request->getUri()->getPath());
            if($route == '/') {
                header('Location: doc');
                exit;
            }

            $token_declaration = ' Vous devez déclarer votre token d\'autorisation au préalable en consultant la page '.URL_API.'key.php';



            if($cle) {
                if(!getCle($cle)) {
                    $message = 'Token inconnu.'.$token_declaration;
                }
            } else {
                $message = 'Token d\'autorisation manquant. Vous devez envoyer un token d\'autorisation dans les headers de votre appel. Exemple : {"Authorization":"montoken"}.'.$token_declaration;
            }

            if(!$message) {
                if(in_array($route, $routes_publiques)!==false) {
                    $granted = true;
                } else if($session_token) {
                    if($session = getSession($session_token)) {
                        $granted=true;
                        if($member = member_get($session['member_hash'],'hash')) {
                            $GLOBALS['membre'] = $member;
                            $GLOBALS['token'] = $session_token;
                        }
                    } else {
                        $message='Cet identifiant de session n\'est pas valide.';
                    }
                } else {
                    $message = 'Vous devez passer un identifiant de session en paramètre de votre appel';
                }
            }
        }
        if($request->getMethod() == 'OPTIONS') {
            $granted=true;
        }

        if($granted) {
            if(!count($_POST)) {
                $_POST = json_decode(file_get_contents("php://input"),true);
            }
            
            return $next($request, $response);
        } else {
            return $response->withStatus(401)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode(array('message'=>$message)));
        }
    }
}


