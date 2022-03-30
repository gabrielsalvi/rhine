<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/match-registration.css">

    <title>Oferte uma Partida! | Rhine</title>
</head>
<body>
    <div class="form-container">
        <form id="match-registration-form" action="" method="post">
            <h1>Dados da Partida</h1>
            <label for="sports-list">Esporte:</label>
            <select name="sports-list">
                <option value="seven-a-side-footbal">Futebol Society</option>
                <option value="futsal">Futsal</option>
                <option value="volleyball">Vôlei</option>
            </select>

            <label for="match-date">Data:</label>
            <input type="date" name="match-date" required/>

            <label for="start-time">Horário de Início:</label>
            <input type="time" name="start-time" min="00:00" max="23:59" required/>

            <label for="end-time">Horário de Término:</label>
            <input type="time" name="end-time" required/>

            <label for="price">Valor (R$): </label>
            <input type="text" name="price" placeholder="15,00" required/>
            
            <input type="submit" value="Ofertar"/>
        </form>
    </div>
</body>
</html>