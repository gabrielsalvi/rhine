<?php

    class GameParticipantRepository {

        public function create(GameParticipant $gameParticipant) : bool {
            if ($gameParticipant->validate()) {
                $db = Database::getConnection();
    
                $sql = 'INSERT INTO partida_atletas (id_partida, cpf) VALUES (:game_id, :cpf);';
    
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
                
            $sql = 'SELECT * FROM partida_atletas WHERE id_partida = :game_id AND cpf = :cpf;';
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':game_id', $gameId);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
    
            $participantOfGame = $stmt->fetch();

            return $participantOfGame;
        }

        public function getNumberOfGameParticipants($gameId) {
            $db = Database::getConnection();
                
            $sql = 'SELECT count(*) as number_of_game_participants FROM partida_atletas WHERE id_partida = :game_id;';
    
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':game_id', $gameId);
            $stmt->execute();
    
            $numberOfGameParticipants = $stmt->fetch()['number_of_game_participants'];

            return $numberOfGameParticipants;
        }
    }

?>