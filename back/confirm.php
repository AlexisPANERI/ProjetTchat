<?php
    
    if(isset($_GET['token'])) {
        $user_id = $_GET['id'];
        $token = $_GET['token'];
        require_once 'bdd.php';
        $req = $pdo->prepare("SELECT token_conf FROM users WHERE user_id = ?");
        $req->execute([$user_id]);
        $user = $req->fetch();
        $user = $user->token_conf;
        session_start();
        if($user == $token){
            $pdo->prepare("UPDATE users SET token_conf = NULL, date_creation = NOW() WHERE user_id = $user_id")->execute();
            $_SESSION['success'] = "Votre compte a été créé";
            header("location: ../index.php");
            die();
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    <h1>BIENVENUE</h1>
    <?php 
    if(isset($_SESSION['success'])){
        echo "<div class=\"successPHP\">".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
    }
    ?>
</body>
</html>