<?php
    require_once '../../src/database.php';
    require_once '../../src/authentication.php';

    $GLOBALS['athlete-role'] = 'athlete';
    $GLOBALS['sport-center-role'] = 'sport-center';

    if (Database::getConnection() === null) {
        Database::connect();
    }

    session_start();
?>