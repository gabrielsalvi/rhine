<?php

class SportCenterMapper {
    
    public static function toModel($array) : SportCenter {
        require_once 'SportCenter.php';
        $sportCenter = new SportCenter();

        $sportCenter->setName($array['name']);
        $sportCenter->setDescription($array['description']);
        $sportCenter->setCNPJ($array['cnpj']);
        $sportCenter->setUsername($array['username']);
        $sportCenter->setEmail($array['email']);
        $sportCenter->setPassword($array['password']);
        $sportCenter->setOpenHour($array['openHour']);
        $sportCenter->setCloseHour($array['closeHour']);         

        return $sportCenter;
    }
    
    public static function toEntity($array) : SportCenter {
        require_once 'SportCenter.php';
        $sportCenter = new SportCenter();

        $sportCenter->setName($array['nome']);
        $sportCenter->setDescription($array['descricao']);
        $sportCenter->setCNPJ($array['cnpj']);
        $sportCenter->setUsername($array['username']);
        $sportCenter->setEmail($array['email']);
        $sportCenter->setPassword($array['senha']);
        $sportCenter->setOpenHour($array['horario_abertura']);
        $sportCenter->setCloseHour($array['horario_fechamento']);         

        return $sportCenter;
    }
}

?>