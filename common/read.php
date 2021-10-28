<?php 
    session_start();
    if($_SESSION['auth']){
        require_once "inc/db.php";
        $user_id = $_SESSION['auth']->user_id;
        $req = $pdo->prepare("SELECT * FROM profile WHERE user_id = $user_id");
        $req->execute();
        $user = $req->fetch();
        $path = "media/avatar/";
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
    <link rel="stylesheet" href="css/profil.css">
    <title>Profil</title>
</head>
<body>
    <fieldset class="container">
        <legend id="avatar" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);"></legend>
        <div class="text">
            <div><b>Pseudo : </b><span><?php if ($user->pseudo == NULL){echo $_SESSION['auth']->username;}else{echo $user->pseudo;} ?></span></div>
            <div><b>Âge : </b><span><?php if($user->age != null){echo $user->age;} else {echo "Non précisé";} ?></span></div>
            <div><b>Genre : </b><span><?php if($user->gender != null){echo $user->gender;} else {echo "Non précisé";} ?></span></div>
            <div><b>Localisation : </b><span><?php if($user->location != null){echo $user->location;} else {echo "Non précisé";} ?></span></div>
            <div><b>Description : </b> <br> <span><?php echo $user->description ?></span></div>
        </div>
        <div class="input">
            <a href="index.php"><input type="button" value="Retour"></a>
            <a href="update.php"><input type="submit" value="Modifier"></a><br/>
            <a href="../assets/logout.php" class="delete">Déconnexion</a>
        </div>
    </fieldset>
</body>
</html>  