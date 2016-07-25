<?php

class BackgroundProcess {

    private $Command=NULL;
    private $OutputFile='/dev/null';
    private $PID;

    public function __construct($Command, $outputFile = '/dev/null') {
        $this->Command = $Command;
        $this->OutputFile=$outputFile;
    }

    public function run() {
        $RunCommand=sprintf('%s >> %s 2>&1 & echo $!', $this->Command, $this->OutputFile);
        $this->PID = shell_exec($RunCommand);
    }

    public function isRunning() {
        try {
            $result = shell_exec(sprintf('ps %d', $this->PID));
            if (count(preg_split("/\n/", $result)) > 2) {
                return true;
            }
        } catch (Exception $e) {
            
        }
        return false;
    }

    public function getPID() {
        return $this->PID;
    }

}
