<?php
/**
 * Description of Location
 * @author brijeshdhaker
 */
class Location {
    //
    var $addrOne;
    //
    var $addrTwo;
    //
    var $city;
    //
    var $postalCode;
    //
    var $state;
    //
    var $country;
    
    function getAddrOne() {
        return $this->addrOne;
    }

    function getAddrTwo() {
        return $this->addrTwo;
    }

    function getCity() {
        return $this->city;
    }

    function getPostalCode() {
        return $this->postalCode;
    }

    function getState() {
        return $this->state;
    }

    function getCountry() {
        return $this->country;
    }

    function setAddrOne($addrOne) {
        $this->addrOne = $addrOne;
    }

    function setAddrTwo($addrTwo) {
        $this->addrTwo = $addrTwo;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    function setState($state) {
        $this->state = $state;
    }

    function setCountry($country) {
        $this->country = $country;
    }


}
