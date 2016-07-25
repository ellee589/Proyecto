<?php

class UserDAO {

    public static function getUserLogon($UserName, $Password){
        if($UserName=="user" && $Password=="password"){
            $User=new User();
            $User->setUserId(1);
            return $User;
        } else {
            return NULL;
        }
    }
}
