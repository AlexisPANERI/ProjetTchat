<?php
    session_start();
    $user = $_SESSION['auth']->user_id;
    $msgField = $_POST['message-send__field'];
    // var_dump($user,$msgField);
    // die();
    if(isset($_POST['message-send__field']) && !empty($_POST['message-send__field'])){
        require_once "../inc/db.php";
        $req = $pdo->prepare("SELECT * FROM message WHERE content = ?");
        $req = $pdo->prepare("INSERT INTO message SET user_id = $user, conversation_id = 1, content = ?");
        $req->execute([$user,$msgField]);
    }
?>