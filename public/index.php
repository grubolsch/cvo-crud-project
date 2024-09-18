<?php

use Src\Controller\CreateController;
use Src\Controller\LoginController;
use Src\Controller\OverviewController;
use Src\Controller\RegisterController;

require '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../resources');
$twig = new \Twig\Environment($loader, [
    'cache' => '../storage/cache',
    'debug' => true
]);

switch ($_GET['page'] ?? 'login') {
    case 'create':
    case 'edit':
        $controller = new CreateController($twig);
        break;
    case 'overview':
        $controller = new OverviewController($twig);
        break;
    case 'register':
        $controller = new RegisterController($twig);
        break;
    case 'login':
    default:
        $controller = new LoginController($twig);
}

$controller->render();