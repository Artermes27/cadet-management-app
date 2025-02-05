function showResult(str, search_for, event_id) {
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
      xmlhttp.open("GET","functions.php?search_first_name="+str+"&event_id=" + event_id,true);
      xmlhttp.send();
    }
  }
  
  function showResultDelete(str, search_for, event_id) {
    if (str.length==0) {
      document.getElementById("livesearch_delete").innerHTML="";
      document.getElementById("livesearch_delete").style.border="0px";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch_delete").innerHTML=this.responseText;
        document.getElementById("livesearch_delete").style.border="1px solid #A5ACB2";
      }
    }
    if (search_for == "search_first_name_delete") {
      xmlhttp.open("GET","functions.php?search_first_name_delete="+str+"&event_id=" + event_id,true);
      console.log("functions.php?search_first_name_delete="+str+"&event_id=" + event_id);
      xmlhttp.send();
    }
  }
  
  function resultHasBeenClicked(user_id, event_id) {
    //document.write(user_id);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("POST", "functions.php?add_user_id=" + user_id + "&event_id=" + event_id + "")
    xmlhttp.send();
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    document.getElementById("search_first_name").value = "";
    return;
  }
  
  function resultHasBeenClickedDelete(user_id, event_id) {
    //document.write(user_id);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.open("POST", "functions.php?remove_user_id=" + user_id + "&event_id=" + event_id + "")
    xmlhttp.send();
    document.getElementById("livesearch_delete").innerHTML="";
    document.getElementById("livesearch_delete").style.border="0px";
    document.getElementById("search_first_name_delete").value = "";
    return;
  }