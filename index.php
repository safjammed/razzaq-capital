<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('layouts');
if (!file_exists('storage')) {
    mkdir('storage', 0777, true);
}
$twig = new \Twig\Environment($loader, [
//    'cache' => 'storage',
     'cache' => false,
]);


//routes
switch ($_SERVER['REQUEST_URI']) {
    case '/':
        echo $twig->render('pages/home.twig');
        break;    
    case '/index':
        echo $twig->render('pages/home.twig');
        break;
    case '/terms':
        echo $twig->render('pages/terms.twig', ['pageClass' => 'static-page','pageTitle'=> "Terms of Use"]);
        break;
    case '/privacy':
        echo $twig->render('pages/privacy.twig', ['pageClass' => 'static-page', 'pageTitle' => 'Privacy Policy']);
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        die("<h1>404 - NOT FOUND</h1> <br> <a href='/'>GO HOME</a>");
        break;
}