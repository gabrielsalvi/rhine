<?php

    class AthleteRepository {

        public function create(Athlete $athlete) : bool {
            if ($athlete->validate()) {
                $db = Database::getConnection();
        
                $sql = 'INSERT INTO atletas (cpf, nome, sobrenome, dtnascimento, username, email, senha) 
                        VALUES (:cpf, :firstname, :lastname, :birthdate, :username, :email, :_password);';
        
                $stmt = $db->prepare($sql);
    
                $hash = password_hash($athlete->getPassword(), PASSWORD_DEFAULT);
        
                $stmt->bindParam(':cpf', $athlete->getCPF());
                $stmt->bindParam(':firstname', $athlete->getFirstName());
                $stmt->bindParam(':lastname', $athlete->getLastName());
                $stmt->bindParam(':birthdate', $athlete->getBirthdate());
                $stmt->bindParam(':username', $athlete->getUsername());
                $stmt->bindParam(':email', $athlete->getEmail());
                $stmt->bindParam(':_password', $hash);
        
                $stmt->execute();

                return true;
            }

            return false;
        }

        public function getAthleteByCPF($cpf) {

            require_once 'AthleteMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM atletas WHERE cpf = :cpf;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();

            $athleteData = $stmt->fetch();
            $athlete = AthleteMapper::toEntity($athleteData);

            return $athlete;
        }

        public function getAthleteByEmail($email) {
            
            require_once 'AthleteMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM atletas WHERE email = :email;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $athleteData = $stmt->fetch();
            $athlete = AthleteMapper::toEntity($athleteData);

            return $athlete;
        }
    }

?>