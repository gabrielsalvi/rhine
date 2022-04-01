<?php

class GameMapper {
    
    public static function toModel($array, $cnpj) : Game {

        require_once 'Game.php';
        $game = new Game();

        $game->setDate($array['match-date']);
        $game->setStartHour($array['start-time']);
        $game->setEndHour($array['end-time']);
        $game->setPrice($array['price']);
        $game->setCNPJ($cnpj);
        $game->setSportId($array['sport']);   

        return $game;
    }
    
    public static function toEntity($array) : Game {

        require_once 'Game.php';
        $game = new Game();

        $game->setId($array['id']);
        $game->setDate($array['data']);
        $game->setStartHour($array['hora_inicial']);
        $game->setEndHour($array['hora_final']);
        $game->setPrice($array['valor']);
        $game->setCNPJ($array['cnpj']);
        $game->setSportId($array['password']);

        return $game;
    }
}

?>