<?php

function login($email, $password) {
    require_once 'athlete/AthleteRepository.php';

    $athleteRepository = new AthleteRepository();
    $athlete = $athleteRepository->getAthleteByEmail($email);
    
    if (isset($athlete) && password_verify($password, $athlete->getPassword())) {
        $_SESSION['cpf'] = $athlete->getCPF();
        header('Location: matches.php');
    }
}

function isAuthenticated($cpf) : bool {
    if (isset($cpf)) {
        return true;
    }

    return false;
}

?>