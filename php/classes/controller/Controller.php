<?php

class Controller {
    
    protected function getGetParam($ParamName){
        $Val=filter_input(INPUT_GET, $ParamName);
        if($Val=="true") {
            $Val=true;
        }
        else if($Val=="false") {
            $Val=false;
        } else if(strlen($Val)<=0){
            $Val=NULL;
        }
        return $Val;
    }
    
    protected function getPostParam($ParamName){
        $Val=filter_input(INPUT_POST, $ParamName);
        if($Val=="true") {
            $Val=true;
        }
        else if($Val=="false") {
            $Val=false;
        } else if(strlen($Val)<=0){
            $Val=NULL;
        }
        return $Val;
    }
    
    protected function getParam($ParamName){
        $Value=$this->getPostParam($ParamName);
        if(gettype($Value)=="NULL"){
            $Value=$this->getGetParam($ParamName);
        }
        return $Value;
    }
    
    protected function getJsonRequest(){
        return json_decode(file_get_contents('php://input'));
    }
    
    public function getSessionValue($SessionName){
        if(array_key_exists($SessionName, $_SESSION) && strlen($_SESSION[$SessionName])>0){
            $Value=unserialize($_SESSION[$SessionName]);
        }
        else {
            $Value=NULL;
        }
        return $Value; 
    }
    
    public function setSessionValue($SessionName, $SessionValue){
        $_SESSION[$SessionName]=serialize($SessionValue);
    }
    
    public function getFileParam($ParamName){
        return $_FILES[$ParamName];
    }
    
    public function getRequestAddress(){
        $Address="";
        if(filter_input(INPUT_SERVER, "HTTP_CLIENT_IP")!==NULL){
            $Address=filter_input(INPUT_SERVER, "HTTP_CLIENT_IP");
        } else if(filter_input(INPUT_SERVER, "HTTP_X_FORWARDED_FOR")!==NULL){
            $Address=filter_input(INPUT_SERVER, "HTTP_X_FORWARDED_FOR");
        } else {
            $Address=filter_input(INPUT_SERVER, "REMOTE_ADDR");
        }
        return $Address;
    }
    
    public function redirect($Location){
        header("Location: $Location");
    }
    
    public function setHeader($Header, $Value){
        header("{$Header}: {$Value}");
    }
    
    protected function sendDownload($Stream, $Name, $ContentType="application/octet-stream"){
        $this->setHeader("Content-Type", $ContentType);
        $this->setHeader("Content-Disposition", "attachment; filename={$Name}");
        $this->setHeader("Content-Length", strlen($Stream));
        $this->setHeader("Content-Transfer-Encoding", "binary");
        echo $Stream;
    }
    
    protected function sendView($ViewLocation, VariableHolder $Vars=NULL, $ContentType="text/html"){
        header("Content-type: $ContentType");
        include "$ViewLocation";
    }
    
    protected function sendCompressedView($ViewLocation, VariableHolder $Vars=NULL, $ContentType="text/html"){
        ob_start();
        include "$ViewLocation";
        $output=  ob_get_clean();
        $compressed_output=  gzencode($output);
        header("Content-type: $ContentType");
        header("Content-Encoding: gzip");
        echo $compressed_output;
    }
    
    protected function sendJson($Object=NULL){
        header("Content-type: application/json");
        $this->setHeader("Content-Disposition", "inline");
        $Encoded=json_encode($Object);
        echo $Encoded;
    }
    
    protected function sendCompressedJson($Object=NULL){
        $compressed_output=  gzencode(json_encode($Object));
        header("Content-type: application/json");
        $this->setHeader("Content-Disposition", "inline");
        header("Content-Encoding: gzip");
        echo $compressed_output;
    }
    
    protected function outString($String){
        return htmlentities($String, ENT_SUBSTITUTE, "utf-8");
    }
    
    public function sendHttpStatus($StatusCode=500, $Message="Internal Servel Error"){
        $Message=  utf8_decode($Message);
        header("X-Error-Message: $Message", true, $StatusCode);
    }
    
    public function proccessRequest(){
        $Action=$this->getParam("action");
        $Method=$Action."Action";
        $this->$Method();
    }
}