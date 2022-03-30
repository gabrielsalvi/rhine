<?php
    require '../../src/database.php';

    if (Database::getConnection() === null) {
        Database::connect();
    }

    session_start();
?>