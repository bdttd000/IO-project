<?php
$SessionController = new SessionController();
$userInfo = $SessionController->unserializeUser();

require_once __DIR__ . '/../../src/models/User.php';
require_once __DIR__ . '/../../src/repository/MemeRepository.php';

require_once "public/views/components/meme.php";
require_once "public/views/components/pagination.php";
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Główna</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-row" style="gap: 1.5rem">
        <aside class="left-aside"></aside>
        <section class="meme-section flex flex-center flex-column">
            <?php
            foreach ($memes as $meme) {
                echo Meme($meme);
            }
            echo Pagination('home', $pageNumber, $pagesCount);
            ?>
        </section>
        <aside class="recommended-memes-aside">
            <!-- <div class="recommended-memes flex flex-center flex-column"> -->
            <?php
            // echo Card($cardRecommendedArray) 
            ?>
            <!-- </div> -->
        </aside>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>