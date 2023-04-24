<?php

$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    if ($userIsAuthenticated) {
        echo '<div>Hejka</div>';
    } else {
        echo '<div>Nie wiem kim jesteś</div>';
    }

    if ($userIsAuthenticated) {
        echo '<a href="logout">Wyloguj</a>';
    } else {
        echo '<a href="login">Logowanie</a>';
    }
    ?>
</body>

</html>