
<?php 
session_start();
require_once '../common/inc/functions.php';
require_once '../common/inc/db.php';
    // Vérifie si le formulaire est vide ou pas
    if(!empty($_POST['validation'])){
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING); // Variable qui prend la valeur du champ nom
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL, FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Variable qui prend la valeur du champ email
        $regexUser = "/^[\w-]+$/"; // Regex du nom
        $regexEmail = "/^([\w.-])+?\w+[(?=@)]+[@(?=a-z)]+[a-z(?=\-)]+[a-z]+[.]+[a-z]{2,3}$/"; // Regex du mail
        $pswd = $_POST["pswd"]; // Variable qui prend la valeur du champ mot de passe
        $pswdConf = $_POST["pswdConf"]; // Variable qui prend la valeur du champ confirmation du mot de passe

        // Vérif du nom d'utilisateur
        if(empty($username)){ // Vérifie si le champ nom est vide
            $_SESSION["error"] = "Le champ du nom d'utilisateur est vide"; // Message d'erreur
            header("location: ../index.php");
            die();
        } else if(strlen($username) < 3 && strlen($username) > 17){ // Vérifie si le nom est compris entre 4 et 16 caractères
            $_SESSION["error"] = "Le nom doit être compris entre 4 et 16 caractères"; // Message d'erreur
            header("location: ../index.php");
        } else if(!preg_match($regexUser, $username)){         // Vérifie si le nom correspond au pattern
            $_SESSION["error"] = "Nom d'utilisateur invalide"; // Message d'erreur
            header("location: ../index.php");
            die();
        } else {
            $req = $pdo->prepare('SELECT * FROM users WHERE username = ?');
            $req->execute([$username]);
            $user = $req->fetch();
            if($user){
                $_SESSION["error"] = "Ce pseudo est déjà pris."; // Message d'erreur
                header("location: ../index.php");
                die();
            }
        }

        // Vérification de l'email
        if(empty($email)){ // Vérifie si le champ email est vide
            $_SESSION["error"] = "Le champ ci-dessus est vide"; // Message d'erreur
            header("location: ../index.php");
            die();
        } else if(!preg_match($regexEmail, $email)){ // Vérifie si l'email correspond au pattern
            $_SESSION["error"] = "L'email n'est pas conforme"; // Message d'erreur
            header("location: ../index.php");
            die();
        } else {
            $req = $pdo->prepare('SELECT * FROM users WHERE email = ?');
            $req->execute([$email]);
            $user = $req->fetch();
            if($user){
                $_SESSION["error"] = "L'email est déjà pris."; // Message d'erreur
                header("location: ../index.php");
                die();
            }
        }

        // Vérif du mot de passe
        if(empty($pswd)){  // Vérifie sur le mot de passe est vide
            $_SESSION["error"] = "Le champ ci-dessus est vide"; // Message d'erreur
            header("location: ../index.php");
            die();
        } else if(strlen($pswd) < 7 && strlen($pswd) > 25){ // Vérifie si le mot de passe est compris entre 8 et 24 caractères
            $_SESSION["error"] = "Le mot de passe doit être compris entre 8 et 24 caractères"; // Message d'erreur
            header("location: ../index.php");
            die();
        } else if($pswd != $pswdConf){ // Vérifie si le mot de passe correspond à la confirmation
            $_SESSION["error"] = "Les mots de passe sont différents"; // Message d'erreur
            header("location: ../index.php");
            die();
        } else {
            $pswd = password_hash($pswd, PASSWORD_BCRYPT);
        }

        $token = str_random(60); //Genère un token de 60 caractères
echo "ok";
        $req = $pdo->prepare("INSERT INTO users SET email = ?, username = ?,  pswd = ?, token_conf = ?,roles='membre'");
        $req->execute([$email, $username, $pswd, $token]);
        $req = $pdo->prepare('SELECT user_id FROM users where username = ?');
        $req->execute([$username]);
        $user = $req->fetch();
        $user_id = $user->user_id ;
        $message = "Merci de vous être enregistré, pour finaliser l'inscription, veuillez cliquer sur le lien ci-dessous<br/>" . "<a href=\"http://localhost/ConnexionInscription/assets/confirm.php?token=$token&id=$user_id\">Confirmer votre compte</a>\">Compte</a>";      
        $fp = fopen('mail.txt','a+'); 
            fwrite($fp, "$email,$message\n");
            fclose($fp);
        $_SESSION['success'] = "Compte créer ✔ "."<a href=\"http://localhost/ConnexionInscription/assets/confirm.php?token=$token&id=$user_id\" style=\"color:white;\">Confirmer</a>";
        header("location: ../index.php");
        echo "ok";
        die();
    } else {
        $_SESSION["error"] = "Veuillez remplir le formulaire"; // Message d'erreur
        header("location: ../index.php");
        die();
    }