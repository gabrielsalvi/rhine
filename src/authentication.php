<?php

function login($email, $password) {
    athleteAuthentication($email, $password);
    sportCenterAuthentication($email, $password);
    redirectToUserMainPage();
}

function athleteAuthentication($email, $password) {
    require_once 'athlete/AthleteRepository.php';

    $athleteRepository = new AthleteRepository();
    $athlete = $athleteRepository->getAthleteByEmail($email);

    if (isset($athlete) && password_verify($password, $athlete->getPassword())) {
        $_SESSION['auth-key'] = $athlete->getCPF();
        $_SESSION['user-role'] = $GLOBALS['athlete-role'];
    }
}

function sportCenterAuthentication($email, $password) {
    require_once 'sport-center/SportCenterRepository.php';

    $sportCenterRepository = new SportCenterRepository();
    $sportCenter = $sportCenterRepository->getSportCenterByEmail($email);

    if (isset($sportCenter) && password_verify($password, $sportCenter->getPassword())) {
        $_SESSION['auth-key'] = $sportCenter->getCNPJ();
        $_SESSION['user-role'] = $GLOBALS['sport-center-role'];
    }
}

function hasRightToSeeThisPage($allowedRole) : bool {
    if (!isAuthenticated()) {
        header('Location: login.php');
    }

    return $_SESSION['user-role'] == $allowedRole;
}

function isAuthenticated() : bool {
    return isset($_SESSION['auth-key']);
}

function redirectToUserMainPage() {
    if ($_SESSION['user-role'] == $GLOBALS['athlete-role']) {
        header('Location: matches.php');
    } else if ($_SESSION['user-role'] == $GLOBALS['sport-center-role']) {
        header('Location: my-matches.php');
    }
}

?>