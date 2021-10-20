<?php 
session_start();
if($_SESSION['auth']){
    require_once "bdd.php";
    $user = $_SESSION['auth']->user_id;
    $req = $pdo->prepare("DELETE FROM profile WHERE user_id = $user")->execute();
    $req = $pdo->prepare("DELETE FROM users WHERE user_id = $user")->execute();
    unset($_SESSION['auth']);
    header("location: ../index.php");
}
?>