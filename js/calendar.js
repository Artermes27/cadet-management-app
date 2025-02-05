function showResutsSearchForOwner(str) {
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
  xmlhttp.open("GET","functions.php?search_first_name_owner="+str, "true");
  xmlhttp.send();
}

function resultHasBeenClickedOwner(user_id) {
  //console.log(user_id);
  document.getElementById("livesearch_owner").innerHTML="";
  document.getElementById("livesearch_owner").style.border="0px";
  document.getElementById("event_owner_search_box").value = "";
  document.getElementById("owner_id").value = user_id;
  return;
}

function populateAdminEditEventForm(parade_id, event_id, event_type, event_name, event_start, event_end, owner_id, final_aproval) {
  console.log(owner_id);
  document.getElementById("parade_id").value = parade_id;
  document.getElementById("event_id").value = event_id;
  document.getElementById("event_type").value = event_type;
  document.getElementById("event_name").value = event_name;
  document.getElementById("event_start").value = event_start;
  document.getElementById("event_end").value = event_end;
  document.getElementById("owner_id").value = owner_id;
  document.getElementById("final_aproval").value = final_aproval;
  return;
}