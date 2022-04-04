<?php
    require_once '../init.php';

    if (isAuthenticated()) {
        redirectToUserMainPage();
    }

    if (isset($_POST['submit'])) {    
        require_once '../../src/athlete/AthleteRepository.php';
        require_once '../../src/athlete/AthleteMapper.php';

        $athlete = AthleteMapper::toModel($_POST);
    
        $athleteRepository = new AthleteRepository();
        $created = $athleteRepository->create($athlete);

        if ($created) {
            $_SESSION['auth-key'] = $athlete->getCPF();
            $_SESSION['user-role'] = 'athlete';
            redirectToUserMainPage();
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
        <link rel="stylesheet" href="../css/athlete-registration.css">
    </head>
    <body>
        <div class="form-container">
            <form id="athlete-registration-form" action="athlete-registration.php" method="post">
                <h1>Cadastro de Atleta</h1>

                <label for="first-name">Nome:</label>
                <input type="text" name="first-name" required/>
                
                <label for="last-name">Sobrenome:</label>
                <input type="text" name="last-name" required/>
                
                <label for="birthdate">Data de Nascimento:</label>
                <input type="date" name="birthdate" required/>

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" required/>
                
                <label for="username">Nome de Usuário:</label>
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