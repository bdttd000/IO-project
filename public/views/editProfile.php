<?php
$SessionController = new SessionController;

if ($SessionController::isLogged() === false) {
    $SessionController->redirectToHome();
}

$userInfo = $SessionController->unserializeUser();

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Edycja profilu</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="conainter flex flex-center flex-column">
        <form action="editProfileAction" method="POST">
            <input type="file" name="avatar" value="asda">
            <textarea><?php echo $userInfo->getDescription() !== '' ? $userInfo->getDescription() : ''; ?></textarea>
        </form>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>