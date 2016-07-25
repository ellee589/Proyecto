<?php

class LoginController extends Controller {
    
    public function loginIndexAction(){
        $this->sendView("html/views/login/loginView.php");
    }
    
    public function LoginAction(){
        $Params=$this->getJsonRequest();
        $Usuario=UserDAO::getUserLogon($Params->User, $Params->Password);
        if($Usuario!==NULL){
            $this->setSessionValue("user", $Usuario);
            $this->sendCompressedJson($Usuario);
        } else {
            $this->sendHttpStatus(500, "Nombre de Usuario o contraseña incorrectos");
        }
    }
    
    public function logoutAction(){
        $_SESSION = array();
        // sends as Set-Cookie to invalidate the session cookie
        if (filter_input(INPUT_COOKIE, session_name())!=NULL) { 
            $params = session_get_cookie_params();
            setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
        }
        session_destroy();
        $this->redirect("loginIndex.do");
    }
    
    public function checkAuthAction(){
        if(!Auth::validSession()) return;
        $User=$this->getSessionValue("user");
        $this->sendCompressedJson($User);
    }
    
}

