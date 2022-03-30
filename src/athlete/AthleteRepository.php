<?php

    class AthleteRepository {

        public function create(Athlete $athlete) {

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
              
            }
          }
    }

?>