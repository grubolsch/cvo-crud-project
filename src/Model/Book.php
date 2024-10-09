<?php

namespace Src\Model;

use DateTimeImmutable;

class Book
{
    private ?int $id = null;
    private string $name;
    private string $author;
    private \DateTimeImmutable $published;

    public function __construct(string $name, string $author, \DateTimeImmutable $published, int $id=null)
    {
        $this->name = $name;
        $this->author = $author;
        $this->published = $published;
        $this->id = $id;
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

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setAuthor(string $author) {
        $this->author = $author;
    }

    public function setPublished(DateTimeImmutable $published) {
        $this->published = $published;
    }

    public function save(\PDO $pdo)
    {
        if($this->id) {
            $q = $pdo->prepare(
                'update books set name = :name, author = :author, published = :published where id = :id'
            );
            $q->execute([
                ':id' => $this->id,
                ':name' => $this->name,
                ':author' => $this->author,
                ':published' => $this->published->format('Y-m-d')
            ]);

        } else {
            $q = $pdo->prepare(
                'insert into books (name, author, published) values (:name, :author, :published)'
            );
            $q->execute([
                ':name' => $this->name,
                ':author' => $this->author,
                ':published' => $this->published->format('Y-m-d')
            ]);
            $this->id = $pdo->lastInsertId();
        }
    }

    public function delete(\PDO $pdo)
    {
        $q = $pdo->prepare(
            'delete from books where id = :id'
        );
        $q->execute([
            ':id' => $this->id,
        ]);
    }

    public static function select(\PDO $pdo, int $id)
    {
        $q = $pdo->prepare(
            'select * from books where id = :id'
        );
        $q->execute([':id' => $id]);
        $result = $q->fetch();

        $book = new Book(
            $result['name'],
            $result['author'],
            \DateTimeImmutable::createFromFormat(
                'Y-m-d',
                $result['published'],
            ),
            $id
        );
        return $book;
    }

    public static function selectAll(\PDO $pdo): array
    {   
        $q = $pdo->prepare('SELECT * FROM books');
        $q->execute();
        $results = $q->fetchAll();

        foreach ($results as $result) {
            $books[] = new Book(
                $result['name'],
                $result['author'],
                \DateTimeImmutable::createFromFormat('Y-m-d', $result['published']),
                
            );
        }
    
        
        return $books;
    }
}

