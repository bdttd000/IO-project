<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class SecurityController extends AppController
{
    public function checkLogin()
    {
        $user = new User('adrianek@xd.pl', '12345', 'adrianek', 'suchy');

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['error' => 'Nieprawidłowy email', 'email' => $email]]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['error' => 'Nieprawidłowe hasło', 'email' => $email]]);
        }

        $_SESSION["userid"] = 1;

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }
}