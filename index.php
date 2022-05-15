<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';
function dd(){

    $numargs = func_get_args();
    foreach ($numargs as $arg){
        echo "<pre>";
            var_dump($arg);
        echo "</pre>";
    }

    die();
}
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$loader = new FilesystemLoader('layouts');
if (!file_exists('storage')) {
    mkdir('storage', 0777, true);
}
$twig = new Environment($loader, [
     'cache' => $_ENV["APP_ENVIRONMENT"] == 'production' ? 'storage' : false,
//     'cache' => false,
]);
$twig->addGlobal('env', $_ENV);
$twig->addGlobal('menu', [
    [
        'to' => '/#mission',
        'title' => 'Purpose',
    ],
    [
        'to' => '/team',
        'title' => 'Team',
    ],
    [
        'to' => '/#arriving',
        'title' => 'Investment',
    ],
    [
        'to' => 'mailto:info@razzaqcapital.com?subject=General%20Inquiry',
        'title' => 'Investment',
    ],
]);

//routes
switch ($_SERVER['REQUEST_URI']) {
    case '/index':
    case '/':
        echo $twig->render('pages/home.twig');
        break;
    case '/terms':
        echo $twig->render('pages/terms.twig', ['pageClass' => 'static-page','pageTitle'=> "Terms of Use"]);
        break;
    case '/privacy':
        echo $twig->render('pages/privacy.twig', ['pageClass' => 'static-page', 'pageTitle' => 'Privacy Policy']);
        break;
    case '/team':
        echo $twig->render('pages/team.twig', ['pageClass' => 'static-page', 'pageTitle' => 'Our Team']);
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        die("<h1>404 - NOT FOUND</h1> <br> <a href='/'>GO HOME</a>");
}