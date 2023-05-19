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

        if ($user->getPassword() !== md5($password)) {
            return $this->render('login', ['messages' => ['error' => 'Nieprawidłowe hasło', 'email' => $email]]);
        }

        $_SESSION["user_info"] = serialize($user);

        $this->redirectToHome();
    }

    public function checkRegister()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        $user = $userRepository->checkUser($nickname, $email);

        if ($user) {
            return $this->render('register', ['messages' => ['error' => 'Istnieje już taki użytkownik', 'nickname' => $nickname, 'email' => $email]]);
        }

        if ($password !== $password2) {
            return $this->render('register', ['messages' => ['error' => 'Hasła nie są takie same', 'nickname' => $nickname, 'email' => $email]]);
        }

        $userRepository->addUser($nickname, $email, $password);

        return $this->render('login', ['messages' => ['success' => 'Dodano użytkownika']]);
    }

}