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
            <div class="rooms"hidden>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Max: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Max: Salut à tous, vous allez bien ?</p>
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
                            <p class="roomsLastMsg">Max: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Max: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
                <div class="roomsBar">
                    <div class="roomsImg" style="background-image:url(media/sources/imgGroup.jpg);"></div>
                        <div class="roomsInfos">
                            <div><b>NOM DU SALON</b></div>
                            <p class="roomsLastMsg">Max: Salut à tous, vous allez bien ?</p>
                        </div>
                </div>
            </div>
        </div>
        <div class="main"></div>
        <div class="roomInfos" hidden>
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
    //Création d'un salon
    <div id="popup">
        <div class="popupcontainer">
            <span  class="redalert" id="errorRoomName"></span>
            <span class="redalert" id="errorRoomPswd"></span>
            <form action="ajax/create.php" method="POST" id="room-create">
                <div name="room-create__img" id="room-create__img" style="background-image: url(<?php if($user->conv_img != null){echo "'".$path.$user->conv_img."'";} else {echo "media/sources/imgGroup.jpg";}?>);">
                    <label> 
                        <img id="output" name="imgGroupMask" src="media/sources/modifImg.png" style="width: auto;">
                        <input type="file" name="imgGroupField" id="imgGroupField" onchange="document.getElementById('imgGroup').style.backgroundImage = 'url' +'(' + window.URL.createObjectURL(this.files[0]) + ')';" style="display:none">
                    </label>
                </div>
                <div>
                    <input type="text" name="room-create__name" id="room-create__name" placeholder="Nom du salon">
                </div>
                <div>
                    <label for="">Description</label><br>
                    <textarea name="room-create__desc" maxlength="255" rows="3" cols="50" style="resize:none;" ></textarea>
                </div>
                <div id="private">
                    <label for="">Salon Privée</label>
                    <input type="checkbox" name="room-create__check" id="room-create__check">
                    <input type="password" name="room-create__pswd" id="room-create__pswd" placeholder="Mot de passe" disabled>   
                    <i class="far fa-eye" id="room-create__pswd-see" onclick="seePswd()"></i>
                </div>
            </form>
            <ul>
                <li><a href="#" onclick="popup()">ANNULER</a></li>
                <li><a href="#" onclick="controleChamps()">CRÉER</a></li>
            </ul>
        </div>
    </div>






    <script>
        function controleChamps() {
            let error = {
                "errorRoomName":0,
                "errorRoomPswd":0
            }
            let roomName = document.getElementById('room-create__name').value;
            let roomPswd = document.getElementById('room-create__pswd').value;
            let roomCheck = document.getElementById('room-create__check').value;
            const regexRoomName = /^[\w-]+$/;
            let valid = true;
        //Verif du champ nom
            if (roomName == "") {
                error["errorRoomName"] = "Le champ Nom du Salon est vide";
                valid = false;
            } else if (!regexRoomName.test(roomName)) {
                error["errorRoomName"] = "Le champ 'Nom du Salon' comporte des caractères non autorisés";
                valid = false;
            } else if (roomName.length <= 2 || roomName.length > 17) {
                error["errorRoomName"] = "Le Nom du Salon doit comporter de 2 à 16 caractères";
                valid = false;
            } else valid = true;
        //Verif du mot de passe   
            if (roomCheck.checked == true){
                if (roomPswd == "") {
                    error["errorRoomPswd"] = "Le champ Mot de passe est vide";
                    valid = false;
                } else if (roomPswd.length < 3 || roomPswd.length > 17) {
                    error["errorRoomPswd"] = "Le Mot de passe doit comporter de 4 à 16 caractères";
                    valid = false;
                } else valid = true;
            }
            

            if(valid){ 
                return true;
            } else {
                for(x in error){
                    if(error[x] != 0){
                        document.getElementById(x).innerHTML = error[x];
                     } else {
                         document.getElementById(x).innerHTML = "";
                     }
                }
                return false;
            }
        }
    </script>



    <script>
    function create(){
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "ajax/create.php", true);
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log('ok');
            }
        };
        let form = new FormData(document.getElementById("room-create"))
        xhttp.send(form);
    }
    </script>



    <script>
        function popup() {
            let pop = document.getElementById("popup");
            pop.style.display == "block" ? pop.style.display = "none" : pop.style.display = "block"
        }
    </script>



    <script>
        let roomCheck = document.getElementById("room-create__check");
        let roomPswd = document.getElementById("room-create__pswd");
            roomCheck.addEventListener("change", function(event) {
                if (event.target.checked) {
                    roomPswd.disabled = false;
                } else roomPswd.disabled = true; roomPswd.value = "";
            }, false);
    </script>



    <script>
        function seePswd(){
            let roomPswdSee = document.getElementById("room-create__pswd-see");
            let roomPswd = document.getElementById("room-create__pswd");
            roomPswd.type == "password" ? roomPswd.type  = "text" : roomPswd.type  = "password";
            roomPswdSee.className == "far fa-eye" ? roomPswdSee.className  = "far fa-eye-slash" : roomPswdSee.className = "far fa-eye";
        }
    </script>
</body>
</html>