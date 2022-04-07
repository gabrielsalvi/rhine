<?php
    require_once '../init.php';
    
    unset($_SESSION['auth-key']);

    if (session_destroy()) {
        header('Location: login.php');
        exit();
    }
    
?>