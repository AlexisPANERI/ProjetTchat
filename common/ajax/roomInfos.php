<?php
require_once "../inc/db.php";
$id = $_POST["id"];
$req = $pdo->prepare("SELECT conv_img,conv_name,conv_desc FROM conversation WHERE conversation_id = ?");
$req->execute([$id]);
$roomInfos = $req->fetch();

echo "
    <div id=\"$id\" class=\"room-info\">
        <h2>$roomInfos->conv_name</h2>";
        echo "<div class='room-info__img' style='background-image: url(";
        if($roomInfos->conv_img){
           echo "\"./media/room-img/$roomInfos->conv_img\"";
       }else {
           echo "\"./media/sources/imgGroup.jpg\"";
       };
       echo ")';></div>";
           
            echo "<p>$roomInfos->conv_desc</p>
            <hr/>
            <div class='room-info-Participants'>
                <div class='room-info-Participants__avatar' style='background-image: url()'></div>
            </div>
            <span class=\"room-info-logout\">Déconnexion</span>
    </div>";
?>