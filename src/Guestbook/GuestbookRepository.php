<?php
namespace App\Guestbook;
use PDO;

class GuestbookRepository {

    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function fetchPosts(): mixed{
        //Kein Prepared Statement nötig, da nur Ausgabe - Status 2 ist ein Beitrag der gemeldet wurde
        $stmt = $this->pdo->query("SELECT * FROM posts WHERE status = 1 ORDER BY created_at DESC");
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\\Guestbook\\GuestbookModel');
        return $results;
    }

    public function fetchPost(int $id): mixed{
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Guestbook\\GuestbookModel');
        $result = $stmt->fetch(PDO::FETCH_CLASS);
        return $result;
    }

    public function insertPost(string $content,int $userid, int $status): void{
        $stmt = $this->pdo->prepare("INSERT INTO posts (content, userid, status) VALUES (:content, :userid, :status)");
        $stmt->execute([$content, $userid, $status]);
    }

}