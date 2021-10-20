<?php 
    session_start();
    if($_SESSION['auth']){
        require_once "bdd.php";
        $user_id = $_SESSION['auth']->user_id;
        $req = $pdo->prepare("SELECT * FROM profile WHERE user_id = $user_id ");
        $req->execute([$user_id]);
        $user = $req->fetch();
        $path = "../avatar/";
    } else {
        header("location: ../index.php");
        die();
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profil.css">
    <title>Profil</title>
</head>
<body>
    <fieldset class="container">
        <legend id="avatar" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "../img/avatar.png";}  ?>);"></legend>
        <div class="text">
            <div><b>Pseudo : </b><span><?php echo $user->pseudo ?></span></div>
            <div><b>Âge : </b><span><?php echo $user->age ?></span></div>
            <div><b>Genre : </b><span><?php echo $user->gender ?></span></div>
            <div><b>Localisation : </b><span><?php echo $user->location ?></span></div>
            <div><b>Description : </b> <br> <span><?php echo $user->description ?></span></div>
        </div>
        <div class="input">
            <a href="read.php"><input type="button" value="Retour"></a>
            <a href="update.php"><input type="submit" value="Modifier"></a>
        </div>
    </fieldset>
</body>
</html>  