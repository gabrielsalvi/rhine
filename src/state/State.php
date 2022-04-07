<?php

class State {
    
    private $id;
    private $name;
    private $abbreviation;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAbbreviation() {
        return $this->abbreviation;
    }

    public function setAbbreviation($abbreviation) {
        $this->abbreviation = $abbreviation;
    }
}

?>