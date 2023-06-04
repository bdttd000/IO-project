<?php
$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();


if ($SessionController::isLogged() === false) {
    $SessionController->redirectToHome();
}

require_once "public/views/components/card.php";
require_once "public/views/components/buttonRedirect.php";
require_once "public/views/components/avatarProfile.php";
require_once "public/views/components/button.php";
require_once "public/views/components/form.php";
require_once "public/views/components/textarea.php";

$userInfo = $SessionController->unserializeUser();

$description = $userInfo->getDescription() ?: '';
$avatarUrl = $userInfo->getAvatarUrl() ?: '';

$changeAvatarButtonArray = [
    'value' => "Zmień avatar"
];

$addMemeAndPreview = '
    <label for="avatar-input" class="custom-avatar-input">
    ' . Button($changeAvatarButtonArray) . '
    </label>
    <input type="file" name="avatar" accept=".jpg, .jpeg" id="avatar-input">
    ';

$inputProfileDescription = [
    'name' => 'description',
    'value' => $description,
    'id' => 'edit-profile-textarea',
    'placeholder' => 'Dodaj swój opis...'
];

$cardArrayDescription = '<div class="profile-upper">'
    . '<div class="avatar-wrapper">'
    . AvatarPofile($avatarUrl)
    . '</div>'
    . $addMemeAndPreview
    . '</div><h4 class="edit-profile-description">'
    . Textarea($inputProfileDescription) . '</h4>';

$changeButtonArray = [
    'type' => 'submit',
    'value' => 'zmień'
];

$formContent = [
    'action' => 'editProfileForm',
    'method' => 'POST',
    'content' => $cardArrayDescription . Button($changeButtonArray)
];

$cardArray = [
    'title' => $userInfo->getNickname() . ' - edycja profilu',
    'content' => Form($formContent)
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <script src="public/js/avatar-interactions.js" defer></script>
    <title>Edycja profilu</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-center flex-column profile">
        <?php
        echo Card($cardArray);
        ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>