<?php

declare(strict_types=1);

namespace Src\Controller;

use PDO;
use Src\Model\Book;
use Twig\Environment;
use DateTimeImmutable;

class CreateController implements HtmlControllerInterface
{
    private Environment $twig;
    private PDO $pdo;

    public function __construct(Environment $twig, PDO $pdo)
    {
        $this->twig = $twig;
        $this->pdo = $pdo;
    }

    public function render(): void
    {
        $book = new Book('Smurfen door de eeuwen heen', 'Pero', new DateTimeImmutable());
        $book->save($this->pdo);

        $book->setName('Een ander boek');

        $book->save($this->pdo);

        $template = $this->twig->load('create.html.twig');
        $template->display([
            'book' => 'Test'
        ]);
    }
}
