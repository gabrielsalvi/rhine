<?php
    require '../init.php';

    if (isAuthenticated($_SESSION['cnpj'])) {
        header('Location: login.php');
        exit();
    }

    if (isset($_POST['submit'])) {    
        require '../../src/sport-center/SportCenterRepository.php';
        require '../../src/sport-center/SportCenterMapper.php';

        $sportCenter = SportCenterMapper::toModel($_POST);
    
        $sportCenterteRepository = new SportCenterRepository();
        $created = $sportCenterteRepository->create($sportCenter);

        if ($created) {
            $_SESSION['cnpj'] = $sportCenter->getCNPJ();
            header('Location: profile.php');
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cadastre-se | Rhine </title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/sport-center-registration.css">
    </head>
    <body>
        <div class="form-container">
            <form id="sport-center-registration-form" action="sport-center-registration.php" method="post">
                <h1>Cadastro de Centro Esportivo</h1>

                <label for="name">Nome:</label>
                <input type="text" name="name" required/>
                
                <label for="description">Descrição:</label>
                <textarea type="text" name="description" required></textarea>

                <label for="cnpj">CNPJ:</label>
                <input type="text" name="cnpj" required/>

                <label for="openHour">Horário abertuta</label>
                <input type="time" name="openHour">

                <label for="closeHour">Horário fechamento</label>
                <input type="time" name="closeHour">

                <label for="username">Username:</label>
                <input type="text" name="username" required/>
                
                <label for="email">Email:</label>
                <input type="email" name="email" required/>
                
                <label for="password">Senha:</label>
                <input type="password" name="password" required/>
                
                <input type="submit" name="submit" value="Cadastrar-se">
            </form>
        </div>
    </body>
</html>