<?php

namespace Src\Model;

class User implements CrudInterface {
    private ?int $id = null;
    private string $username;
    private string $password;

    public function __construct(string $username, string $Password,  int $id = null)
    {
        $this->username = $username;
        $this->password = $Password;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->username;
    }

    public function setName(string $username)
    {
        $this->username = $username;
    }

    public function save(\PDO $pdo)
    {
        if ($this->id) {
            $q = $pdo->prepare(
                'update users set username = :username where id = :id'
            );
            $q->execute([
                ':id' => $this->id,
                ':username' => $this->username,
            ]);

        } else {
            $q = $pdo->prepare(
                'insert into users (username, password) values (:username, :password);'
            );
            $q->execute([
                ':username' => $this->username,
                ':password' => password_hash($this->password, PASSWORD_DEFAULT),
            ]);
            $this->id = $pdo->lastInsertId();
        }
    }

    public function delete(\PDO $pdo)
    {
        $q = $pdo->prepare(
            'delete from users where id = :id'
        );
        $q->execute([
            ':id' => $this->id,
        ]);
    }

    public static function select(\PDO $pdo, int $id)
    {
        $q = $pdo->prepare(
            'select * from users where id = :id'
        );
        $q->execute([':id' => $id]);
        $result = $q->fetch();

        $user = new user(
            $result['username'],
            $result['password'],
            $id
        );
        return $user;
    }

    public static function selectAll(\PDO $pdo): array
    {
        $q = $pdo->prepare('SELECT * FROM users');
        $q->execute();
        $results = $q->fetchAll();

        $users = [];
        foreach ($results as $result) {
            $users[] = new User(
                $result['username'],
                $result['password'],
                $result['id']
            );
        }

        return $users;
    }

}