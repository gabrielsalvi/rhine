<?php

    class SportCenterRepository {

        public function create(SportCenter $sportCenter) : bool {
            if ($sportCenter->validate()) {
                $db = Database::getConnection();
        
                $sql = 'INSERT INTO estabelecimentos (cnpj, nome, descricao, username, email, senha, horario_abertura, horario_fechamento) 
                        VALUES (:cnpj, :_name, :_description, :username, :email, :_password, :open_hour, :close_hour);';
        
                $stmt = $db->prepare($sql);
    
                $hash = password_hash($sportCenter->getPassword(), PASSWORD_DEFAULT);
        
                $stmt->bindParam(':cnpj', $sportCenter->getCNPJ());
                $stmt->bindParam(':_name', $sportCenter->getName());
                $stmt->bindParam(':_description', $sportCenter->getDescription());
                $stmt->bindParam(':username', $sportCenter->getUsername());
                $stmt->bindParam(':email', $sportCenter->getEmail());
                $stmt->bindParam(':_password', $hash);
                $stmt->bindParam(':open_hour', $sportCenter->getOpenHour());
                $stmt->bindParam(':close_hour', $sportCenter->getCloseHour());
        
                $stmt->execute();

                return true;
            }

            return false;
        }

        public function getSportCenterByCNPJ($cnpj) {
            require_once 'SportCenterMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM estabelecimentos WHERE cnpj = :cnpj;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->execute();

            $sportCenterData = $stmt->fetch();
            $sportCenter = SportCenterMapper::toEntity($sportCenterData);

            return $sportCenter;
        }

        public function getSportCenterByEmail($email) {
            require_once 'SportCenterMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM estabelecimentos WHERE email = :email;";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $sportCenterData = $stmt->fetch();
            $sportCenter = SportCenterMapper::toEntity($sportCenterData);

            return $sportCenter;
        }
    }

?>