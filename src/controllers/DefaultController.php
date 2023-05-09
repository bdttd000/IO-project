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

    public function statute()
    {
        $this->render('statute');
    }

    public function contact()
    {
        $this->render('contact');
    }

    public function privacyPolicy()
    {
        $this->render('privacyPolicy');
    }

    public function addMeme()
    {
        $this->render('addMeme');
    }
}