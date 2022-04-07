<?php

    class StateRepository {

        public function getStates() {
            require_once 'StateMapper.php';

            $db = Database::getConnection();

            $sql = "SELECT * FROM estados ORDER BY sigla ASC;";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $statesData = $stmt->fetchAll();

            $states = [];

            foreach ($statesData as $stateData) {
                $state = StateMapper::toEntity($stateData);
                array_push($states, $state);
            }

            return $states;
        }

    }

?>