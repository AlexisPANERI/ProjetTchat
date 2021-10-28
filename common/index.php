<?php
    session_start();
    if ($_SESSION['auth']) {
        require_once "../common/inc/db.php";
        $userAccount = $_SESSION['auth']->user_id;
        $req = $pdo->prepare("SELECT * FROM profile WHERE user_id = $userAccount");
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
    <link rel="stylesheet" href="css/hub.css">
    <title>TCHAT</title>
</head>
<body>
    <main>
        <div class="sidebar">
            <div class="profil">
            <div id="avatar" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);"></div>
                <div class="profilInfos">
                    <div id="profilPseudo"><b><?php if ($user->pseudo == NULL){echo $_SESSION['auth']->username;}else{echo $user->pseudo;} ?></b></div>
                    <div class="profilBoutons">
                        <a href="read.php" id="read">Voir le profil</a>
                        <a href="../assets/logout.php" id="logout">Déconnexion</a>
                    </div>
                </div>
            </div>
            <div class="roomsSearch">
                <div class="search">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                    <input type="text" class="searchTerm" name="username" placeholder="Recherche un salon...">
                </div>
                <div class="roomsAdd">
                    <span class="addRoom" onclick="popup()">Ajouter +</span>
                </div>
            </div>
            <div class="rooms">
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Jean: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Jean: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
                <div class="roomsBar">
                <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                    <div class="roomsInfos">
                        <div><b>NOM DU SALON</b></div>
                        <p class="roomsLastMsg" > Salut à tous vous allez bien ?Salut à tous vous allez bien ?</p>
                    </div>
                </div>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Jean: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Jean: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Jean: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="main"></div>
        <div class="roomInfos">
            <div><h2>SCORD</h2></div>
            <div class="roomImg"></div>
            <p>Je suis la description du salon, vous pouvez me modifier en cliquant sur moi</p>
            <hr>
            <div class="roomParticipants">
                <div class="roomParticipant" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);"></div>
                <div class="roomParticipant" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);"></div>
                <div class="roomParticipant" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);"></div>
            </div>
        </div>
    </main>
    <div id="popup">
        <div class="popupcontainer">
            <form action="">
            <div id="imgGroup" style="background-image: url(<?php if($user->conv_img != null){echo "'".$path.$user->conv_img."'";} else {echo "media/sources/imgGroup.jpg";}  ?>);"></div>
                <div>
                    <input type="text" name="" placeholder="Nom du salon">
                </div>
                <div>
                    <label for="">Description</label><br>
                    <textarea name="" id="" maxlength="255" rows="3" cols="50" style="resize:none;" ></textarea>
                </div>
                <div id="private">
                    <label for="">Salon Privée</label>
                    <input type="checkbox" id="checkPrivate">
                    <input type="password" name="" id="fieldPrivate" placeholder="Mot de passe" disabled>   
                    <i class="far fa-eye" id="seePswd" onclick="seePswd()"></i>
                </div>
            </form>
            <ul>
                <li><a href="#" onclick="popup()">ANNULER</a></li>
                <li><a href="#" onclick="popup()">CRÉER</a></li>
            </ul>
        </div>
    </div>

    <script>
        function popup() {
            let pop = document.getElementById("popup");
            pop.style.display == "block" ? pop.style.display = "none" : pop.style.display = "block"
        }
    </script>
    <script>
        let checkPrivate = document.getElementById("checkPrivate");
        let fieldPrivate = document.getElementById("fieldPrivate");
            checkPrivate.addEventListener("change", function(event) {
                if (event.target.checked) {
                    fieldPrivate.disabled = false;
                } else fieldPrivate.disabled = true;fieldPrivate.value = "";
            }, false);
    </script>
    <script>
        function seePswd(){
            let seePswd = document.getElementById("seePswd");
            let fieldPrivate = document.getElementById("fieldPrivate");
            fieldPrivate.type == "password" ? fieldPrivate.type  = "text" : fieldPrivate.type  = "password";
            seePswd.className == "far fa-eye" ? seePswd.className  = "far fa-eye-slash" : seePswd.className = "far fa-eye";
        }
    </script>
</body>
</html>