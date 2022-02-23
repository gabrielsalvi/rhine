<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cadastre-se | Meu Site</title>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- <script src="https://cdn.tailwindcss.com"></script> -->

        <link rel="stylesheet" href="public/css/main.css">
    </head>
    <body>
        <form action="registration.php" method="post">
                <input type="text" name="first-name" placeholder="Nome" required/>
                <input type="text" name="last-name" placeholder="Sobrenome" required/>
                <input type="date" name="birthdate" placeholder="Data de Nascimento" required/>
                <input type="text" name="phone-number" placeholder="Nº de Telefone" required/>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="username" placeholder="Nome de Usuário" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="submit" value="Avançar">
        </form>
    </body>
</html>