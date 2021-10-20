
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Connexion - Inscription</title>
</head>

<body>
    <?php 
        session_start();
        if(isset($_SESSION['error'])){
            echo "<div class=\"errorPHP\">".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        } else if(isset($_SESSION['success'])){
            echo "<div class=\"successPHP\">".$_SESSION['success']."</div>";
            unset($_SESSION['success']);
        }
    ?>
    <div class="container">
        <div class="bluebg">
            <div class="box signin">
                <h2>Déjà Inscrit ?</h2>
                <button class="signinBtn">Connectez vous</button>
            </div>
            <div class="box signup">
                <h2>Vous n'avez pas de compte ?</h2>
                <button class="signupBtn">Inscrivez vous</button>
            </div>
        </div>
        <div class="formBx">
            <div class="form signinForm">
                <form action="back/connection.php" method="POST">
                    <h3>Connectez vous</h3>
                    <input type="text" name="username" placeholder="Nom d'utilisateur">
                    <input type="password" name="pswd" placeholder="Mot de passe">
                    <input type="submit" value="Se connecter">
                    <a href="#" class="forgot">Mot de passe oublié</a>
                </form>
            </div>

            <div class="form signupForm">
                <form action="back/register.php" method="POST">
                    <h3>Inscrivez vous</h3>
                    <span class="consigne">Votre nom d'utilisateur doit être compris entre 4 à 16 caractères</span>
                    <input id="inscr_nom" type="text" name="username" placeholder="Nom d'utilisateur">
                    <span class="alertError" id="errorUsername"></span>
                    <span class="consigne">Le format de votre email doit être conforme au format standard</span>
                    <input id="inscr_email" type="email" name="email" placeholder="Adresse Email">
                    <span class="alertError" id="errorEmail"></span>
                    <span class="consigne">Votre mot de passe doit être compris entre 8 à 16 caractères</span>
                    <input id="inscr_mdp" type="password" name="pswd" placeholder="Mot de passe">
                    <span class="alertError" id="errorPswd"></span>
                    <span class="consigne">Le mot de passe doit être identique</span>
                    <input id="inscr_confirm" type="password" name="pswdConf" placeholder="Confirmer Mot de passe">
                    <span class="alertError" id="errorPswdConf"></span>
                    <input type="text" id="validation" value="" name="validation" hidden>
                    <input type="submit" onClick="return controleChamps()" value="S'inscrire">
                </form>
            </div>
        </div>
    </div>


    <script>
        // Script dédié à l'animation de l'interface inscription/connexion.

        //définition des constantes
        const signinBtn = document.querySelector('.signinBtn');
        const signupBtn = document.querySelector('.signupBtn');
        const formBx = document.querySelector('.formBx');
        const body = document.querySelector('body');

        // Animation
        signupBtn.onclick = function() {
            formBx.classList.add('active')
            body.classList.add('active')
        }

        signinBtn.onclick = function() {
            formBx.classList.remove('active')
            body.classList.remove('active')
        }
    </script>

    <script>
        // Script dédié au controle de la validité des champs d'inscription.

        function controleChamps() {
            let error = {
                "errorUsername": 0,
                "errorEmail": 0,
                "errorPswd": 0,
                "errorPswdConf": 0
            }

            // Pour optimiser la lisibilité je définie des variables affiliées à document.getElementById
            let nom = document.getElementById('inscr_nom').value;
            let email = document.getElementById('inscr_email').value;
            let mdp = document.getElementById('inscr_mdp').value;
            let mdp2 = document.getElementById('inscr_confirm').value;
            const regexUser = /^[\w-]+$/;
            const regexEmail = /^([\w.-])+?\w+[(?=@)]+[@(?=a-z)]+[a-z(?=\-)]+[a-z]+[.]+[a-z]{2,3}/;
            let valid = true;

            // Champ Pseudo
            if (nom == "") {
                error["errorUsername"] = "Le champ ci-dessus est vide";
                valid = false;
            } else if(!regexUser.test(nom)){
                error["errorUsername"] = "Votre nom d'utilisateur n'est pas conforme";
                valid = true;
            } else if(nom.length > 3 && nom.length < 17) {
            } else {
                error["errorUsername"] = "Votre nom d'utilisateur doit être compris entre 4 et 16 caractères";
                valid = true;
            }

            // Champ Email
            if (email == "") {
                error["errorEmail"] = "Le champ Email est vide";
                valid = false;
            } else if(!regexEmail.test(email)){
                error["errorEmail"] = "Adresse Mail non valid";
                valid = false;
            }

            // Champ Mot de passe
            if (mdp == "") {
                error["errorPswd"] = "Le champ Mot de passe est vide";
                valid = false;
            } else if(mdp.length > 7 && mdp.length < 25) {
                if (mdp != mdp2){
                    error['errorPswdConf'] = "Le mot de passe ne correspond pas";
                    valid = false;
                }
            } else {
                error["errorPswd"] = "Taille du mdp incorrect";
                valid = false;
            }

            if(valid){
                validation.value = "ok";
                return true;
            } else{
                for(n in error){
                    if(error[n] != 0) {
                        document.getElementById(n).innerHTML = error[n];
                    } else {
                        document.getElementById(n).innerHTML = "";
                    }
                }
            return false;
            }
        } 
    </script>
</body>

</html>