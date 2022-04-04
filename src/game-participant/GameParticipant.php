<?php

class GameParticipant {

  private $gameId;
  private $participantCpf;

  public function __construct($gameId, $participantCpf) {
    $this->setGameId($gameId);
    $this->setParticipantCPF($participantCpf);
  }

  public function validate() : bool {
    if(isset($this->gameId) && isset($this->participantCpf)) {
      return true;
    }

    return false;
  }

  public function setGameId($gameId) {
    $this->gameId = $gameId;
  }

  public function getGameId() {
    return $this->gameId;
  }

  public function setParticipantCPF($participantCpf) {
    $this->participantCpf = $participantCpf;
  }

  public function getParticipantCPF() {
    return $this->participantCpf;
  }
}

?>
