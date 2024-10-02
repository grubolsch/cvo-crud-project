<?php

declare(strict_types=1);

namespace Src\Controller;

use Src\Model\Book;
use Twig\Environment;
use PDO;

class OverviewController implements HtmlControllerInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render(): void
    {
        $pdo = new PDO('mysql:host=localhost;dbname=cvo_pdo', 'root', 'root');

        // to be continued
        $book = new Book('Smurfenland', 'Pero', new \DateTimeImmutable());
        $book = $book->select($pdo, 1);

        echo '<pre>';
        var_dump($book);
        exit;

        $template = $this->twig->load('overview.html.twig');
        $template->display(['book' => $book]);
    }
}
