<?php

$BaseDir=dirname(__FILE__);
$ClassPath="{$BaseDir}/classes";


foreach(explode(PATH_SEPARATOR,$ClassPath) as $Path){
    $DirContent=scandir($Path);
    if($DirContent!==false){
        foreach($DirContent as $Entry){
            $FullEntry=$Path.DIRECTORY_SEPARATOR.$Entry;
            if(is_dir($FullEntry)){
                set_include_path(get_include_path(). PATH_SEPARATOR . $FullEntry);
            }
        }
    }
}

function project_autoloader($Class){
    include_once "{$Class}.php";
}
spl_autoload_register('project_autoloader');

include_once "{$BaseDir}/libraries/PHPExcel/Classes/PHPExcel.php";