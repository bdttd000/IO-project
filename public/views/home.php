<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";

require_once __DIR__ . '/../../src/models/User.php';

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
        <?php
        if (isset($_SESSION['user_info'])) {
            $user = unserialize($_SESSION['user_info']);
            echo "Witaj " . $user->getNickname();
        }
        ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>