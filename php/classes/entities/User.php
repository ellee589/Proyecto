<?php

class User implements SessionUser, JsonSerializable  {
    private $UserId = NULL;
    
    public function getUserId() {
        return $this->UserId;
    }

    public function setUserId($UserId) {
        $this->UserId = $UserId;
    }
    
    public function getPassword() {
        
    }

    public function getUserLogin() {
        
    }

    public function hasProfile($ProfileId) {
        
    }

    public function setPassword($Password) {
        
    }

    public function setUserLogin($UserLogin) {
        
    }
    
    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

