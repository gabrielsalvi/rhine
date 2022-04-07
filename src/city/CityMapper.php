<?php

class CityMapper {
    
    public static function toEntity($array) : City {
        require_once 'City.php';
        $city = new City();

        $city->setId($array['id']);
        $city->setName($array['nome']);
        $city->setStateId($array['id_estado']);

        return $city;
    }

    public static function toModel($array) : City {

        require_once 'City.php';
        $city = new City();

        $city->setName($array['city']);
        $city->setStateId($array['state']);

        return $city;
    }
}

?>