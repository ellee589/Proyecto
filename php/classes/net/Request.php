<?php

// REQUIRES PHP_CURL EXTENSION

class Request {
    
    public static function sendPostRequest($Url, array $Parameters){
        $StringParams="";
        foreach($Parameters as $Param=>$Value){
            $StringParams.=$Param."=".urlencode($Value)."&";
        }
        if(strlen($StringParams) > 0) rtrim($StringParams,"&");
        $Request=curl_init($Url);
        curl_setopt($Request,CURLOPT_POST, 1);
        curl_setopt($Request,CURLOPT_POSTFIELDS, $StringParams);
        curl_setopt($Request,CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($Request,CURLOPT_VERBOSE, 1);
        $Response=curl_exec($Request);
        curl_close($Request);
        return $Response;
    }
    
}

