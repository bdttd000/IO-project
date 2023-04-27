<?php

require_once 'AppController.php';

class DefaultController extends AppController
{

    public function home()
    {
        $this->render('home');
    }

    public function login()
    {
        $this->render('login');
    }

    public function register()
    {
        $this->render('register');
    }

}