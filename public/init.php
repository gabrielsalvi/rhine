<?php
    require_once '../../src/database.php';
    require_once '../../src/authentication.php';

    if (Database::getConnection() === null) {
        Database::connect();
    }

    session_start();
?>