<?php 
session_start();
if(isset($_SESSION['auth'])){
    require_once "../common/inc/db.php";
    $user = $_SESSION['auth']->user_id;
    $req = $pdo->prepare("DELETE FROM profile WHERE user_id = $user")->execute();
    $req = $pdo->prepare("DELETE FROM users WHERE user_id = $user")->execute();
    unset($_SESSION['auth']);
    $_SESSION['success']= "Compte supprimé avec succès";
    header("location: ../index.php");
}