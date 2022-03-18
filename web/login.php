<?php 

    require_once('public/init.php');

    if (isset($_SESSION['authenticated'])) {
        header('Location: public/index.php');
        exit();
    }

    if (@$_POST['email'] == 'abc' && @$_POST['password'] == 'abc') {

        $_SESSION['authenticated'] = 1;
        header('Location: public/index.php');
        exit();

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Entre | {Nome do Site}</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://cdn.tailwindcss.com"></script>

        <link rel="stylesheet" href="public/css/main.css">
        <link rel="stylesheet" href="public/css/form.css">
        <link rel="stylesheet" href="public/css/login.css">
    </head>
    <body>
        <form id="login-form" action="login.php" method="post">
            <div class="input-area">
                <input type="text" name="email" placeholder="Email ou Username" required/>
                <input type="password" name="password" placeholder="Senha" required/>
                <input type="submit" value="Login">
            </div>
            <div class="forgot-password">
                <a href="index.php">Esqueceu a senha?</a>
            </div>
        </form>
    </body>
</html>