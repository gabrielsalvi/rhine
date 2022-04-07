<?php

    class CityRepository {
        
        public function create(City $city) : bool {
            if ($city->validate()) {
                $db = Database::getConnection();
        
                $sql = 'INSERT INTO cidades (nome, id_estado) VALUES (:nome, :estado);';
        
                $stmt = $db->prepare($sql);

                $stmt->bindParam(':nome', $city->getName());
                $stmt->bindParam(':estado', $city->getStateId());
        
                $stmt->execute();
    
                return true;
            }
    
            return false;
        }

        public function getCityByNameAndState($name, $stateId) {
            require_once 'CityMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM cidades WHERE nome = :city and id_estado = :stateId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':city', $name);
            $stmt->bindParam(':stateId', $stateId);
            $stmt->execute();

            $cityData = $stmt->fetch();

            if ($cityData) {
                $city = CityMapper::toEntity($cityData);
                return $city;
            }

            return null;
        }
    }   

?>