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
        //book moeten laden?
        if (!empty($_GET['id'])) {
            //openen van edit page
            $book = Book::select($this->pdo, (int)$_GET['id']);
        } elseif (!empty($_POST['book_id'])) {
            //saven van edit page
            $book = Book::select($this->pdo, (int)$_POST['book_id']);
        } else {
            $book = null;
        }

        var_dump($_POST);

        if (!empty($_POST['title']) && !empty($_POST['author'])) {
            // pas boek aan

            $date = \DateTimeImmutable::createFromFormat('Y-m-d', $_POST['published']);
            if (empty($book)) {
                $book = new Book(
                    $_POST['title'],
                    $_POST['author'],
                    $date
                );
            } else {
                $book->setName($_POST['title']);
                $book->setAuthor($_POST['author']);
                $book->setPublished($date);
            }

            $book->save($this->pdo);
        }



        $template = $this->twig->load('create.html.twig');
        $template->display([
            'book' => $book
        ]);
    }
}
