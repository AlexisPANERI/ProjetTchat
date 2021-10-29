
let roomCheck = document.getElementById("room-create__check");
let roomPswd = document.getElementById("room-create__pswd");
let roomPswdSee = document.getElementById("room-create__pswd-see");

roomCheck.addEventListener("change", function(event) {
    if (event.target.checked) {
        roomPswd.disabled = false;
        roomPswdSee.style.visibility= "visible";
        
    } else {
        roomPswd.disabled = true; roomPswd.value = "";
        roomPswdSee.style.visibility= "hidden";}
}, false);


function seePswd(){
    
    roomPswd.type == "password" ? roomPswd.type  = "text" : roomPswd.type  = "password";
    roomPswdSee.className == "far fa-eye" ? roomPswdSee.className  = "far fa-eye-slash" : roomPswdSee.className = "far fa-eye";
}
