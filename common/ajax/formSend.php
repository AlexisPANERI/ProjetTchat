<?php
require_once "../inc/db.php";
$id = $_POST["id"];
    
echo "<form action=\"#\" method=\"POST\" class=\"chat__msg-form\" id=\"$id\" onsubmit=\"return link($id)\">
        <i class=\"fas fa-paperclip fa-lg\"></i>
        <input type=\"text\" class=\"chat__msg__field\" id=\"message-send__field\" name=\"chat__msg__field\" placeholder=\"Tapez votre message...\">
        <input type=\"text\" value=\"$id\" name=\"id\" style=\"display:none\">
            <button type=\"submit\" class=\"chat__msg__button\" id=\"message-send__button\">
                <i class=\"fa fa-paper-plane\"></i>
            </button>
        </form>"; 