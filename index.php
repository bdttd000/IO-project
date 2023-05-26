<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$base = parse_url($path, PHP_URL_PATH);
$query = parse_url($path, PHP_URL_QUERY);

//MemeController
Routing::get('', 'MemeController');
Routing::get('home', 'MemeController');
Routing::get('meme', 'MemeController');
Routing::post('addMemeForm', 'MemeController');

//AdController
Routing::post('addAdForm', 'AdController');

//UserController
Routing::get('profile', 'UserController');

//DefaultController
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('statute', 'DefaultController');
Routing::get('contact', 'DefaultController');
Routing::get('privacyPolicy', 'DefaultController');

//DefaultController only logged users
Routing::get('addMeme', 'DefaultController');
Routing::get('addAd', 'DefaultController');

//SecurityController
Routing::post('checkLogin', 'SecurityController');
Routing::post('checkRegister', 'SecurityController');

//SessionController
Routing::post('logout', 'SessionController');

Routing::run($base, $query);