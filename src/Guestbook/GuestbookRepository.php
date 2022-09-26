<?php
namespace App\Guestbook;
use PDO;

class GuestbookRepository {

    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function fetchPosts(){
        //Kein Prepared Statement nötig, da nur Ausgabe
        $stmt = $this->pdo->query("SELECT * FROM posts WHERE status = 2 ORDER BY created_at DESC");
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\\Guestbook\\GuestbookModel');
        return $results;
    }

    public function fetchPost(int $id){
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute([$id => 'id']);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Guestbook\\GuestbookModel');
        $result = $stmt->fetch(PDO::FETCH_CLASS);
        return $result;
    }

    public function insertPost(string $content, int $status): void{
        $stmt = $this->pdo->prepare("INSERT INTO posts (content, status) VALUES (:content, :status)");
        $stmt->execute([$content, $status]);
    }

}