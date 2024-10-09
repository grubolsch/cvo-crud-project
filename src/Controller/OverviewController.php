<?php

declare(strict_types=1);

namespace Src\Controller;

use Src\Model\Book;
use Twig\Environment;
use PDO;

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
        $books = Book::selectAll($this->pdo);

        $template = $this->twig->load('overview.html.twig');
        $template->display(['books' => $books]);
    }
}
