<?php

class Game {
    
    private $id;
    private $date;
    private $startHour;
    private $endHour;
    private $price;
    private $sportCenter;
    private $sport;
    
    public function validate() : bool {
        if(isset($this->date) && isset($this->startHour) && isset($this->endHour)
          && isset($this->price) && isset($this->sportCenter) && isset($this->sport)) {
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

    public function getFormattedDate() {
        return date('d/m/y', strtotime($this->date));
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getStartHour() {
        return $this->startHour;
    }

    public function setStartHour($startHour) {
        $this->startHour = date('H:i', strtotime($startHour));
    }

    public function getEndHour() {
        return $this->endHour;
    }

    public function setEndHour($endHour) {
        $this->endHour = date('H:i', strtotime($endHour));
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getSportCenter() {
        return $this->sportCenter;
    }

    public function setSportCenter($sportCenter) {
        $this->sportCenter = $sportCenter;
    }

    public function getSport() {
        return $this->sport;
    }

    public function setSport($sport) {
        $this->sport = $sport;
    }
}

?>