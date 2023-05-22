<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$base = parse_url($path, PHP_URL_PATH);
$query = parse_url($path, PHP_URL_QUERY);

Routing::get('', 'MemeController');
Routing::get('home', 'MemeController');

Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('statute', 'DefaultController');
Routing::get('contact', 'DefaultController');
Routing::get('privacyPolicy', 'DefaultController');

Routing::get('profile', 'DefaultController');
Routing::get('addMeme', 'DefaultController');

Routing::post('checkLogin', 'SecurityController');
Routing::post('checkRegister', 'SecurityController');

Routing::post('logout', 'SessionController');

Routing::post('addMemeForm', 'MemeController');

Routing::run($base, $query);