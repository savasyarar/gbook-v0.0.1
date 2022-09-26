<?php
namespace App\Guestbook;

class GuestbookModel {
    public $id;
    public $content;
    public $created_at;
    public $updated_at;
    public $status;

    public function getShortContent(){
        $subString = substr($this->content, 0, 300);
        return $subString."...";
    }

    public function getDate(){
        $toTime = strtotime($this->created_at);
        $result = date('d.m.Y - H:i', $toTime);
        return $result;
    }

}