<?php

class Sport {
    
    private $id;
    private $description;
    private $numberOfParticipants;
    
    public function validate() : bool {
        if(isset($this->description) && isset($this->numberOfParticipants)) {
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

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getNumberOfParticipants() {
        return $this->numberOfParticipants;
    }

    public function setNumberOfParticipants($numberOfParticipants) {
        $this->numberOfParticipants = $numberOfParticipants;
    }
}

?>