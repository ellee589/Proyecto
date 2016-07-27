<?php

//GLOBAL CONFIG
require_once "php/config.php";
//CLASS AUTOLOADING FUNCTIONS
require_once "php/autoload.php";
//Global Actions
require_once 'php/actions.php';

global $APP_ACTIONS;

session_start();

$RequestedAction=filter_input(INPUT_POST, "action");

if(!$RequestedAction){
    $RequestedAction=filter_input(INPUT_GET, "action");
}

if(array_key_exists($RequestedAction, $APP_ACTIONS)){
    $Class=$APP_ACTIONS[$RequestedAction];
    $Class->proccessRequest();
} else { 
    header("X-Error-Message: 500 Action not Found: {$RequestedAction}", true, 500);
}


