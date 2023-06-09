<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";

require_once "public/views/components/card.php";
require_once "public/views/components/button.php";
require_once "public/views/components/form.php";
require_once "public/views/components/input.php";

$addButtonArray = [
    'value' => 'Dodaj obrazek'
];

$addMemeButtonArray = [
    'type' => 'submit',
    'value' => 'Dodaj'
];

$addMemeAndPreview = '
    <label for="meme-input" class="custom-meme-input">
    ' . Button($addButtonArray) . '
    </label>
    <input type="file" name="meme" accept=".jpg, .jpeg" id="meme-input">
    <img id="meme-preview" class="meme-preview" src="#" alt="Podgląd" style="display: none";>
';

$inputMemeName = [
    'type' => 'text',
    'name' => 'title',
    'placeholder' => 'Nazwa mema'
];

$formContent = [
    'action' => 'addMemeForm',
    'method' => 'POST',
    'content' => Input($inputMemeName) . $addMemeAndPreview . Button($addMemeButtonArray)
];

$cardArray = [
    'title' => 'Dodaj mema',
    'content' => Form($formContent)
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <script src="public/js/meme-preview-interactions.js" defer></script>
    <title>Dodaj mema</title>
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