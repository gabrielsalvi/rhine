<?php
    require_once '../init.php';

    if (!hasRightToSeeThisPage($GLOBALS['athlete-role'])) {
        redirectToUserMainPage();
    }

    if (isset($_POST['participate'])) {
        $gameId =  $_POST['game-id'];
        $cpf = $_SESSION['auth-key'];

        participateInTheGame($gameId, $cpf);
    }

    function generateGameCard($game, $numberOfGameParticipants) {
        echo 
            "<form class='match' method='post'>
                <input style='display: none' name='game-id' value='{$game->getId()}'/>
                <div class='registered-people'>
                    <img src='../img/icons/athlete-50x50.png'>
                    <span class='participants-number'>{$numberOfGameParticipants}/{$game->getSport()->getNumberOfParticipants()}</span>
                </div>
                <span class='place'>{$game->getSportCenter()->getName()}</span>
                <span class='sport'><strong>{$game->getSport()->getDescription()}</strong></span>
                <span class='date'>{$game->getDate()}</span>
                <span class='time'>{$game->getStartHour()} - {$game->getEndHour()}</span>
                <span class='price'>R\${$game->getPrice()}</span>
                <input type='submit' name='participate' value='Participar'/>
            </form>"
        ;
    }

    function participateInTheGame($gameId, $cpf) {
        if (!isAthleteAlreadyParticipatingInTheGame($gameId, $cpf)) {
            require_once '../../src/game-participant/GameParticipant.php';
            require_once '../../src/game-participant/GameParticipantRepository.php';
    
            $gameParticipant = new GameParticipant($gameId, $cpf);
        
            $gameParticipantRepository = new GameParticipantRepository();
            $created = $gameParticipantRepository->create($gameParticipant);
    
            if ($created) {
                echo "<script>alert('Sua presença foi confirmada. Compareça no local do jogo no horário certo e divirta-se!');</script>";
            }
        } else {
            echo "<script>alert('Você já está participando dessa partida!');</script>";
        }
    }

    function isAthleteAlreadyParticipatingInTheGame($gameId, $cpf) : bool {
        require_once '../../src/game-participant/GameParticipantRepository.php';

        $gameParticipantRepository = new GameParticipantRepository();
        $participantOfGame = $gameParticipantRepository->getParticipantOfGame($gameId, $cpf);

        if ($participantOfGame) {
            return true;
        }

        return false;

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
    <link rel="stylesheet" href="../css/matches.css">

    <title>Partidas</title>
</head>
<body>
    <nav>
        <div class="website-logo">
            <span>Rhine</span>
        </div>
        <div class="search-field">
            <input id="input-search" type="search" placeholder="Buscar">
            <img src="../img/icons/searcher-white-50x50.png" alt="search">
        </div>
        <div class="filter-button">
            <a href="" title="Filtrar" target="_blank"><img src="../img/icons/filter-50x50.png" alt="filtrar"></a>
        </div>
        <div class="profile-button">
            <a href="profile.php" title="Profile"><img src="../img/icons/default-profile-66x66.png" alt="profile"></a>
        </div>
    </nav>
    <section id="matches-container">
        <?php

        require_once '../../src/game/GameRepository.php';
        require_once '../../src/game-participant/GameParticipantRepository.php';

        $gameRepository = new GameRepository();
        $gameParticipantRepository = new GameParticipantRepository();
        
        $games = $gameRepository->getGames();

        foreach ($games as $game) {
            $numberOfGameParticipants = $gameParticipantRepository->getNumberOfGameParticipants($game->getId());
            generateGameCard($game, $numberOfGameParticipants);
        }

        ?>
    </section>
</body>
</html>