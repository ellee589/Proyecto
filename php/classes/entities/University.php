<?php
/**
 * Created by IntelliJ IDEA.
 * User: oscar
 * Date: 26/07/16
 * Time: 02:14 PM
 */
class University implements JsonSerializable  {
    private $UniversityId = NULL;
    private $UniversityName = NULL;

    public function getUniversityId() {
        return $this->UniversityId;
    }

    public function setUniversityId($UniversityId) {
        $this->UniversityId = $UniversityId;
    }

    public function getUniversityName() {
        return $this->UniversityName;
    }

    public function setUniversityName($UniversityName) {
        $this->UniversityName = $UniversityName;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}