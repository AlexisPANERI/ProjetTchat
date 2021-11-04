let test = null;

function join(id){
  clear();
    test = setInterval(function kekw(){
    var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "ajax/message.php", true);
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('message').innerHTML = this.responseText;
        }
      };
      xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      
      xhttp.send("id="+id);
    }, 500);
    var form = new XMLHttpRequest();
      form.open("POST", "ajax/message.php", true);
      form.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('message-send').innerHTML = this.responseText;
        }
      };
      form.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      
      form.send("id="+id);
}
function clear(){
    if(test != null){
        clearInterval(test);
    }
}