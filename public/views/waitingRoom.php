<?php
$SessionController = new SessionController();
$userInfo = $SessionController->unserializeUser();

require_once "public/views/components/meme.php";
require_once "public/views/components/pagination.php";
require_once "public/views/components/recommendedMeme.php";
require_once "public/views/components/ads.php";
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <script src="public/js/meme-interactions.js" defer></script>
    <title>Poczekalnia</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>

    <main class="container flex flex-row" style="gap: 1.5rem">
        <?php echo Ads($ads); ?>
        <section class="meme-section flex flex-center-align flex-column">
            <?php
            foreach ($memes as $meme) {
                echo Meme($meme);
            }
            echo Pagination('waitingRoom', $pageNumber, $pagesCount);
            ?>
        </section>
        <?php echo RecommendedMeme(3, 3); ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>