<?php 
    session_start();
    if($_SESSION['auth']){
        require_once "inc/db.php";
        $user_id = $_SESSION['auth']->user_id;
        $req = $pdo->prepare("SELECT * FROM profile WHERE user_id = $user_id ");
        $req->execute([$user_id]);
        $user = $req->fetch();
        $path = "media/avatar/";
        if(!empty($_POST['password'])){
            if(password_verify($_POST['password'], $_SESSION['auth']->pswd)){
                if (!empty($_FILES["profilAvatar"])) {
                    $taillemax = 2097152;
                    $entensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                    $extensionUpload = strtolower(substr(strrchr($_FILES['profilAvatar']['name'], '.'), 1));
                    if($_FILES['profilAvatar']['size'] <= $taillemax && in_array($extensionUpload, $entensionsValides)){
                        $avatar = $user->profile_id.trim(filter_var($_FILES["profilAvatar"]['name'], FILTER_SANITIZE_STRING));
                        $path = "media/avatar/" .$avatar;
                        $move = move_uploaded_file($_FILES['profilAvatar']['tmp_name'],$path);
                    } else {
                        $avatar = $user->avatar;
                    }
                }
                if (!empty($_POST["pseudo"])) {$pseudo = filter_var($_POST["pseudo"], FILTER_SANITIZE_STRING);} else {$pseudo = $user->pseudo;}
                if (!empty($_POST["age"])) {$age = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);} else {$age = $user->age;}
                if (!empty($_POST["gender"])) {$gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);} else {$gender = $user->gender;}
                if (!empty($_POST["location"])) {$location = filter_var($_POST["location"], FILTER_SANITIZE_STRING);} else {$location = $user->location;}
                $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
                $req = $pdo->prepare("UPDATE profile SET avatar = ?, pseudo = ?, age = ?, gender = ?, location = ?, description = ? WHERE user_id = $user_id");
                $req->execute([$avatar,$pseudo,$age,$gender,$location,$description]);
                header("location: read.php");
                die();
            }
        }
    }else{
        header("location: read.php");
        die();
    }
?>


<?php 
$loc = '<select name="location">
            <option value="" selected>Je suis de proche de</option>
            <option value="Bour-en-Bresse">Bour-en-Bresse (01)</option>
            <option value="Laon">Laon (02)</option>
            <option value="Moulins">Moulins (03)</option>
            <option value="Digne">Digne (04)</option>
            <option value="Gap">Gap (05)</option>
            <option value="Nice">Nice (06)</option>
            <option value="Privas">Privas (07)</option>
            <option value="Charleville">Charleville-Mézières (08)</option>
            <option value="Foix">Foix (09)</option>
            <option value="Troyes">Troyes (10)</option>
            <option value="Carcassonne">Carcassonne (11)</option>
            <option value="Rodez">Rodez (12)</option>
            <option value="Marseille">Marseille (13)</option>
            <option value="Caen">Caen (14)</option>
            <option value="Aurillac">Aurilac (15)</option>
            <option value="Angouleme">Angoulême (16)</option>
            <option value="Larochelle">La Rochelle (17)</option>
            <option value="Bourges">Bourges (18)</option>
            <option value="Tulle">Tulle (19)</option>
            <option value="Ajaccio">Ajaccio (2A)</option>
            <option value="Bastia">Bastia (2B)</option>
            <option value="Dijon">Dijon (21)</option>
            <option value="Saintbrieuc">Saint-Brieuc (22)</option>
            <option value="Gueret">Guéret (23)</option>
            <option value="Perigueux">Périgueux (24)</option>
            <option value="Besancon">Besançon (25)</option>
            <option value="Lille">Valence (26)</option>
            <option value="Evreux">Evreux (27)</option>
            <option value="Chartres">Chartres (28)</option>
            <option value="Quimper">Quimper (29)</option>
            <option value="Nimes">Nîmes (30)</option>
            <option value="Toulouse">Toulouse (31)</option>
            <option value="Auch">Auch (32)</option>
            <option value="Bordeaux">Bordeaux (33)</option>
            <option value="Montpellier">Montpellier (34)</option>
            <option value="Rennes">Rennes (35)</option>
            <option value="Chateauroux">chateauroux (36)</option>
            <option value="Tours">Tours (37)</option>
            <option value="Grenoble">Grenoble (38)</option>
            <option value="Lons-le-Saunier">Lons-le-Saunier (39)</option>
            <option value="Montdemarsan">Mont-de-Marsan (40)</option>
            <option value="Blois">Blois (41)</option>
            <option value="Saint-Etienne">Saint-Etienne (42)</option>
            <option value="Le Puy-en-Velay">Le Puy-en-Velay (43)</option>
            <option value="Nantes">Nantes (44)</option>
            <option value="Orléans">Orléans (45)</option>
            <option value="Cahors">Cahors (46)</option>
            <option value="Agen">Agen (47)</option>
            <option value="Mende">Mende (48)</option>
            <option value="Angers">Angers (49)</option>
            <option value="Saint-Lô">Saint-Lô (50)</option>
            <option value="Châlons-en-Champagne">Châlons-en-Champagne (51)</option>
            <option value="Chaumont">Chaumont (52)</option>
            <option value="Laval">Laval (53)</option>
            <option value="Nancy">Nancy (54)</option>
            <option value="Bar-le-Duc">Bar-le-Duc (55)</option>
            <option value="Vannes">Vannes (56)</option>
            <option value="Metz">Metz (57)</option>
            <option value="Nevers">Nevers (58)</option>
            <option value="Lille">Lille (59)</option>
            <option value="Beauvais">Beauvais (60)</option>
            <option value="Alençon">Alençon (61)</option>
            <option value="Arras">Arras (62)</option>
            <option value="Clermont-Ferrand">Clermont-Ferrand (63)</option>
            <option value="Pau">Pau (64)</option>
            <option value="Tarbes">Tarbes (65)</option>
            <option value="Perpignan">Perpignan (66)</option>
            <option value="Strasbourg">Strasbourg (67)</option>
            <option value="Colmar">Colmar (68)</option>
            <option value="Lyon">Lyon (69)</option>
            <option value="Vesoul">Vesoul (70)</option>
            <option value="Mâcon">Mâcon (71)</option>
            <option value="Le Mans">Le Mans (72)</option>
            <option value="Chambéry">Chambéry (73)</option>
            <option value="Annecy">Annecy (74)</option>
            <option value="Paris">Paris (75)</option>
            <option value="Rouen">Rouen (76)</option>
            <option value="Melun">Melun (77)</option>
            <option value="Versailles">Versailles (78)</option>
            <option value="Niort">Niort (79)</option>
            <option value="Amiens">Amiens (80)</option>
            <option value="Albi">Albi (81)</option>
            <option value="Montauban">Montauban (82)</option>
            <option value="Toulon">Toulon (83)</option>
            <option value="Avignon">Avignon (84)</option>
            <option value="La-Roche-sur-Yon">La-Roche-sur-Yon (85)</option>
            <option value="Poitiers">Poitiers (86)</option>
            <option value="Limoges">Limoges (87)</option>
            <option value="Epinal">Epinal (88)</option>
            <option value="Auxerre">Auxerre (89)</option>
            <option value="Belfort">Belfort (90)</option>
            <option value="Evry">Evry (91)</option>
            <option value="Nanterre">Nanterre (92)</option>
            <option value="Bobigny">Bobigny (93)</option>
            <option value="Créteil">Créteil (94)</option>
            <option value="Pontoise">Pontoise (95)</option>
        </select>'
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profil.css">
    <title>Profil - Modification</title>
</head>
<body>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <fieldset class="profil-update">
            <legend class="profil-update-avatar" style="background-image: url(<?php if($user->avatar != null){echo "'".$path.$user->avatar."'";} else {echo "media/sources/avatar.png";}  ?>);">
                <label> 
                    <img class="profil-update-avatar__img" name="avatar" src="media/sources/modifAvatar.png" style="width: auto;">
                    <input type="file" name="profilAvatar" id="ava" onchange="document.getElementById('avatar').style.backgroundImage = 'url' +'(' + window.URL.createObjectURL(this.files[0]) + ')';" style="display:none">
                </label>
            </legend>
            <div class="profil-update-infos">
                <div>
                    <span>Pseudo : </span><br/>
                    <input type="text" name="pseudo" value="<?php echo $user->pseudo ?>">
                </div>
                <div class="profile-update-infos-old-gender">
                    <div>
                        <span>Âge : </span><br/>
                        <input type="number" min="8" name="age" value="<?php echo $user->age ?>">
                    </div>
                    <div>
                        <span>Genre : </span><br/>
                        <select name="gender">
                            <option value="" selected>Je suis un(e)</option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                            <option value="Non précisé">Non précisé</option>
                        </select>
                    </div>
                </div>
                <div>
                    <span>Localisation : </span>
                    <?php echo $loc ?>
                </div>
                <span>Description : </span>
                <textarea  name="description" maxlength="255" rows="6" cols="30" ><?php echo $user->description ?></textarea>
                <span class="profil-update-error" id="profil-update-error"></span>
                <input type="password" name="password" id="pswd" placeholder="Mot de passe"><br/>
            </div>
            <div class="profil-update__buttons">

                <div class="profil-update-buttons">
                    <p onclick="popup()" class="profil-update-buttons__delete">Supprimer le compte</p>
                        <ul>
                            <li><a href="read.php">Retour</a></li>
                            <li><input type="submit" onclick="return controlePassword()" value="Confirmer"></li>
                        </ul>      
                </div>

                <!-- POPUP Supprimer le compte -->
                <div id="popup">
                    <div class="popupcontainer">
                        <p>Voulez-vous vraiment supprimer votre compte ?</p>
                        <ul>
                            <li><a href="../assets/delete.php">OUI</a></li>
                            <li><a href="update.php">NON</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <script>function popup() {document.getElementById("popup").style.display = "block";}</script>
    <script>
        function controlePassword() {
            let pswd = document.getElementById("pswd").value;
            if (pswd == "") {
                document.getElementById('profil-update-error').innerHTML="Veuillez confirmer votre mot de passe";
                document.getElementById('profil-update-error').style.display="block";
                return false;
            } document.getElementById('profil-update-error').style.display="none";   
        }
    </script>
</body>
</html>  