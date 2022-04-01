<?php

class Game {
    
    private $id;
    private $date;
    private $startHour;
    private $endHour;
    private $price;
    private $cnpj;
    private $sportId;
    
    public function validate() : bool {
        if(isset($this->date) && isset($this->startHour) && isset($this->endHour)
          && isset($this->price) && isset($this->cnpj) && isset($this->sportId)) {
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

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getStartHour() {
        return $this->startHour;
    }

    public function setStartHour($startHour) {
        $this->startHour = $startHour;
    }

    public function getEndHour() {
        return $this->endHour;
    }

    public function setEndHour($endHour) {
        $this->endHour = $endHour;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getCNPJ() {
        return $this->cnpj;
    }

    public function setCNPJ($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function getSportId() {
        return $this->sportId;
    }

    public function setSportId($sportId) {
        $this->sportId = $sportId;
    }
}

?>