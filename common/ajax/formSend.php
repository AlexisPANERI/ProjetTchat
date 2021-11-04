<?php
    require_once "../inc/db.php";
    $id = $_POST['id'];
    echo "<form action=\"ajax/send.php\" method=\"POST\" class=\"message-send\" id=\"$id\">";
    echo "<input type=\"text\" class=\"message-sendfield\" name=\"message-sendfield\" placeholder=\"Tapez votre message...\">";
    echo "<button type=\"submit\" class=\"message-sendbutton\" id=\"message-sendbutton\">";
    echo "Envoyer";
    echo "</button>";
    echo "</form>";
