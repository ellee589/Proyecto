<?php

class IndexController extends Controller {
    
    public function indexAction(){
        if(Auth::validSession()){
            $this->redirect("app.html");
        }
    }
    

    
}

