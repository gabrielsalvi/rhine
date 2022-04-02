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
            require_once 'GameMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM partidas WHERE cnpj = :cnpj;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':cnpj', $cnpj);

            $stmt->execute();

            $gamesData = $stmt->fetchAll();

            $games = [];

            foreach ($gamesData as $gameData) {
                $game = GameMapper::toEntity($gameData);
                array_push($games, $game);
            }

            return $games;
        }

        public function getGames() {
            require_once 'GameMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM partidas;";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $gamesData = $stmt->fetchAll();

            $games = [];

            foreach ($gamesData as $gameData) {
                $game = GameMapper::toEntity($gameData);
                array_push($games, $game);
            }

            return $games;
        }

        public function getSport($sportId) {
            require_once __DIR__ . '../../sport/SportRepository.php';
            $sportRepository = new SportRepository();

            return $sportRepository->getSportById($sportId);
        }

        public function getSportCenter($cnpj) {
            require_once __DIR__ . '../../sport-center/SportCenterRepository.php';
            $sportCenterRepository = new SportCenterRepository();

            return $sportCenterRepository->getSportCenterByCNPJ($cnpj);
        }

    }

?>