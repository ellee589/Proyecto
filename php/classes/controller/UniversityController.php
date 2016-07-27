<?php
/**
 * Created by IntelliJ IDEA.
 * User: oscar
 * Date: 26/07/16
 * Time: 08:43 AM
 */
class UniversityController extends Controller
{
    public function universityAction(){
        $Universities= UniversityDAO::getUniversities();
        $this->sendJson($Universities);
    }
}