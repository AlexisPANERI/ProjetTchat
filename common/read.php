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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profil.css">
    <title>Profil</title>
</head>
<body>
    <fieldset class="profil-read">
        <legend class="profil-read-avatar" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);"></legend>
        <div class="profil-read-infos">
            <strong><?php if ($user->pseudo == NULL){echo $_SESSION['auth']->username;}else{echo $user->pseudo;} ?></strong>
            <span class="profil-read__username">@<?php echo $_SESSION['auth']->username;?></span>
            <p><?php echo $user->description ?></p>
            <div class="profil-read-details">
                <span><i class="fas fa-map-marker-alt"></i> <?php if($user->location != null){echo $user->location;} else {echo "Non précisé";} ?>, </span>
                <span><?php if($user->age != null){echo $user->age;} else {echo "Non précisé";} ?> ans, </span>
                <span><?php if($user->gender != null){echo $user->gender;} else {echo "Non précisé";} ?></span>
            </div>
        </div>
        <div class="profil-read-buttons">
        <a href="../assets/logout.php" class="profil-read-buttons__logout">Déconnexion</a>
            <ul>
                <li><a href="index.php">Retour</a></li>
                <li><a href="update.php">Modifier</a></li>
            </ul>      
        </div>
    </fieldset>
</body>
</html>  