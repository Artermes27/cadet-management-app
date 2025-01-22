function showResult(str, search_for) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  if (search_for == "search_first_name") {
    xmlhttp.open("GET","functions.php?search_first_name="+str,true);
    xmlhttp.send();
  } else if  (search_for == "search_last_name"){
    xmlhttp.open("GET","functions.php?search_last_name="+str,true);
    xmlhttp.send();
  } else if  (search_for == "search_rank") {
    xmlhttp.open("GET","functions.php?search_rank="+str,true);
    xmlhttp.send();
  }
}

function resultHasBeenClicked(user_id) {
  //document.write(user_id);
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.open("POST", "functions.php?add_user_id=" + user_id + "&event_id=5")
  xmlhttp.send();
}