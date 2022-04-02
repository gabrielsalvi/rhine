<?php
    require '../init.php';
    require '../../src/game/GameRepository.php';

    if (!isAuthenticated()) {
        header('Location: login.php');
    }

    function generateGameCard($game) {
        $gameRepository = new GameRepository();

        $sport = $gameRepository->getSport($game->getSportId());
        $sportCenter = $gameRepository->getSportCenter($game->getCNPJ());
        
        echo 
            "<div class='match'>
                <div class='registered-people'>
                    <img src='../img/icons/athlete-50x50.png'>
                    <span class='participants-number'>0/{$sport->getNumberOfParticipants()}</span>
                </div>
                <span class='place'>{$sportCenter->getName()}</span>
                <span class='sport'><strong>{$sport->getDescription()}</strong></span>
                <span class='date'>{$game->getDate()}</span>
                <span class='time'>{$game->getStartHour()} - {$game->getEndHour()}</span>
                <span class='price'>R\${$game->getPrice()}</span>
            </div>"
        ;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/match.css">
    <link rel="stylesheet" href="../css/matches.css">

    <title>Partidas</title>
</head>
<body>
    <nav>
        <div class="website-logo">
            <span>Logo do Site</span>
        </div>
        <div class="profile-button">
            <a href="profile.php" title="Profile"><img src="../img/icons/default-profile-66x66.png" alt="profile"></a>
        </div>
    </nav>
    <section id="matches-container">
        <?php 

        $gameRepository = new GameRepository();
        
        $cnpj = $_SESSION['auth-key'];
        $games = $gameRepository->getGamesByCNPJ($cnpj);

        foreach ($games as $game) {
            generateGameCard($game);
            generateGameCard($game);
            generateGameCard($game);
        }

        ?>

        <img class="add-button" src="../img/icons/add-100x100.png">
    </section>
</body>
</html>