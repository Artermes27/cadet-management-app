function showResutsSearchForOwner(str) {    console.log(str);
    if (str.length==0) {
      document.getElementById("livesearch_owner").innerHTML="";
      document.getElementById("livesearch_owner").style.border="0px";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch_owner").innerHTML=this.responseText;
        document.getElementById("livesearch_owner").style.border="1px solid #A5ACB2";
      }
    }
    xmlhttp.open("GET","requests/event_details_requests.php?search_first_name_owner="+str,true);
    xmlhttp.send();
}
  
function resultHasBeenClickedOwner(user_id) {    console.log(user_id);
    document.getElementById("livesearch_owner").innerHTML="";
    document.getElementById("livesearch_owner").style.border="0px";
    document.getElementById("owner_id").value = user_id;
    displayCurrentOwnerOfEvent(user_id);
    document.getElementById("event_owner_search_box").value = "";
    return;
}

function displayCurrentOwnerOfEvent(owner_id) {        if (owner_id.length==0) {
    document.getElementById("display_current_owner").innerHTML = "";
    document.getElementById("display_current_owner").innerHTML="<a>curent owner: none selected<a>";
    return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
        var owner_info = JSON.parse(this.responseText);
        document.getElementById("display_current_owner").innerHTML="<a>curent owner: " + owner_info.rank + " " + owner_info.first_name + " " + owner_info.last_name + "<a>";
    }
    }
        xmlhttp.open("GET","requests/add_get_requests.php?user_id_info_dump="+owner_id,true);
    xmlhttp.send();
}