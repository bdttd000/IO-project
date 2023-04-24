<?php

$SessionController = new SessionController;
if ($SessionController::isLogged() === "true")
    $SessionController->redirectToHome();

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <?php
        if (isset($messages)) {
            echo $messages['error'];
        }
        ?>
    </div>
    <form action="checkLogin" method="POST">
        <input type="text" name="email" placeholder="Wprowadź email" value="<?php if (isset($messages['email'])) {
            echo $messages['email'];
        } ?>">
        <input type="password" name="password" placeholder="Wprowadź hasło">
        <button type="submit">Zaloguj</button>
    </form>
</body>

</html>