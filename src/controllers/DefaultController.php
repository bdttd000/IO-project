<?php

require_once 'AppController.php';

class DefaultController extends AppController
{
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

    public function addAd()
    {
        $this->render('addAd');
    }
}