<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";
if ($userIsAuthenticated) {
    $SessionController->redirectToHome();
}

require_once "public/views/components/input.php";
require_once "public/views/components/card.php";
require_once "public/views/components/button.php";
require_once "public/views/components/buttonRedirect.php";
require_once "public/views/components/form.php";

$inputEmail = [
    'type' => 'text',
    'name' => 'email',
    'placeholder' => 'Wprowadź email',
    'value' => $messages['email'],
];

$inputPassword = [
    'type' => 'password',
    'name' => 'password',
    'placeholder' => 'Wprowadź hasło',
];

$button = [
    'type' => 'submit',
    'value' => 'zaloguj',
];

$formContent = [
    'action' => 'checkLogin',
    'method' => 'POST',
    'content' => Input($inputEmail) . Input($inputPassword) . Button($button),
];

if (isset($messages['error'])) {
    $formContent['content'] = '<div class="login-error-message">' .
        $messages['error']
        . '</div>' .
        $formContent['content'];
}

if (isset($messages['success'])) {
    $formContent['content'] = '<div class="login-success-message">' .
        $messages['success']
        . '</div>' .
        $formContent['content'];
}

$buttonRedirect = [
    'link' => 'register',
    'value' => 'rejestracja',
];

$cardContent = Form($formContent) . "<div class='text-center'>Nie masz konta?</div>" . ButtonRedirect($buttonRedirect);

$cardArray = [
    'title' => 'Logowanie',
    'content' => $cardContent,
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Logowanie</title>
</head>

<body>
    <?php include("public/views/components/navbar.php"); ?>
    <?php include("public/views/components/sidebar.php"); ?>
    <main class="container flex flex-center flex-column">
        <?php echo Card($cardArray); ?>
    </main>
    <?php include("public/views/components/footer.php"); ?>
</body>

</html>