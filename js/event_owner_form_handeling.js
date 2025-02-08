function showResutsSearchForOwner(str) {//returns search results for an owner's first name in the add event form
    //console.log(str);
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
    xmlhttp.open("GET","add_requests.php?search_first_name_owner="+str,true);
    xmlhttp.send();
}
  
function resultHasBeenClickedOwner(user_id) {//returns the user_id of the owner selected in the add event form
    console.log(user_id);
    document.getElementById("livesearch_owner").innerHTML="";
    document.getElementById("livesearch_owner").style.border="0px";
    document.getElementById("owner_id").value = user_id;
    displayCurrentOwnerOfEvent(user_id);
    document.getElementById("event_owner_search_box").value = "";
    return;
}

function displayCurrentOwnerOfEvent(owner_id) {//returns the rank first_name and last_name in html format of the owner selected in the add event form
    //console.log(owner_id);
    if (owner_id.length==0) {
    document.getElementById("display_current_owner").innerHTML = "";
    return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
        var owner_info = JSON.parse(this.responseText);
        document.getElementById("display_current_owner").innerHTML="<a>curent owner: " + owner_info.rank + " " + owner_info.first_name + " " + owner_info.last_name + "<a>";
    }
    }
    //owner_id_rank_first_and_last_name
    xmlhttp.open("GET","add_requests.php?user_id_info_dump="+owner_id,true);
    xmlhttp.send();
}