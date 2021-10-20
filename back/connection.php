<?php
if(isset($_POST['username'] ) && isset($_POST['pswd'])){
    session_start();
    require_once "bdd.php";
    $username = $_POST['username'];
    $req = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $req->execute([$username]);
    $user = $req->fetch();
    if(!password_verify($_POST['pswd'], $user->pswd)){
        $_SESSION['error'] = "Votre compte n'existe pas";
        header("location: ../index.php");
        die(); 
    } else if($user->date_creation == NULL) {
        $_SESSION['error'] = "Veuillez confirmer votre compte";
            // Ne PAS OUBLIER DE FAIRE UN BOUTON DE RENVOIE DE MAIL
        header("location: ../index.php");
        die();
    } else {
        $_SESSION['auth'] = $user;
        header("location: read.php");
        die();
    }
}