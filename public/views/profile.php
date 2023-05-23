<?php
$SessionController = new SessionController();
$userIsAuthenticated = $SessionController::isLogged();
$userInfo = $SessionController->unserializeUser();

require_once "public/views/components/card.php";
require_once "public/views/components/buttonRedirect.php";
require_once "public/views/components/avatarProfile.php";

$description = $user->getDescription() ?: 'Ten użytkownik nie dodał jeszcze swojego opisu...';

$cardArrayDescription = '<div class="profile-upper">'
    . AvatarPofile($user->getAvatarUrl()) . '<h4> Z nami od: '
    . $user->getCreationDate() . '</h4></div><h4 class="profile-description">'
    . $description . '</h4>';

$cardArray = [
    'title' => $user->getNickname(),
    'content' => $cardArrayDescription,
];

$buttonRedirectMyMemes = [
    'link' => 'usermemes',
    'value' => 'Moje memy',
];

$buttonRedirectEditProfile = [
    'link' => 'editprofile',
    'value' => 'Edytuj profil',
];

$buttonRedirectFavorites = [
    'link' => 'favorites',
    'value' => 'Ulubione memy',
];

$buttonRedirectCreateMeme = [
    'link' => 'addMeme',
    'value' => 'Stwórz mem',
];

$buttonRedirectUserMemes = [
    'link' => 'usermemes',
    'value' => 'Memy użytkownika',
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Profil</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-center flex-column profile">
        <?php
        echo $userAvatar;

        echo Card($cardArray);

        if ($user->getUserID() === $userInfo->getUserID()) {
            echo ButtonRedirect($buttonRedirectMyMemes);
            echo ButtonRedirect($buttonRedirectEditProfile);
            echo ButtonRedirect($buttonRedirectFavorites);
            echo ButtonRedirect($buttonRedirectCreateMeme);
        } else {
            echo ButtonRedirect($buttonRedirectUserMemes);
        }
        ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>