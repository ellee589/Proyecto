<?php

class Functions {
    
    public static function yearsDiff($Date1, $Date2){
        $Date1=new DateTime($Date1);
        $Date2=new DateTime($Date2);
        $Diff=$Date1->diff($Date2, true);
        return $Diff->y;
    }
    
    public static function monthsDiff($Date1, $Date2){
        $Date1=new DateTime($Date1);
        $Date2=new DateTime($Date2);
        $Diff=$Date1->diff($Date2, true);
        $Months=$Diff->y*12;
        $Months+=$Diff->m;
        return $Months;
    }
    
    public static function daysDiff($Date1, $Date2){
        $Date1=new DateTime($Date1);
        $Date2=new DateTime($Date2);
        $Diff=$Date1->diff($Date2, true);
        $Days=$Diff->format("%a");
        return $Days;
    }
    
    public static function dateBetween($DateRef1, $DateRef2, $Date){
        $DateRef1=new DateTime($DateRef1);
        $DateRef2=new DateTime($DateRef2);
        $Date=new DateTime($Date);
        $DateRef1=$DateRef1->getTimestamp();
        $DateRef2=$DateRef2->getTimestamp();
        $Date=$Date->getTimestamp();
        return ($Date>=$DateRef1 && $Date<=$DateRef2);
    }
    
    public static function randomString($Length){
        $Now=new DateTime();
        $Hash=  sha1($Now->getTimestamp());
        return strtoupper(substr($Hash, 0, $Length));
    }
    
    public static function convertArrayToHash($ObjectArray, $HashMethod){
        $Hash=array();
        foreach($ObjectArray as $Object){
            $Hash[$Object->$HashMethod()]=$Object;
        }
        return $Hash;
    }
    
    public static function log($Var){
        error_log("\n\n********************\n ".print_r($Var,true)." \n********************\n\n");
    }
    
}

