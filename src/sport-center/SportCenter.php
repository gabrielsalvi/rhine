<?php

class SportCenter {

  private $name;
  private $description;
  private $cnpj;
  private $username;
  private $email;
  private $password;
  private $openHour;
  private $closeHour;

  public function validate() : bool {

    if(isset($this->name) && isset($this->description) && isset($this->cnpj) && isset($this->username)
      && isset($this->email) && isset($this->password) && isset($this->openHour) && isset($this->closeHour)) {
        return true;
    }

    return false;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setCNPJ($cnpj) {
    $this->cnpj = $cnpj;
  }

  public function getCNPJ() {
    return $this->cnpj;
  }

  public function setUsername($username) {
    $this->username = $username;
  }

  public function getUsername() {
    return $this->username;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getPassword() {
    return $this->password;
  }
  
  public function setOpenHour($openHour) {
    $this->openHour = date('H:i', strtotime($openHour));
  }

  public function getOpenHour() {
    return $this->openHour;
  }

  public function setCloseHour($closeHour) {
    $this->closeHour = date('H:i', strtotime($closeHour));
  }

  public function getCloseHour() {
    return $this->closeHour;
  }
}

?>
