<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';

class SessionController extends AppController
{
    public static function isLogged(): bool
    {
        if (isset($_SESSION['user_info'])) {
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        unset($_SESSION['user_info']);
        $this->redirectToHome();
    }

    public function unserializeUser(): ?User
    {
        if ($_SESSION['user_info']) {
            return unserialize($_SESSION['user_info']);
        }
        return null;
    }
}

?>