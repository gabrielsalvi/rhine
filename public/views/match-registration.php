<?php

require '../init.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['submit'])) {    
    require '../../src/game/GameRepository.php';
    require '../../src/game/GameMapper.php';

    $cnpj = $_SESSION['auth-key'];

    $game = GameMapper::toModel($_POST, $cnpj);

    $gameRepository = new GameRepository();
    $created = $gameRepository->create($game);
    
    if ($created) {
        // header('Location: matches.php');
    }
}

function fillSelectWithSports() {
    require '../../src/sport/SportRepository.php';
    $sportRepository = new SportRepository();

    $sports = $sportRepository->getSports();

    foreach ($sports as $sport) {
        echo "<option value='{$sport->getId()}'>{$sport->getDescription()}</option>";
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
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/game-registration.css">

    <title>Oferte uma Partida! | Rhine</title>
</head>
<body>
    <div class="form-container">
        <form id="match-registration-form" action="" method="post">
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
            
            <input type="submit" name="submit" value="Ofertar"/>
        </form>
    </div>
</body>
</html>