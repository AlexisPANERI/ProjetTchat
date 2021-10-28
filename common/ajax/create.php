<?php
session_start();   
if(isset($_POST) && !empty($_POST)){
    //on verifie nos champs et set nos variable dans les else

     if(empty($_POST['roomname'])){
        // $_SESSION["error"] = "une erreur est survenue pendant la création du salon";
        // header("location: ../");
        // die();
    }else $roomname = $_POST['roomname'];

    if(empty($_POST["roomdescription"])){
        $roomDesc = NULL;
    }else $roomDesc = $_POST["roomdescription"];

    if(!isset($_POST['checkPrivate'])){
        $pswd = NULL; 
        $private = 0;
        var_dump($private);
        var_dump(!isset($_POST['checkPrivate']));
        die();
    }else if(empty($_POST['password'])){
        // $_SESSION["error"] = "une erreur est survenue pendant la création du salon";
        // header("location: ../");
        // die();
    }else $pswd = $_POST['password']; $private = 1;
    require_once "../inc/db.php";
    $req = $pdo->prepare("INSERT INTO conversation SET conv_name = ?, conv_private = ?,conv_pswd = ?,conv_desc=?");
    $req->execute([$roomname,$private,$pswd,$roomDesc]);

}else {
    // $_SESSION["error"] = "une erreur est survenue pendant la création du salon";
    // header("location: ../");
    // die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="POST">
        <h3>Paramètres du Salon</h3>
        <input type="text" name="roomname" placeholder="Nom du Salon">
        <div>
            <b>Description : </b><br>
            <textarea maxlength="255" rows="4" cols="15" name="roomdescription"></textarea>
        </div>
        <b>Salon privée</b>
        <input type="checkbox" name="checkPrivate" id="checkPrivate">
        <input class="popup__password" type="password" name="password" id="fieldPrivate" placeholder="Mot de passe" disabled>
        <ul>
            <li><input type="submit" onclick="sparait()"></li>
            <li><a href="#" onclick="sparait()">Retour</a></li>
        </ul>
    </form>
</body>
<script>
        let checkPrivate = document.getElementById("checkPrivate");
        let fieldPrivate = document.getElementById("fieldPrivate");
            checkPrivate.addEventListener("change", function(event) {
                if (event.target.checked) {
                    fieldPrivate.disabled = false;
                } else fieldPrivate.disabled = true;fieldPrivate.value = "";
            }, false);
    </script>
</html>