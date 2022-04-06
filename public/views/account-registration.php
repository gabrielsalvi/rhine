<?php
    require_once '../init.php';

    if (isAuthenticated()) {
        redirectToUserMainPage();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Cadastro | Rhine</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/account-registration.css">
</head>
<body>
    <div class="account-registration-container">
        <h1>Conta do Tipo</h1>
        <div class="link-container athlete-registration"><a href="athlete-registration.php">Atleta</a></div>
        <div class="link-container sport-center-registration"><a href="sport-center-registration.php">Centro Esportivo</a></div>
    </div>
</body>
</html>