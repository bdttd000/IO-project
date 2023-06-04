<?php
$SessionController = new SessionController();
$userInfo = $SessionController->unserializeUser();

if ($SessionController::isLogged() === false) {
    $SessionController->redirectToHome();
}

require_once "public/views/components/meme.php";
require_once "public/views/components/pagination.php";
require_once "public/views/components/recommendedMeme.php";
require_once "public/views/components/ads.php";
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <script src="public/js/meme-interactions.js" defer></script>
    <title>Memy użytkownika</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>

    <?php
    if ($memes[0]) {
        echo '
        <main class="container flex flex-row" style="gap: 1.5rem">
        <aside class="right-aside recommended-memes-aside flex flex-column"></aside>
        <section class="meme-section flex flex-center-align flex-column">';
        foreach ($memes as $meme) {
            echo Meme($meme);
        }
        echo Pagination('favorites', $pageNumber, $pagesCount);
        echo '</section>
        <aside class="recommended-memes-aside flex flex-column left-aside"></aside>';
    } else {
        echo '<main class="container flex flex-center flex-column profile"><h2 class="favorites-empty">Nie dodałeś/aś jeszcze nic do ulubionych, zrób to koniecznie by nie zapomnieć swoich ulubionych memów</h2>';
    }
    ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>