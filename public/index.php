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

$pdo = new PDO('mysql:host=localhost;dbname=XXX', 'root', 'root');

switch ($_GET['page'] ?? 'overview') {
    case 'overview':
    default:
        $controller = new OverviewController($twig, $pdo);
        break;
}

$controller->render();
