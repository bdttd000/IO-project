<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('statute', 'DefaultController');
Routing::get('contact', 'DefaultController');
Routing::get('privacyPolicy', 'DefaultController');

Routing::get('addMeme', 'DefaultController');

Routing::post('checkLogin', 'SecurityController');

Routing::post('logout', 'SessionController');

Routing::post('addMemeForm', 'MemeController');


Routing::run($path);