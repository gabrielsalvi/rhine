<?php
    require_once '../init.php';
    require_once '../../src/athlete/AthleteRepository.php';
    
    if (!isset($_SESSION['auth-key'])) {
        header('Location: login.php');
        exit();
    }

    $athleteRepository = new AthleteRepository();
    $athlete = $athleteRepository->getAthleteByCPF($_SESSION['auth-key']);
    
    $fullName = $athlete->getFirstName() . " " . $athlete->getLastName();

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
<div class='profile-container'>
    <div class='banner'></div>
    <div class='profile-photo-area'></div>
    <div class='profile-info'>
        <span class='name'>
            <?= $fullName ?>
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
</body>
</html>