<?php
    require_once '../init.php';
    require_once '../../src/athlete/AthleteRepository.php';
    require_once '../../src/athlete/AthleteMapper.php';

    if (isset($_POST['save'])) {
        require_once '../../src/city/CityRepository.php';
        require_once '../../src/city/CityMapper.php';

        $cityRepository = new CityRepository();
        $cityAlreadyExists = $cityRepository->getCityByNameAndState($_POST['city'], $_POST['state']);

        if ($cityAlreadyExists) {
            createAthlete($cityAlreadyExists->getId());
        } else {
            $city = CityMapper::toModel($_POST);
            $cityCreated = $cityRepository->create($city);

            if ($cityCreated) {
                $newCity = $cityRepository->getCityByNameAndState($city->getName(), $city->getStateId());
                createAthlete($newCity->getId());
            }   
        }
    }

    $_SESSION['athleteToBeRegistered'] = $_POST;
    
    function createAthlete($cityId) {
        $athleteRepository = new AthleteRepository();

        $athlete = AthleteMapper::toModel($_SESSION['athleteToBeRegistered']);
        $athlete->setCityId($cityId);

        $athleteRepository->create($athlete);

        $_SESSION['auth-key'] = $athlete->getCPF();
        $_SESSION['user-role'] = $GLOBALS['athlete-role'];
        redirectToUserMainPage();
    }

    function fillSelectWithStates() {
        require_once '../../src/state/StateRepository.php';
        $stateRepository = new StateRepository();
    
        $states = $stateRepository->getStates();
    
        foreach ($states as $state) {
            echo "<option value='{$state->getId()}'>{$state->getName()}</option>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Localização | Rhine</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/location.css">
</head>
<body>
    <div class="form-container">
        <form class="location-form" action="athlete-location.php" method="post">
            <h1>Localização</h1>
            <label for="state">Estado:</label>
            <select name="state"> <?php fillSelectWithStates(); ?> </select>
            
            <label for="city">Cidade:</label>
            <input type="text" name="city" required/>
            
            <input type="submit" name="save" value="Salvar">
        </div>
    </div>
</body>
</html>