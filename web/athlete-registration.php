<?php

    require_once 'database.php';

    if (validateForm()) {

        $db = connect();

        $sql = 'INSERT INTO atletas (cpf, nome, sobrenome, dtnascimento, username, email, senha) 
                    VALUES (:cpf, :firstname, :lastname, :birthdate, :username, :email, :_password);';
 
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':cpf', $_POST['cpf']);
        $stmt->bindParam(':firstname', $_POST['first-name']);
        $stmt->bindParam(':lastname', $_POST['last-name']);
        $stmt->bindParam(':birthdate', $_POST['birthdate']);
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':_password', $_POST['password']);

        $stmt->execute();

    }

    function validateForm() : bool {

        if(isset($_POST['cpf']) && isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['birthdate']) 
            && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
                return true;
        }

        return false;

    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cadastre-se | Rhine </title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="public/css/main.css">
        <link rel="stylesheet" href="public/css/form.css">
        <link rel="stylesheet" href="public/css/athlete-registration.css">
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
                
                <label for="email">Email:</label>
                <input type="email" name="email" required/>
                
                <label for="username">Nome de Usuário:</label>
                <input type="text" name="username" required/>
                
                <label for="password">Senha:</label>
                <input type="password" name="password" required/>
                
                <input type="submit" value="Cadastrar-se">
            </form>
        </div>
    </body>
</html>