<?php

require_once './config.php';
require_once './core/coreFunctions.php';

spl_autoload_register( function($class){
    require_once './' . lcfirst( str_replace('\\', '/', $class) ) . '.php';
});

session_start();

$router = new Core\Router();

$router->addRoute( 'home', 'Src\Controllers\PublicController::showHome' );
$router->addRoute( 'notFound', 'Src\Controllers\ErrorController::notFound' );
$router->addRoute( 'register', 'Src\Controllers\PublicController::showRegister');
$router->addRoute( 'handleRegister', 'Src\Controllers\AuthController::handleRegister' );
$router->addRoute( 'handleLogin', 'Src\Controllers\AuthController::handleLogin' );
$router->addRoute( 'profile', 'Src\Controllers\AuthController::showProfile' );
$router->addRoute( 'library', 'Src\Controllers\LibraryController::showLibrary' );

$router->route();