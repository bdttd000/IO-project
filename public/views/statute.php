<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";

require_once "public/views/components/card.php";
require_once "public/views/contents/statuteContent.php";

$cardArray = [
    'title' => 'Regulamin',
    'content' => $statuteContent
];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="icon" href="public/img/logo.svg" type="image/svg+xml">
    <script src="public/js/sidebar-interactions.js" defer></script>
    <script src="public/js/navbar-interactions.js" defer></script>
    <title>Regulamin</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-center flex-column">
        <?php echo Card($cardArray) ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>