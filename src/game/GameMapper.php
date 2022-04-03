<?php

class GameMapper {
    
    public static function toModel($array, $sportCenter) : Game {

        require_once 'Game.php';
        $game = new Game();

        $game->setDate($array['match-date']);
        $game->setStartHour($array['start-time']);
        $game->setEndHour($array['end-time']);
        $game->setPrice($array['price']);
        $game->setSportCenter($sportCenter);
        $game->setSport($array['sport']);

        return $game;
    }
    
    public static function toEntity($array, $sportCenter, $sport) : Game {

        require_once 'Game.php';
        $game = new Game();

        $game->setId($array['id']);
        $game->setDate($array['data']);
        $game->setStartHour($array['hora_inicio']);
        $game->setEndHour($array['hora_termino']);
        $game->setPrice($array['valor']);
        $game->setSportCenter($sportCenter);
        $game->setSport($sport);

        return $game;
    }
}

?>