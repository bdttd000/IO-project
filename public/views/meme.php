<?php
$SessionController = new SessionController();
$userInfo = $SessionController->unserializeUser();

require_once "public/views/components/memeSolo.php";
require_once "public/views/components/recommendedMeme.php";
require_once "public/views/components/ads.php";
require_once "public/views/components/buttonRedirect.php";

$getNextMeme = [
    'link' => 'meme',
    'value' => 'Losuj mema'
];
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <script src="public/js/meme-interactions.js" defer></script>
    <title>Memy</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>

    <main class="container flex flex-row" style="gap: 1.5rem">
        <?php echo Ads($ads); ?>
        <section class="meme-section flex flex-center-align flex-column">
            <?php echo Meme($meme); ?>
            <div class="drop-shadow button-random-meme">
                <?php echo ButtonRedirect($getNextMeme); ?>
            </div>
        </section>
        <?php echo RecommendedMeme(2, 0); ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>