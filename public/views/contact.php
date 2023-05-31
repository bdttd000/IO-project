<?php
$SessionController = new SessionController;
$userIsAuthenticated = $SessionController::isLogged() === "true";

require_once "public/views/components/card.php";
require_once "public/views/components/input.php";
require_once "public/views/components/form.php";
require_once "public/views/components/button.php";
require_once "public/views/components/textarea.php";
require_once "public/views/contents/contactContent.php";

$inputName = [
    'type' => 'name',
    'name' => 'Imię',
    'placeholder' => "Wprowadź imię",
    'value' => $messages['name'],
];

$inputSurname = [
    'type' => 'name',
    'name' => 'nazwisko',
    'placeholder' => "Wprowadź nazwisko",
    'value' => $messages['surname'],
];

$inputEmail = [
    'type' => 'name',
    'name' => 'email',
    'placeholder' => "Wprowadź adres email",
    'value' => $messages['email'],
];

$inputMessage = [
    'name' => 'message',
    'placeholder' => "Opisz swój problem",
    'value' => $messages['message'],
];

$sendButton = [
    'type' => 'submit',
    'value' => 'Wyślij',
];

$formContent = [
    'action' => 'sendContact',
    'method' => 'POST',
    'content' => $contactContent . Input($inputName) . Input($inputSurname) . Input($inputEmail) . Textarea($inputMessage) . Button($sendButton)
];

$cardContent = Form($formContent);

$cardArray = [
    'title' => "Kontakt",
    'content' => $cardContent
]

?>

<html lang="en">

<head>
    <?php include("public/views/components/headImports.php"); ?>
    <title>Kontakt</title>
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