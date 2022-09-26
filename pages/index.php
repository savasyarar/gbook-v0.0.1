<?php
include('../init.php');

$GuestbookRepository = new App\Guestbook\GuestbookRepository($pdo);
$UserRepository = new App\User\UserRepository($pdo);
$tested = $UserRepository->fetchUser(1);

if(empty($page)){
    $page = '';
} else {
    $page = $_GET['page'];
}

if(isset($_POST['submit'])){
    $content = htmlspecialchars($_POST['content']);
    $userid = 1;
    $status = 1;
    $response = $GuestbookRepository->insertPost($content, $userid, $status);
}

?>

<form action="" method="POST">
    <textarea class="content-text" name="content" placeholder="Was möchtest du mir sagen...?"></textarea>
    <button class="content-button" type="submit" name="submit">Mitteilen</button>
</form>

<?php
    $postsResult = $GuestbookRepository->fetchPosts();
    //Derzeit nur zum Testen
    foreach($postsResult as $post){
        echo $post->getShortContent()."<br>";
        echo $post->getDate()."<br>";
    }

?>


