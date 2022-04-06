<?php
    require_once '../init.php';
    require_once '../../src/athlete/AthleteRepository.php';
    
    if (!hasRightToSeeThisPage($GLOBALS['athlete-role'])) {
        redirectToUserMainPage();
    }

    $athleteRepository = new AthleteRepository();
    $athlete = $athleteRepository->getAthleteByCPF($_SESSION['auth-key']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/dropdown.css">

    <title>Profile</title>
    
</head>
<body>    
    <div class='profile-container'>
        <div class='banner'>
            <div class="dropdown">
                <img id="options-menu" src="../img/icons/menu-48x48.png"/>
                <div class="dropdown-content">
                    <a href="matches.php">Partidas</a>
                    <a href="update-profile.php">Editar Perfil</a>
                    <a href="logout.php">Sair</a>
                </div>
            </div>
        </div>
        <div class='profile-photo-area'>
            <img src="../img/default-user-pic.png">
        </div>
        <div class='profile-info'>
            <span class='name'>
                <?= $athlete->getFirstName() . " " . $athlete->getLastName() ?>
            </span>
            <span class='username'>
                @<?= $athlete->getUsername() ?>
            </span>
        </div>
        <div class='rating'>    
            <img src='../img/icons/star-48x48.png'>
            <a href=''><span>5.0/5 - Avaliação(ões)</span></a>
        </div>
    </div>

    <script src="../js/dropdown.js" type="text/javascript"></script>
</body>
</html>