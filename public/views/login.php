<?php 

    require_once('../init.php');

    if (isset($_SESSION['authenticated'])) {
        header('Location: profile.php');
        exit();
    }

    if (@$_POST['email'] == 'abc' && @$_POST['password'] == 'abc') {
        $_SESSION['authenticated'] = 1;
        header('Location: profile.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Entre | Rhine</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <div class="form-container">
            <form id="login-form" action="login.php" method="post">
                <input type="text" name="email" placeholder="Email ou Username" required/>
                <input type="password" name="password" placeholder="Senha" required/>
                <input type="submit" value="Login">
                <div class="forgot-password">
                    <a href="reset-password.php">Esqueceu a senha?</a>
                </div>
            </form>
        </div>
    </body>
</html>