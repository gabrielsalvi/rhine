<?php

    class GameRepository {

        public function create(Game $game) : bool {
            if ($game->validate()) {
                $db = Database::getConnection();
        
                $sql = 'INSERT INTO partidas (cnpj, id_esporte, data, hora_inicio, hora_termino, valor) 
                        VALUES (:cnpj, :sport, :_date, :_start, :_end, :price);';
        
                $stmt = $db->prepare($sql);
            
                $stmt->bindParam(':cnpj', $game->getSportCenter());
                $stmt->bindParam(':sport', $game->getSport());
                $stmt->bindParam(':_date', $game->getDate());
                $stmt->bindParam(':_start', $game->getStartHour());
                $stmt->bindParam(':_end', $game->getEndHour());
                $stmt->bindParam(':price', $game->getPrice());
        
                $stmt->execute();

                return true;
            }

            return false;
        }

        public function getGames() {
            require_once 'GameMapper.php';
            require_once __DIR__ . '/../sport-center/SportCenterMapper.php';
            require_once __DIR__ . '/../sport/SportMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT p.id, p.data, p.hora_inicio, p.hora_termino, p.valor, 
            est.nome, esp.descricao, esp.qtd_atletas FROM partidas p 
            INNER JOIN estabelecimentos est ON (p.cnpj = est.cnpj) 
            INNER JOIN esportes esp ON (p.id_esporte = esp.id);";
            
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $gamesData = $stmt->fetchAll();
            $games = [];

            foreach ($gamesData as $gameData) {
                $sportCenter = SportCenterMapper::toEntityIntoGame($gameData);
                $sport = SportMapper::toEntityIntoGame($gameData); 

                $game = GameMapper::toEntity($gameData, $sportCenter, $sport);
                array_push($games, $game);
            }

            return $games;
        }

        public function getGamesByCNPJ($cnpj) {
            require_once 'GameMapper.php';
            require_once __DIR__ . '/../sport-center/SportCenterMapper.php';
            require_once __DIR__ . '/../sport/SportMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT p.id, p.data, p.hora_inicio, p.hora_termino, p.valor, 
            est.nome, esp.descricao, esp.qtd_atletas FROM partidas p 
            INNER JOIN estabelecimentos est ON (p.cnpj = est.cnpj) 
            INNER JOIN esportes esp ON (p.id_esporte = esp.id)
            WHERE est.cnpj = :cnpj;";
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->execute();

            $gamesData = $stmt->fetchAll();
            $games = [];

            foreach ($gamesData as $gameData) {
                $sportCenter = SportCenterMapper::toEntityIntoGame($gameData);
                $sport = SportMapper::toEntityIntoGame($gameData); 

                $game = GameMapper::toEntity($gameData, $sportCenter, $sport);
                array_push($games, $game);
            }

            return $games;
        }
    }

?>