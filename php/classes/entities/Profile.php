<?php

class Profile {
    const ADMIN=1;

    private $ProfileId=NULL;
    private $Profile=NULL;

    function getProfileId() {
        return $this->ProfileId;
    }

    function getProfile() {
        return $this->Profile;
    }

    function setProfileId($ProfileId) {
        $this->ProfileId = $ProfileId;
    }

    function setProfile($Profile) {
        $this->Profile = $Profile;
    }
}
