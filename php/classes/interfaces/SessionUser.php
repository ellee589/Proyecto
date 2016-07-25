<?php

interface SessionUser {
    
    public function getUserLogin();
    public function setUserLogin($UserLogin);
    public function getPassword();
    public function setPassword($Password);
    public function hasProfile($ProfileId);
    
}
