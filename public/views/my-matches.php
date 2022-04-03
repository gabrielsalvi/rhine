<?php
    require_once '../init.php';
    require_once '../../src/game/GameRepository.php';

    if (!isAuthenticated()) {
        header('Location: login.php');
    }

    registerNewGame();

    function generateGameCard($game) {
        echo 
            "<div class='match'>
                <div class='registered-people'>
                    <img src='../img/icons/athlete-50x50.png'>
                    <span class='participants-number'>0/{$game->getSport()->getNumberOfParticipants()}</span>
                </div>
                <span class='place'>{$game->getSportCenter()->getName()}</span>
                <span class='sport'><strong>{$game->getSport()->getDescription()}</strong></span>
                <span class='date'>{$game->getDate()}</span>
                <span class='time'>{$game->getStartHour()} - {$game->getEndHour()}</span>
                <span class='price'>R\${$game->getPrice()}</span>
            </div>"
        ;
    }

    function fillSelectWithSports() {
        require_once '../../src/sport/SportRepository.php';
        $sportRepository = new SportRepository();
    
        $sports = $sportRepository->getSports();
    
        foreach ($sports as $sport) {
            echo "<option value='{$sport->getId()}'>{$sport->getDescription()}</option>";
        }
    }

    function registerNewGame() {
        if (isset($_POST['create-game'])) {    
            require_once '../../src/game/GameRepository.php';
            require_once '../../src/game/GameMapper.php';
        
            $cnpj = $_SESSION['auth-key'];
            $game = GameMapper::toModel($_POST, $cnpj);
        
            $gameRepository = new GameRepository();
            $created = $gameRepository->create($game);
            
            if ($created) {
                header('Location: my-matches.php');
            }
        }
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
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/matches.css">

    <title>Partidas</title>
</head>
<body>
    <div class="page-container">
        <nav>
            <div class="website-logo">
                <span>Logo do Site</span>
            </div>
            <div class="profile-button">
                <a href="sport-center.php" title="Profile"><img src="../img/icons/default-profile-66x66.png" alt="profile"></a>
            </div>
        </nav>
        <section id="matches-container">
            <?php 

            $gameRepository = new GameRepository();
            
            $cnpj = $_SESSION['auth-key'];
            $games = $gameRepository->getGamesByCNPJ($cnpj);

            foreach ($games as $game) {
                generateGameCard($game);
            }

            ?>
            
            <img id="open-form" src="../img/icons/add-100x100.png">
        </section>
    </div>
    
    <div class="form-container" style="display:none">
        <form id="match-registration-form" action="my-matches.php" method="post">
            <img id="close-form" src="../img/icons/close-60x60.png">
            <h1>Dados da Partida</h1>

            <label for="sport">Esporte:</label>
            <select name="sport">
                <?php fillSelectWithSports(); ?>
            </select>

            <label for="match-date">Data:</label>
            <input type="date" name="match-date" required/>

            <label for="start-time">Horário de Início:</label>
            <input type="time" name="start-time" min="00:00" max="23:59" required/>

            <label for="end-time">Horário de Término:</label>
            <input type="time" name="end-time" required/>

            <label for="price">Valor (R$): </label>
            <input type="text" name="price" placeholder="15,00" required/>
            
            <input type="submit" name="create-game" value="Ofertar"/>
        </form>
    </div>

    <script type="text/javascript">
        var openFormButton = document.getElementById('open-form');
        var closeFormButton = document.getElementById('close-form');

        var pageContainer = document.getElementsByClassName('page-container')[0];
        var formContainer = document.getElementsByClassName('form-container')[0];

        openFormButton.addEventListener('click', showForm);
        closeFormButton.addEventListener('click', hideForm);

        function showForm() {
            pageContainer.style.display = 'none';
            formContainer.style.display = 'flex';
        }

        function hideForm() {
            pageContainer.style.display = 'block';
            formContainer.style.display = 'none';
        }

    </script>

</body>
</html>