let test = null;

function join(id){
    test2();
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "ajax/message.php", true);
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('chat__msg-area').innerHTML = this.responseText;
      }
    };
xhttp.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
);
xhttp.send("id="+id);
    test = setInterval(function kekw(){
      var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "ajax/message.php", true);
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('chat__msg-area').innerHTML = this.responseText;
          }
        };
    xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    xhttp.send("id="+id);
    }, 1000);

  // Champ envoi du message
    var formCreat = new XMLHttpRequest();
    formCreat.open("POST", "ajax/formSend.php", true);
    formCreat.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('chat__msg-send').innerHTML = this.responseText;
        }
      }
    formCreat.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );
    formCreat.send("id="+id);

  // Description du salon
    var roomInfos = new XMLHttpRequest();
    roomInfos.open("POST", "ajax/roomInfos.php", true);
    roomInfos.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('sidebar-right').innerHTML = this.responseText;
      }
    };
      roomInfos.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
    roomInfos.send("id="+id);

    var chat = document.getElementById('chat__msg-area');
    chat.scrollTo = chat.scrollHeight;
};

function test2(){
    if(test != null){
        clearInterval(test);
    }
} 

function link(id){
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "ajax/send.php", true);
  xhttp.onreadystatechange = function () {
if (this.readyState == 4 && this.status == 200) {
  document.getElementById("message-send__field").value = "";
}
};
let form = new FormData(document.getElementById(id))
console.log(form)
xhttp.send(form);
  return false;
} 