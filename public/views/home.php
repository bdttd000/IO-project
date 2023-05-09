<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Główna</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-center flex-column">
        <h2>
            <?= $meme->getTitle() ?>
        </h2>
        <img src="public/uploads/<?= $meme->getImage() ?>" alt="">
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>