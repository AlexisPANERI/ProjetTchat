<?php
session_start();
if (isset($_POST) && !empty($_POST)) {
    require_once "../inc/db.php";
    $id = $_POST['id'];
    $req = $pdo->prepare("SELECT * FROM message WHERE conversation_id = ?");
    
    $req->execute([$id]);
    if ($messages = $req->fetchAll()) {
        foreach ($messages as $message) {
            $req = $pdo->prepare("SELECT avatar FROM profile WHERE user_id = $message->user_id");
            $req->execute();
            $user = $req->fetch();
            $path = "media/avatar/";
            if ($user->avatar == NULL) {
                $path = "media/sources/";
                $user->avatar = "imgGroup.jpg";
            }
            echo "<div class=\"chat__area-msg\"><div class=\"chat__msg-area-avatar\"style=\"background-image:url('$path$user->avatar');\"></div>" . "<div class=\"chat__msg-area-messages\"><p class=\"chat__msg-area-message\">$message->content</p><p class=\"chat__msg-area-date\">$message->created_at</p></div></div>";
        }
    }
}
?>    