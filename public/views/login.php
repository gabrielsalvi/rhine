<?php 
    require_once '../init.php';

    if (isAuthenticated()) {
        redirectToUserMainPage();
    }
    
    if (isset($_POST['login'])) {
        login($_POST['email'], $_POST['password']);
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
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" name="password" placeholder="Senha" required/>
                <input type="submit" name="login" value="Login">
                <div class="forgot-password">
                    <a href="account-registration.php">Não posssui uma conta?</a>
                </div>
            </form>
        </div>
    </body>
</html>