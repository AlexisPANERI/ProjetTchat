function controleChamps() {
    let error = {
        "alert-name":0,
        "alert-pswd":0
    }
    let roomName = document.getElementById('room-create__name').value;
    let roomPswd = document.getElementById('room-create__pswd').value;
    let roomCheck = document.getElementById('room-create__check').value;
    const regexRoomName = /^[\w-]+$/;
    let valid = true;
//Verif du champ nom
    if (roomName == "") {
        error["alert-name"] = "Le champ Nom du Salon est vide";
        valid = false;
    } else if (!regexRoomName.test(roomName)) {
        error["alert-name"] = "Le champ 'Nom du Salon' comporte des caractères non autorisés";
        valid = false;
    } else if (roomName.length <= 2 || roomName.length > 17) {
        error["alert-name"] = "Le Nom du Salon doit comporter de 2 à 16 caractères";
        valid = false;
    } else valid = true;
//Verif du mot de passe   
    if (roomCheck.checked == true){
        if (roomPswd == "") {
            error["alert-pswd"] = "Le champ Mot de passe est vide";
            valid = false;
        } else if (roomPswd.length < 3 || roomPswd.length > 17) {
            error["alert-pswd"] = "Le Mot de passe doit comporter de 4 à 16 caractères";
            valid = false;
        } else valid = true;
    }
    

    if(valid){
        create();
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