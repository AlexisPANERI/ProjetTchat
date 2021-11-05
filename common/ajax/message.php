<?php
session_start();
if (isset($_POST) && !empty($_POST)) {
    require_once "../inc/db.php";
    $id = $_POST['id'];
    $req = $pdo->prepare("SELECT * FROM message WHERE conversation_id = ?");
    $req->execute([$id]);
    if ($messages = $req->fetchAll()) {
        foreach ($messages as $message) {
            $req = $pdo->prepare("SELECT avatar,pseudo FROM profile WHERE user_id = $message->user_id");
            $req->execute();
            $user = $req->fetch();
            $path = "media/avatar/";
            $noImg = "avatar.png";
            if ($user->avatar == NULL) {
                $path = "media/sources/";
                $user->avatar = $noImg;
            }
            $req = $pdo->prepare("SELECT username FROM users WHERE user_id = $message->user_id");
            $req->execute();
            $userDefault = $req->fetch();
            if ($user->pseudo == NULL){
                $user->pseudo = $userDefault->username;
            }
            if(($message->user_id == $_SESSION['auth']->user_id)){
                echo "
                <div class=\"chat__area-msg-mine\">
                    <div class=\"chat__area-msg-bubble-mine\">
                        <p class=\"chat__area-msg-message-mine\">$message->content</p>
                        <span class=\"chat__area-msg-date\">$message->created_at</span>
                    </div>
                    <div class=\"chat__area-msg-avatar\"style=\"background-image:url('$path$user->avatar');\"></div>
                </div>";
            } else {
                echo "
                <div class=\"chat__area-msg\">
                    <div class=\"chat__area-msg-avatar\"style=\"background-image:url('$path$user->avatar');\"></div>
                    <div class=\"chat__area-msg-bubble\">
                        <span class=\"chat__area-msg-pseudo\">$user->pseudo</span>
                        <p class=\"chat__area-msg-message\">$message->content</p>
                        <span class=\"chat__area-msg-date\">$message->created_at</span>
                    </div>
                </div>";
            }
        }
    }
}
?>    