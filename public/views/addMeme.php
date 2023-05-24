<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Dodaj mema</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-center flex-column">
        <form action="addMemeForm" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Podaj tytuł">
            <input type="file" name="meme" id="meme-input">
            <button type="submit">Wyslij</button>
            <img id="meme-preview" src="#" alt="Podgląd" style="display: none;">
        </form>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>