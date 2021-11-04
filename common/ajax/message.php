<?php
session_start();
if(isset($_POST) && !empty($_POST)){
    require_once "../inc/db.php";
    $id = $_POST['id'];
    $req = $pdo->prepare("SELECT content FROM message WHERE conversation_id = ?");
    $req->execute([$id]);
    var_dump($id);
    if($messages = $req->fetchAll()){
        foreach($messages as $message)
        echo "<div class=\"discussion-message\"><p>$message->content</p></div> ";
    }
}
?>