<?php

namespace Src\Model;

class Book
{
    private int $id;
    private string $name;
    private string $author;
    private \DateTimeImmutable $published;

    public function __construct(string $name, string $author, \DateTimeImmutable $published)
    {
        $this->name = $name;
        $this->author = $author;
        $this->published = $published;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function save(\PDO $pdo)
    {

    }

    public function delete(\PDO $pdo)
    {

    }

    public function select(\PDO $pdo, int $id)
    {
        $q = $pdo->prepare(
            'select * from books where id = :id'
        );
        $q->execute([':id' => $id]);
        $result = $q->fetch();

        return new Book(
            $result['name'],
            $result['author'],
            \DateTimeImmutable::createFromFormat(
                'Y-m-d',
                $result['published'],
            )
        );
    }
}