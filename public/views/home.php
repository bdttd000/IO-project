<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";

@require_once "public/views/components/meme.php";
@require_once "public/views/components/button.php";
@require_once "public/views/components/memeComment.php";

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
    'likes' => '999',
    'username' => 'Username',
    'meme-date' => '17.04.2023',
    'comments' => $commentsArray,
    'comment' => 'Bardzo fajny memik, pozdrawiam z rodzinka. Pozdrów mame i tate :))))',
    'button' => Button($buttonArray)
]
?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Główna</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-center flex-row" style="gap: 2rem">
        <section style="width: 70%; height: 100px; gap: 20px;" class="flex flex-center flex-column">
            <?php echo Meme($memeArray) ?>
            <?php echo Meme($memeArray) ?>
            <?php echo Meme($memeArray) ?>
            <?php echo Meme($memeArray) ?>
        </section>
        <aside style="width: 30%; height: 100px;"></aside>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>