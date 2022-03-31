<?php 

    require '../init.php';

    if (isset($_SESSION['athlete-cpf'])) {
        header('Location: profile.php');
        exit();
    }
    
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $db = Database::getConnection();

        $sql = "SELECT cpf, email, senha FROM atletas WHERE email = :email;";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $athleteData = $stmt->fetch();
        
        if (password_verify($password, $athleteData['senha'])) {
            $_SESSION['athlete-cpf'] = $athleteData['cpf'];
            header('Location: profile.php');
        }
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
                <input type="text" name="email" placeholder="Email" required/>
                <input type="password" name="password" placeholder="Senha" required/>
                <input type="submit" name="login" value="Login">
                <div class="forgot-password">
                    <a href="reset-password.php">Esqueceu a senha?</a>
                </div>
            </form>
        </div>
    </body>
</html>