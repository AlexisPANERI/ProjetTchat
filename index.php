<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="common/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Connexion - Inscription</title>
</head>

<body>
    <?php 
        session_start();
        if(isset($_SESSION['error'])){
            echo "<div class=\"msg-alert-error\">".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        } else if(isset($_SESSION['success'])){
            echo "<div class=\"msg-alert-correct\">".$_SESSION['success']."</div>";
            unset($_SESSION['success']);
        }
    ?>
    <div class="sign">
        <div class="sign-switch">
            <div class="sign-switch-signs signin">
                <h2>Déjà Inscrit ?</h2>
                <button class="sign-switch-signs__button-signin">Connectez vous</button>
            </div>
            <div class="sign-switch-signs signup">
                <h2>Vous n'avez pas de compte ?</h2>
                <button class="sign-switch-signs__button-signup">Inscrivez vous</button>
            </div>
        </div>
        <div class="forms">
            <div class="form form-signin">
                <form action="assets/login.php" method="POST">
                    <h3>CONNEXION</h3>
                    <div class="form-field">
                        <input type="text" name="username" placeholder="Nom d'utilisateur">
                        <i class="fa fa-user fa-lg"></i>
                    </div>
                    <div class="form-field">
                        <input type="password" name="pswd" placeholder="Mot de passe">
                        <i class="fas fa-lock fa-lg"></i>                 
                    </div>
                    <input type="submit" value="Se connecter">
                    <a href="assets/reset.php" class="form-forgotPswd">Mot de passe oublié ?</a>
                </form>
            </div>

            <div class="form form-signup">
                <form action="assets/signup.php" method="POST">
                    <h3>INSCRIPTION</h3>
                    <div class="form-field">
                        <input id="inscr_nom" type="text" name="username" placeholder="Nom d'utilisateur">
                        <i class="fa fa-user fa-lg"></i>
                    </div>
                    <span class="form-signup-alert-error" id="errorUsername"></span>                   
                    <div class="form-field">
                        <input id="inscr_email" type="email" name="email" placeholder="Adresse Email">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                    <span class="form-signup-alert-error" id="errorEmail"></span>
                    <div class="form-field">
                        <input id="inscr_mdp" type="password" name="pswd" placeholder="Mot de passe">
                        <i class="fas fa-lock fa-lg"></i>
                    </div>
                    <span class="form-signup-alert-error" id="errorPswd"></span>
                    <div class="form-field">
                        <input id="inscr_confirm" type="password" name="pswdConf" placeholder="Confirmer Mot de passe">
                        <i class="fas fa-lock fa-lg"></i>                        
                    </div>
                    <span class="form-signup-alert-error" id="errorPswdConf"></span>
                    <input type="text" id="validation" value="" name="validation" hidden>
                    <input type="submit" onclick="return controleChamps()" value="S'inscrire">
                </form>
            </div>
        </div>
    </div>


    <script>
        // Script dédié à l'animation de l'interface inscription/connexion.

        //définition des constantes
        const signinBtn = document.querySelector('.sign-switch-signs__button-signin');
        const signupBtn = document.querySelector('.sign-switch-signs__button-signup');
        const form = document.querySelector('.forms');
        const body = document.querySelector('body');

        // Animation
        signupBtn.onclick = function() {
            form.classList.add('active')
            body.classList.add('active')
        }

        signinBtn.onclick = function() {
            form.classList.remove('active')
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