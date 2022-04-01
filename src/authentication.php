<?php

function login($email, $password) {
    athleteAuthentication($email, $password);
    sportCenterAuthentication($email, $password);
}

function athleteAuthentication($email, $password) {
    require_once 'athlete/AthleteRepository.php';

    $athleteRepository = new AthleteRepository();
    $athlete = $athleteRepository->getAthleteByEmail($email);

    if (isset($athlete) && password_verify($password, $athlete->getPassword())) {
        $_SESSION['auth-key'] = $athlete->getCPF();
        header('Location: profile.php');
    }
}

function sportCenterAuthentication($email, $password) {
    require_once 'sport-center/SportCenterRepository.php';

    $sportCenterRepository = new SportCenterRepository();
    $sportCenter = $sportCenterRepository->getSportCenterByEmail($email);

    if (isset($sportCenter) && password_verify($password, $sportCenter->getPassword())) {
        $_SESSION['auth-key'] = $sportCenter->getCNPJ();
        header('Location: sport-center.php');
    }
}

function isAuthenticated() : bool {
    return isset($_SESSION['auth-key']);
}

?>