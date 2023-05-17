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

$inputNickname = [
    'type' => 'text',
    'name' => 'nickname',
    'placeholder' => 'Wprowadź nickname',
    'value' => $messages['nickname'],
];

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

$inputPassword2 = [
    'type' => 'password',
    'name' => 'password2',
    'placeholder' => 'Powtórz hasło',
];

$button = [
    'type' => 'submit',
    'value' => 'Zarejestruj',
];

$formContent = [
    'action' => 'checkRegister',
    'method' => 'POST',
    'content' => Input($inputNickname) . Input($inputEmail) . Input($inputPassword) . Input($inputPassword2) . Button($button),
];

if (isset($messages['error'])) {
    $formContent['content'] = '<div class="login-error-message">' .
        $messages['error']
        . '</div>' .
        $formContent['content'];
}

$buttonRedirect = [
    'link' => 'login',
    'value' => 'Zaloguj',
];

$cardContent = Form($formContent) . "<div class='text-center'>Masz już konto?</div>" . ButtonRedirect($buttonRedirect);

$cardArray = [
    'title' => 'Rejestracja',
    'content' => $cardContent,
];

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Rejestracja</title>
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