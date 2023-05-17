<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function checkLogin()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['error' => 'Nie ma takiego użytkownika', 'email' => $email]]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['error' => 'Nieprawidłowe hasło', 'email' => $email]]);
        }

        $_SESSION["user_info"] = serialize($user);

        $this->redirectToHome();
    }
}