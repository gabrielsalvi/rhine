<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferte um Evento Esportivo!</title>
</head>
<body>
    <form action="" method="post">
        <label for="sports-list">Esportes:</label>
        <select name="sports-list">
            <option value="seven-a-side-footbal">Futebol Society</option>
            <option value="futsal">Futsal</option>
            <option value="volleyball">Vôlei</option>
        </select>

        <label for="event-date">Data:</label>
        <input type="date" name="event-date" required/>

        <label for="start-time">Horário de Início:</label>
        <input type="time" name="event-start-time" min="00:00" max="23:59" required/>

        <label for="end-time">Horário de Término:</label>
        <input type="time" name="end-time" required/>

        <label for="price">Valor (R$): </label>
        <input type="text" name="event-price" placeholder="15,00" required/>

        <label for="city">Cidade: </label>
        <select name="city">
            <option value="chapeco">Chapecó</option>
            <option value="erechim">Erechim</option>
        </select>
        
        <label for="address">Endereço:</label>
        <select name="address">
            <option value="Rua Colorado, nº 42-D, Jardim dos Anjos">Rua Colorado, nº 42-D, Jardim dos Anjos</option>
            <option value="Rua Ypiranga, nº 499, Centro">Rua Ypiranga, nº 499, Centro</option>
        </select>
        
        <input type="submit" value="Ofertar"/>
    </form>
</body>
</html>