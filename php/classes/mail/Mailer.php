<?php

// REQUIRES PHP_MAIL (PEAR) EXTENSION

require_once 'Mail.php';
require_once 'Mail/mime.php';

class Mailer {
    
    public static function sendTextMail($Subject, $Body, array $Destination, $Charset="UTF-8"){
        global $SMTP_FROM, $SMTP_HOST, $SMTP_USER, $SMTP_PASSWORD, $SMTP_PORT;
        $txtDestination=  implode(",", $Destination);
        $Headers= array (
            'From' => $SMTP_FROM,
            'To' => $txtDestination,
            'Subject' => $Subject,
            'Content-Type' => 'text/plain; charset="'.$Charset.'"'
        );
        $SMTP = Mail::factory(
            'smtp',
            array (
                'host' => $SMTP_HOST,
                'port' => $SMTP_PORT,
                'auth' => true,
                'username' => $SMTP_USER,
                'password' => $SMTP_PASSWORD,
                'debug' => false,
            )
        );
        
        $Mail = $SMTP->send($txtDestination, $Headers, $Body);
    }
    
    public static function sendHTMLMail($Subject, $Body, array $Destination, $Charset="UTF-8"){
        global $SMTP_FROM, $SMTP_HOST, $SMTP_USER, $SMTP_PASSWORD, $SMTP_PORT;
        $txtDestination=  implode(",", $Destination);
        $Headers= array (
            'From' => $SMTP_FROM,
            'To' => $txtDestination,
            'Subject' => $Subject,
            'Content-Type' => 'text/plain; charset="'.$Charset.'"'
        );
        $SMTP = Mail::factory(
            'smtp',
            array (
                'host' => $SMTP_HOST,
                'port' => $SMTP_PORT,
                'auth' => true,
                'username' => $SMTP_USER,
                'password' => $SMTP_PASSWORD,
                'debug' => false,
            )
        );
        
        $MimeMail=new Mail_mime();
        $MimeMail->setHTMLBody($Body);
        $Body=$MimeMail->get();
        $Headers=$MimeMail->headers($Headers);
        
        $Mail = $SMTP->send($txtDestination, $Headers, $Body);
    }
    
}
