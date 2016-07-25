<?php
//error_reporting(E_ERROR && E_WARNING);
error_reporting(E_ALL);
//error_reporting(E_ERROR);

//Database Connection
$DB_HOST="127.0.0.1";
$DB_USER="root";
$DB_PASSWORD="";
$DB_PORT="3306";
$DB_SCHEMA="";

//SMTP Config
$SMTP_FROM="From User <user@server.com>";
$SMTP_HOST="ssl://smtp.mailgun.org";
$SMTP_USER="postmaster@qibc.mx";
$SMTP_PASSWORD=""; 
$SMTP_PORT="465";

$ContextDir="evaluaciones";
$AppServer= "http://".filter_input(INPUT_SERVER, 'HTTP_HOST')."/$ContextDir";
?>