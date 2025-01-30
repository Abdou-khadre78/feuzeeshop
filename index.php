<?php
require "vendor/autoload.php";
session_start();


use Config\Router;

$router = new Router();

//la page d'accueil
$router->addRoute('/', 'HomeController','index');
//la connexion/deconnexion et inscription:
$router->addRoute('/register', 'RegisterController','index');
$router->addRoute('/login', 'LoginController','index');
$router->handleRequest();