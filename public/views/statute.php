<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged();

require_once "public/views/components/card.php";
require_once "public/views/contents/statuteContent.php";

$cardArray = [
    'title' => 'Regulamin',
    'content' => $statuteContent
];
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
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