<?php

class StateMapper {
    
    public static function toEntity($array) : State {
        require_once 'State.php';
        $state = new State();

        $state->setId($array['id']);
        $state->setName($array['nome']);
        $state->setAbbreviation($array['sigla']);

        return $state;
    }
}

?>