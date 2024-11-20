<?php

declare(strict_types=1);

namespace Src\Controller;

use Src\Model\Book;
use Twig\Environment;
use PDO;
use Src\Model\User;

class OverviewController implements HtmlControllerInterface
{
    private Environment $twig;
    private PDO $pdo;

    public function __construct(Environment $twig, Pdo $pdo)
    {
        $this->twig = $twig;
        $this->pdo = $pdo;
    }

    public function render(): void
    {
        $template = $this->twig->load('overview.html.twig');
        $template->display();
    }
}
