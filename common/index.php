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
        <div class="sidebar-left">
            <div class="profil">
                <a href="read.php"><div class="profil__avatar" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);"></div></a>
                    <div class="profil__infos">
                        <div>
                            <b><?php if ($user->pseudo == NULL){echo $_SESSION['auth']->username;}else{echo $user->pseudo;} ?></b>
                        </div>
                            <div class="profil-buttons">
                                <a href="read.php" class="profil-buttons__read">Voir le profil</a>
                                <a href="../assets/logout.php" class="profil-buttons__logout">Déconnexion</a>
                            </div>
                    </div>
            </div>
            <!-- Management des salons -->
            <div class="room-manage">
                <div class="room-manage__searchBar">
                    <button type="submit" class="room-manage__searchBar__button">
                        <i class="fa fa-search"></i>
                    </button>
                    <input type="text" class="room-manage__searchBar__field" name="username" placeholder="Recherche un salon...">
                </div>
                <div class="room-manage-add">
                    <span onclick="popup()">Ajouter <i class="fas fa-plus-circle"></i></span>
                </div>
            </div>
        <!--Liste des salons -->
            <div class="room-list">
                <?php 
                    $req = $pdo->prepare("SELECT * FROM conversation ORDER BY conversation_id DESC");
                    $req->execute();
                    $rooms = $req->fetchAll();
                    foreach($rooms as $room) {
                        echo "<div class='room-list-bar' onclick='join($room->conversation_id)'>";
                        echo "<div class='room-list-bar__img' style='background-image: url(";
                         if($room->conv_img){
                            echo "\"./media/room-img/$room->conv_img\"";
                        }else {
                            echo "\"./media/sources/imgGroup.jpg\"";
                        };
                        echo ")';></div>";
                        echo "<div class='room-list-bar-infos'>
                                    <b>$room->conv_name</b>
                                    <p>$room->conv_desc</p>
                                </div>
                        </div>";
                    }
                ?>
            </div>
        </div>

    <!-- Zone du tchat -->
        <div class="chat">

            <div class="chat__area" id="chat__msg-area">

            </div>

            <div class="chat__msg-send" id="chat__msg-send">

            </div>
        </div>

    <!-- Description du salon actuel -->
        <div class="sidebar-right" id="sidebar-right">
        </div>
    </main>
    <!-- Création d'un salon -->
    <div id="popup">
        <div class="popup__container">
            <form action="ajax/create.php" method="POST" id="room-create">
                <span  class="alert-error" id="alert-name"></span><br/>
                <span class="alert-error" id="alert-pswd"></span>
                <div name="room-create__img" id="room-create__img" style="background-image: url(<?php echo "media/sources/imgGroup.jpg"; ?>);">
                    <label> 
                        <img id="room-create__img-mask" name="room-create__img-mask" src="media/sources/modifImg.png">
                        <input type="file" name="room-create__img-upload" id="room-create__img-upload" onchange="document.getElementById('room-create__img').style.backgroundImage = 'url' +'(' + window.URL.createObjectURL(this.files[0]) + ')';" style="display:none">
                    </label>
                </div>
                <input type="text" name="room-create__name" id="room-create__name" placeholder="Nom du salon">
                <div>
                    <label>Description</label><br/>
                    <textarea name="room-create__desc" maxlength="255" rows="4" cols="50" style="resize:none;" ></textarea>
                </div>
                <div>
                    <label>Salon Privée</label>
                    <input type="checkbox" name="room-create__check" id="room-create__check">
                    <input type="password" name="room-create__pswd" id="room-create__pswd" placeholder="Mot de passe" disabled>   
                    <i class="far fa-eye" id="room-create__pswd-see" onclick="seePswd()"style="visibility:hidden;"></i>
                </div>
            </form>
            <ul>
                <li><a href="#" onclick="popup()">ANNULER</a></li>
                <li><a href="#" onclick="return controleChamps()">CRÉER</a></li>
            </ul>
        </div>
    </div>


    <script src="js/popup.js"></script>
    <script src="js/create.js"></script>
    <script src="js/see.js"></script>
    <script src="js/join.js"></script>
</body>
</html>