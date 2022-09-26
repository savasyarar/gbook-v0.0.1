<?php
namespace App\User;
use PDO;

class UserRepository {
    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function fetchAllUser(): array{
        $stmt = $this->pdo->query("SELECT * FROM users");
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\\User\\UserModel');
        return $results;
    }

    public function fetchUser(int $id){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\User\\UserModel');
        $result = $stmt->fetch(PDO::FETCH_CLASS);
        return $result;
    }
}