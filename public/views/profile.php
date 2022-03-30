<?php

    require_once('../init.php');

    if (!isset($_SESSION['authenticated'])) {

       // $athlete = getAthleteLogated();
        header('Location: login.php');
        exit();
    }

    function generetAthleteProfile() {

        $fullName = $athlete->getFirstName() . " " . $athlete->getLastName();

        return `
            <div class="profile-container">
                <div class="banner"></div>
                <div class="profile-photo-area"></div>
                <div class="profile-info">
                    <span class="name">$fullName</span>
                    <span class="username">$athlete->getUsername()</span>
                </div>
            <div class="rating">
                <img src="../img/icons/star-48x48.png">
                <a href=""><span>5.0/5 - Avaliação(ões)</span></a>
            </div>
            </div>`;
    }
    
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
    
</body>
</html>