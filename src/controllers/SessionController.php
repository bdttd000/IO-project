<?php

require_once 'AppController.php';

class SessionController extends AppController
{
    public static function isLogged(): string
    {
        if (isset($_SESSION['userid'])) {
            return "true";
        }
        return "false";
    }

    public function logout()
    {
        unset($_SESSION['userid']);
        $this->redirectToHome();
    }

    public function redirectToHome()
    {
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }
}

?>