<?php

// The actions File used to determine the controller and 
// the method to execute

$IndexController=new IndexController();
$APP_ACTIONS["index"]=$IndexController;

// Acciones para inicio/cierre de Sesion
$LoginController=new LoginController();
$APP_ACTIONS["checkAuth"]=$LoginController;
$APP_ACTIONS["loginIndex"]=$LoginController;
$APP_ACTIONS["login"]=$LoginController;
$APP_ACTIONS["logout"]=$LoginController;