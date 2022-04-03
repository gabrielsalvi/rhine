<?php

class SportMapper {
    
    public static function toEntity($array) : Sport {
        require_once 'Sport.php';
        $sport = new Sport();

        $sport->setId($array['id']);
        $sport->setDescription($array['descricao']);
        $sport->setNumberOfParticipants($array['qtd_atletas']);

        return $sport;
    }
}

?>