<?php
    session_start();
    $user = $_SESSION['auth']->user_id;
    $id = $_POST['id'];
    $msgField = $_POST['chat__msg__field'];
    if(isset($_POST['chat__msg__field']) && !empty($_POST['chat__msg__field'])){
        require_once "../inc/db.php";
        $req = $pdo->prepare("INSERT INTO message SET user_id = ?, conversation_id = ?, content = ?,created_at = NOW()");
        $req->execute([$user,$id,$msgField]);
    }
?>