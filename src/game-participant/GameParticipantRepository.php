<?php

    class GameParticipantRepository {

        public function create(GameParticipant $gameParticipant) : bool {
            if ($gameParticipant->validate()) {
                $db = Database::getConnection();
    
                $sql = 'INSERT INTO participantes_partida (id_partida, cpf) VALUES (:game_id, :cpf);';
    
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':game_id', $gameParticipant->getGameId());
                $stmt->bindParam(':cpf', $gameParticipant->getParticipantCPF());
                $stmt->execute();

                return true;
            }

            return false;
        }

        public function getParticipantOfGame($gameId, $cpf) {
            $db = Database::getConnection();
                
            $sql = 'SELECT * FROM participantes_partida WHERE id_partida = :game_id AND cpf = :cpf;';
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':game_id', $gameId);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
    
            $participantOfGame = $stmt->fetch();

            return $participantOfGame;
        }

        public function getNumberOfGameParticipants($gameId) {
            $db = Database::getConnection();
                
            $sql = 'SELECT count(*) as participants_number FROM participantes_partida WHERE id_partida = :game_id;';
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':game_id', $gameId);
            $stmt->execute();
    
            $numberOfGameParticipants = $stmt->fetch();

            return $numberOfGameParticipants['participants_number'];
        }
    }

?>