<?php
/**
 * Description of Position
 * @author brijeshdhaker
 */
class Position {
    
    var $id;
    var $type;
    var $formattedLocation;
    var $title;
    var $location;
    
    function getId() {
        return $this->id;
    }

    function getType() {
        return $this->type;
    }

    function getFormattedLocation() {
        return $this->formattedLocation;
    }

    function getTitle() {
        return $this->title;
    }

    function getLocation() {
        return $this->location;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setFormattedLocation($formattedLocation) {
        $this->formattedLocation = $formattedLocation;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setLocation($location) {
        $this->location = $location;
    }
    
}
