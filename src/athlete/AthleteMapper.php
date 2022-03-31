<?php

class AthleteMapper {
    
    public static function toModel($array) : Athlete {

        require_once 'Athlete.php';
        $athlete = new Athlete();

        $athlete->setFirstName($array['first-name']);
        $athlete->setLastName($array['last-name']);
        $athlete->setCPF($array['cpf']);
        $athlete->setBirthdate($array['birthdate']);
        $athlete->setUsername($array['username']);
        $athlete->setEmail($array['email']);
        $athlete->setPassword($array['password']);        

        return $athlete;
    }
    
    public static function toEntity($array) : Athlete {

        require_once 'Athlete.php';
        $athlete = new Athlete();

        $athlete->setFirstName($array['nome']);
        $athlete->setLastName($array['sobrenome']);
        $athlete->setCPF($array['cpf']);
        $athlete->setBirthdate($array['dtnascimento']);
        $athlete->setUsername($array['username']);
        $athlete->setEmail($array['email']);
        $athlete->setPassword($array['senha']);

        return $athlete;
    }
}

?>