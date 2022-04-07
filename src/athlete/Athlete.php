<?php

class Athlete {

  private $firstName;
  private $lastName;
  private $cpf;
  private $birthdate;
  private $username;
  private $email;
  private $password;

  public function validate() : bool {

    if(isset($this->firstName) && isset($this->lastName) && isset($this->cpf) && isset($this->birthdate)
      && isset($this->username) && isset($this->email) && isset($this->password)) {
        return true;
    }

    return false;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function setCPF($cpf) {
    $this->cpf = $cpf;
  }

  public function getCPF() {
    return $this->cpf;
  }

  public function setBirthdate($birthdate) {
    $this->birthdate = $birthdate;
  }

  public function getBirthdate() {
    return $this->birthdate;
  }

  public function getFormattedBirthdate() {
    return date('d/m/y', strtotime($this->birthdate));
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
  
}

?>
