<?php
/**
 * Description of Company
 * @author brijeshdhaker
 */
class Company {
    
    var $href;
    var $id;
    var $name;
    var $compURL;
    
    function getHref() {
        return $this->href;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getCompURL() {
        return $this->compURL;
    }

    function setHref($href) {
        $this->href = $href;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCompURL($compURL) {
        $this->compURL = $compURL;
    }
    
}
