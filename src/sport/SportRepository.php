<?php

    class SportRepository {

        public function create(Sport $sport) : bool {
            if ($sport->validate()) {
                $db = Database::getConnection();
        
                $sql = 'INSERT INTO esportes (id, descricao, qtd_atletas) 
                        VALUES (:id, :_description, :numberOfParticipants);';
        
                $stmt = $db->prepare($sql);
            
                $stmt->bindParam(':id', $sport->getId());
                $stmt->bindParam(':_description', $sport->getDescription());
                $stmt->bindParam(':numberOfParticipants', $sport->getNumberOfParticipants());
        
                $stmt->execute();

                return true;
            }

            return false;
        }

        public function getSportById($id) {

            require 'SportMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM esportes WHERE id = :id;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $sportData = $stmt->fetch();
            $sport = SportMapper::toEntity($sportData);

            return $sport;
        }

        public function getSports() {

            require 'SportMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM esportes ORDER BY descricao ASC;";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $sportsData = $stmt->fetchAll();

            $sports = [];

            foreach ($sportsData as $sportData) {
                $sport = SportMapper::toEntity($sportData);
                array_push($sports, $sport);
            }

            return $sports;
        }

    }

?>