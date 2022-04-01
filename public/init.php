<?php
    require '../../src/database.php';
    require '../../src/authentication.php';

    if (Database::getConnection() === null) {
        Database::connect();
    }

    session_start();
?>