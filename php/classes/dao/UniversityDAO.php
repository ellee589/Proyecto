<?php
/**
 * Created by IntelliJ IDEA.
 * User: oscar
 * Date: 26/07/16
 * Time: 01:27 PM
 */
class UniversityDAO {

    public static function UniversityFromVar($Var){
        $University=new University();
        $University->setUniversityId($Var['id']);
        $University->setUniversityName($Var['universidad']);
        return $University;
    }

    public static function getUniversities() {
        $Universities=array();
        $Query="select * from Universidades";
        $DB=DB::getInstance();
        $Result=$DB->Select($Query);
        $DB->Close();
        foreach($Result as $Row){
            $University=self::UniversityFromVar($Row);
            $Universities[]=$University;
        }
        return $Universities;
    }
}
