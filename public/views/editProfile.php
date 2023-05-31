<?php
$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();
$userInfo = $SessionController->unserializeUser();

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

// $description = $user->getDescription() ?: 'Ten użytkownik nie dodał jeszcze swojego opisu...';



$changeAvatarButtonArray = [
    'value' => "Zmień avatar"
];

$addMemeAndPreview = '
    <label for="avatar-input" class="custom-avatar-input">
    '. Button($changeAvatarButtonArray) . '
    </label>
    <input type="file" name="avatar" accept=".jpg, .jpeg" id="avatar-input">
    ';
    
$inputProfileDescription = [
    'name' => 'message',
    'value' => 'testtesttest',
    'id' => 'edit-profile-textarea'
];

$cardArrayDescription = '<div class="profile-upper">'
    . '<div class="avatar-wrapper">'
    . AvatarPofile()
    . '</div>'
    . $addMemeAndPreview
    . '</div><h4 class="edit-profile-description">'
    . Textarea($inputProfileDescription) . '</h4>';

$formContent = [
    'action' => 'editProfile',
    'method' => 'POST',
    'content' => $cardArrayDescription
];

$changeButtonArray = [
    'type' => 'submit',
    'value' => 'zmień'
];

$cardArray = [
    'title' => 'nickName',
    'content' => Form($formContent) . Button($changeButtonArray)
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Edycja profilu</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="conainter flex flex-center flex-column profile">
    <?php
            echo Card($cardArray);
    ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>