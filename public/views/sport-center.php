<?php
    require_once '../init.php';
    require_once '../../src/sport-center/SportCenterRepository.php';

    if (!hasRightToSeeThisPage($GLOBALS['sport-center-role'])) {
        redirectToUserMainPage();
    }

    $sportCenterRepository = new SportCenterRepository();
    $sportCenter = $sportCenterRepository->getSportCenterByCNPJ($_SESSION['auth-key']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/profile.css">

    <title>Profile</title>
</head>
<body>
    <div class="profile-container">
        <div class="banner"></div>
        <div class="profile-photo-area"></div>
        <div class="profile-info">
            <span class="name">
                <?= $sportCenter->getName() ?></span>
            <span class="username">
                @<?= $sportCenter->getUsername() ?>
            </span>
        </div>
        <div class="description">
            <span>
                <?= $sportCenter->getDescription() ?>
            </span>
        </div>
        <div class="working-time" title="Horário de Funcionamento">
            <img src="../img/icons/clock-48x48.png">
            <span>
                <?= $sportCenter->getOpenHour() . " - " . $sportCenter->getCloseHour() ?></span>
        </div>
    </div>
</body>
</html>