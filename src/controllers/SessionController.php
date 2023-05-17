<?php

require_once 'AppController.php';

class SessionController extends AppController
{
    public static function isLogged(): string
    {
        if (isset($_SESSION['user_info'])) {
            return "true";
        }
        return "false";
    }

    public function logout()
    {
        unset($_SESSION['user_info']);
        $this->redirectToHome();
    }
}

?>