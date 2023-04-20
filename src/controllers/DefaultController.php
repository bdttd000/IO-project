<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index() {
        $this->render('mainPage');
    }

    public function login() {
        $this->render('login');
    }

}