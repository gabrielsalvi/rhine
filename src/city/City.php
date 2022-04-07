<?php

class City {
    
    private $id;
    private $name;
    private $stateId;
    
    public function validate() : bool {
        if(isset($this->name) && isset($this->stateId)) {
            return true;
        }
    
        return false;
    }

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

    public function getStateId() {
        return $this->stateId;
    }

    public function setStateId($stateId) {
        $this->stateId = $stateId;
    }
}

?>