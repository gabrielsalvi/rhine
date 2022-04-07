<?php

class AthleteRepository {

    public function create(Athlete $athlete) {
        $db = Database::getConnection();

        $sql = 'INSERT INTO atletas (cpf, nome, sobrenome, dtnascimento, username, email, senha, id_cidade) 
                VALUES (:cpf, :firstname, :lastname, :birthdate, :username, :email, :_password, :cityId);';

        $stmt = $db->prepare($sql);

        $hash = password_hash($athlete->getPassword(), PASSWORD_DEFAULT);

        $stmt->bindParam(':cpf', $athlete->getCPF());
        $stmt->bindParam(':firstname', $athlete->getFirstName());
        $stmt->bindParam(':lastname', $athlete->getLastName());
        $stmt->bindParam(':birthdate', $athlete->getBirthdate());
        $stmt->bindParam(':username', $athlete->getUsername());
        $stmt->bindParam(':email', $athlete->getEmail());
        $stmt->bindParam(':_password', $hash);
        $stmt->bindParam(':cityId', $athlete->getCityId());

        $stmt->execute();
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


    public function update(Athlete $athlete, $cpf) {
        $db = Database::getConnection();

        $sql = 'UPDATE atletas SET nome = :firstname, sobrenome = :lastname, dtnascimento = :birthdate, 
                username = :username, email = :email WHERE cpf = :cpf;';

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':firstname', $athlete->getFirstName());
        $stmt->bindParam(':lastname', $athlete->getLastName());
        $stmt->bindParam(':birthdate', $athlete->getBirthdate());
        $stmt->bindParam(':username', $athlete->getUsername());
        $stmt->bindParam(':email', $athlete->getEmail());
        $stmt->bindParam(':cpf', $cpf);

        $stmt->execute();
    }
}

?>