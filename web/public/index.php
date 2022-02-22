<?php

    require_once('init.php');

    if (!isset($_SESSION['authenticated'])) {
        header('Location: ../login.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Integrador</title>
</head>
<body>
    <p>Bem vindo ao meu site :)</p>
</body>
</html>