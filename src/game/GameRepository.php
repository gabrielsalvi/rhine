<?php

    class GameRepository {

        public function create(Game $game) : bool {
            if ($game->validate()) {
                $db = Database::getConnection();
        
                $sql = 'INSERT INTO partidas (cnpj, id_esporte, data, hora_inicio, hora_termino, valor) 
                        VALUES (:cnpj, :sport, :_date, :_start, :_end, :price);';
        
                $stmt = $db->prepare($sql);
            
                $stmt->bindParam(':cnpj', $game->getCNPJ());
                $stmt->bindParam(':sport', $game->getSportId());
                $stmt->bindParam(':_date', $game->getDate());
                $stmt->bindParam(':_start', $game->getStartHour());
                $stmt->bindParam(':_end', $game->getEndHour());
                $stmt->bindParam(':price', $game->getPrice());
        
                $stmt->execute();

                return true;
            }

            return false;
        }

        public function getGamesByCNPJ($cnpj) {

            require 'GameMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM games WHERE cnpj = :cnpj;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->execute();

            $gameData = $stmt->fetch();
            $game = GameMapper::toEntity($gameData);

            return $game;
        }

    }

?>