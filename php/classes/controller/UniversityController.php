<?php
/**
 * Created by IntelliJ IDEA.
 * User: oscar
 * Date: 26/07/16
 * Time: 08:43 AM
 */
class UniversityController extends Controller
{
    public function requestDataAction(){
        /*$Request=$this->getJsonRequest()*/
        $Universities= UniversityDAO::getUniversities();
        $this->sendCompressedJson($Universities);
    }
}