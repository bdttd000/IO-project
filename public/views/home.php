<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";

require_once "public/views/components/meme.php";
require_once "public/views/components/button.php";
require_once "public/views/components/memeComment.php";
require_once "public/views/components/memeLikes.php";
require_once "public/views/components/recommendedMeme.php";
require_once "public/views/components/card.php";

$buttonArray = [
    'type' => 'more',
    'value' => 'Zobacz więcej / Dodaj komentarz'
];

$commentsArray = [
    'comment1' => 'Bardzo fajny memik, pozdrawiam z rodzinka. Pozdrów mame i tate :))))',
    'comment2' => 'Bardzo fajny memik, pozdrawiam z rodzinka. Pozdrów mame i tate :))))',
    'comment3' => 'Bardzo fajny memik, pozdrawiam z rodzinka. Pozdrów mame i tate :))))',
];

$memeArray = [
    'title' => 'Testtestowanie',
    'likes' => 999,
    'username' => 'Username',
    'meme-date' => '17.04.2023',
    'avatar' => 'public/img/meme/plus-solid.svg',
    'image' => 'public/img/meme/1023.jpg',
    'comments' => $commentsArray,
    'comment' => 'Bardzo fajny memik, pozdrawiam z rodzinka. Pozdrów mame i tate :))))',
    'button' => Button($buttonArray)
];

$recomendedMemeArray = [
    'title' => 'testr',
    'image' => "public/img/meme/1023.jpg",
];

$recommendedCardContent = RecommendedMeme($recomendedMemeArray) . RecommendedMeme($recomendedMemeArray) . RecommendedMeme($recomendedMemeArray);

$cardRecommendedArray = [
    'title' => 'Polecane',
    'content' => $recommendedCardContent,
];
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
            <?php echo Meme($memeArray) ?>
            <?php echo Meme($memeArray) ?>
            <?php echo Meme($memeArray) ?>
            <?php echo Meme($memeArray) ?>
        </section>
        <aside class="recommended-memes-aside">
            <div class="recommended-memes flex flex-center flex-column">
                <?php echo Card($cardRecommendedArray) ?>
            </div>
        </aside>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>