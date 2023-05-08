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
    <div class="body-container"></div>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>