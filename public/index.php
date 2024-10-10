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

$pdo = new PDO('mysql:host=localhost;dbname=cvo_pdo', 'root', 'root');

switch ($_GET['page'] ?? 'login') {
    case 'create':
    case 'edit':
        $controller = new CreateController($twig, $pdo);
        break;
    case 'overview':
        $controller = new OverviewController($twig, $pdo);
        break;
    case 'register':
        $controller = new RegisterController($twig, $pdo);
        break;
    case 'login':
    default:
        $controller = new LoginController($twig, $pdo);
}

$controller->render();
