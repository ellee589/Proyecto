<?php

class VariableHolder implements JsonSerializable{

    protected $Attributes = array();

    public function __set($Attribute, $Value) {
        /*if (!array_key_exists($Attribute, $this->Attributes)) {
            $trace = debug_backtrace();
            error_log("Error setting: ${Attribute}", 0);
            return;
        }*/
        $this->Attributes[$Attribute] = $Value;
    }

    public function __get($Attribute) {
        if (array_key_exists($Attribute, $this->Attributes)) {
            return $this->Attributes[$Attribute];
        }
        return null;
    }

    public function __isset($Attribute) {
        return isset($this->Attributes[$Attribute]);
    }

    public function __unset($Attribute) {
        unset($this->Attributes[$Attribute]);
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}
