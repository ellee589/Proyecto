<?php

class Auth {
    
    public static function validSession($AllowedProfiles=NULL){
        $Controller=new Controller();
        $Usuario=$Controller->getSessionValue("user");
        if($Usuario==NULL){
            $Controller->redirect("logout.do");
            $Controller->setHeader("X-Session-Status", "Timeout");
            $Controller->sendHttpStatus(419, "Su Sesion ha expirado");
            return false;
        }
        /*if($AllowedProfiles!=NULL && array_search($Usuario->get, $AllowedProfiles)===false){
            $Controller->setHeader("X-Session-Status", "Accion no permitida");
            $Controller->sendHttpStatus(403, "Accion no permitida");
            return false;
        }*/
        return true;
    }
    
}
