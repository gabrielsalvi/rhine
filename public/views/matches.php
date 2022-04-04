<?php
    require_once '../init.php';
    require_once '../../src/game/GameRepository.php';

    if (!isAuthenticated()) {
        header('Location: login.php');
    }

    if (isset($_POST['join'])) {

        $game_id =  $_POST['game-id'];
        $cpf = $_SESSION['auth-key'];

        if (alreadyRegisteredInThisGame($game_id, $cpf)) {
            echo "<script>alert('Você já está participando dessa partida!');</script>";
        } else {
            $db = Database::getConnection();
            
            $sql = 'INSERT INTO partida_atletas (id_partida, cpf) VALUES (:game_id, :cpf);';
    
            $stmt = $db->prepare($sql);
    
            $stmt->bindParam(':game_id', $game_id);
            $stmt->bindParam(':cpf', $cpf);
    
            $stmt->execute();

            echo "<script>alert('Sua presença está garantida. Compareça no local do jogo no horário correto e divirta-se!');</script>";
        }
    }

    function generateGameCard($game) {
        echo 
            "<form class='match' method='post'>
                <input style='display: none' name='game-id' value='{$game->getId()}'/>
                <div class='registered-people'>
                    <img src='../img/icons/athlete-50x50.png'>
                    <span class='participants-number'>0/{$game->getSport()->getNumberOfParticipants()}</span>
                </div>
                <span class='place'>{$game->getSportCenter()->getName()}</span>
                <span class='sport'><strong>{$game->getSport()->getDescription()}</strong></span>
                <span class='date'>{$game->getDate()}</span>
                <span class='time'>{$game->getStartHour()} - {$game->getEndHour()}</span>
                <span class='price'>R\${$game->getPrice()}</span>
                <input type='submit' name='join' value='Participar'/>
            </form>"
        ;
    }

    function alreadyRegisteredInThisGame($game_id, $cpf) : bool {
        
        $alreadyRegistered = false;

        $db = Database::getConnection();
            
        $sql = 'SELECT * FROM partida_atletas WHERE id_partida = :game_id;';

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':game_id', $game_id);

        $stmt->execute();

        $queryResults = $stmt->fetchAll();

        foreach ($queryResults as $result) {
            if ($result['cpf'] == $cpf) {
                $alreadyRegistered = true;
                break;
            }
        }

        return $alreadyRegistered;

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
            <span>Logo do Site</span>
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

        $gameRepository = new GameRepository();
        
        $games = $gameRepository->getGames();

        foreach ($games as $game) {
            generateGameCard($game);
        }

        ?>
    </section>
</body>
</html>