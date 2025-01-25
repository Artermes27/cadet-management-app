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
    xmlhttp.open("GET","functions.php?search_first_name_owner="+str,true);
    xmlhttp.send();
  }

function resultHasBeenClickedOwner(user_id) {
    //console.log(user_id);
    document.getElementById("livesearch_owner").innerHTML="";
    document.getElementById("livesearch_owner").style.border="0px";
    document.getElementById("owner_id").value = user_id;
    return;
}

function showResutsSearchForUserFirstName(str) {
    //console.log(str);
    if (str.length==0) {
        document.getElementById("livesearch_first_name").innerHTML="";
        document.getElementById("livesearch_first_name").style.border="0px";
        return;
      }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch_first_name").innerHTML=this.responseText;
          document.getElementById("livesearch_first_name").style.border="1px solid #A5ACB2";
        }
      }
      //console.log("functions.php?search_first_name_user="+str);
      xmlhttp.open("GET","functions.php?search_first_name_user="+str,true);
      xmlhttp.send();
}

function showResutsSearchForUserLastName(str) {
    //console.log(str);
    if (str.length==0) {
        document.getElementById("livesearch_last_name").innerHTML="";
        document.getElementById("livesearch_last_name").style.border="0px";
        return;
      }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch_last_name").innerHTML=this.responseText;
          document.getElementById("livesearch_last_name").style.border="1px solid #A5ACB2";
        }
      }
      //console.log("functions.php?search_last_name_user="+str);
      xmlhttp.open("GET","functions.php?search_last_name_user="+str,true);
      xmlhttp.send();
}

function resultHasBeenClickedUser(user_id) {
    //console.log(user_id);
    document.getElementById("livesearch_first_name").innerHTML="";
    document.getElementById("livesearch_first_name").style.border="0px";
    document.getElementById("input_search_first_name").value = "";
    document.getElementById("livesearch_last_name").innerHTML="";
    document.getElementById("livesearch_last_name").style.border="0px";
    document.getElementById("input_search_last_name").value = "";
    var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch_last_name").innerHTML=this.responseText;
          document.getElementById("livesearch_last_name").style.border="1px solid #A5ACB2";
        }
      }
    console.log("functions.php?user_id_info_dump="+user_id);
    xmlhttp.open("GET","functions.php?user_id_info_dump="+user_id,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        var userDetails = JSON.parse(this.responseText);
        console.log(userDetails);
        document.getElementById("modify_user_id").value = userDetails.user_id;
        document.getElementById("modify_email").value = userDetails.email;
        document.getElementById("modify_password").value = userDetails.password;
        document.getElementById("modify_first_name").value = userDetails.first_name;
        document.getElementById("modify_last_name").value = userDetails.last_name;
        document.getElementById("modify_DOB").value = userDetails.DOB;
        document.getElementById("modify_gender").value = userDetails.gender;
        document.getElementById("modify_rank").value = userDetails.rank;
        document.getElementById("modify_active").value = userDetails.active;
        document.getElementById("modify_admin").value = userDetails.admin;
        }
    }
    return;
}

function showResutsSearchForEquipmentByName(str){
    //console.log(str);
    if (str.length==0) {
        document.getElementById("livesearch_equipment_name").innerHTML="";
        document.getElementById("livesearch_equipment_name").style.border="0px";
        return;
      }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch_equipment_name").innerHTML=this.responseText;
          document.getElementById("livesearch_equipment_name").style.border="1px solid #A5ACB2";
        }
      }
      //console.log("functions.php?search_equipment_name="+str);
      xmlhttp.open("GET","functions.php?search_equipment_name="+str,true);
      xmlhttp.send();
}

function showResutsSearchForEquipmentByLocation(str){
    //console.log(str);
    if (str.length==0) {
        document.getElementById("livesearch_equipment_location").innerHTML="";
        document.getElementById("livesearch_equipment_location").style.border="0px";
        return;
      }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch_equipment_location").innerHTML=this.responseText;
          document.getElementById("livesearch_equipment_location").style.border="1px solid #A5ACB2";
        }
      }
      //console.log("functions.php?search_equipment_name="+str);
      xmlhttp.open("GET","functions.php?search_equipment_location="+str,true);
      xmlhttp.send();
}

function resultHasBeenClickedEquipment(equipment_id){
    //console.log(equipment_id);
    document.getElementById("livesearch_equipment_name").innerHTML="";
    document.getElementById("livesearch_equipment_name").style.border="0px";
    document.getElementById("input_search_equipment_name").value = "";
    document.getElementById("livesearch_equipment_location").innerHTML="";
    document.getElementById("livesearch_equipment_location").style.border="0px";
    document.getElementById("input_search_equipment_location").value = "";
    var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch_equipment_location").innerHTML=this.responseText;
          document.getElementById("livesearch_equipment_location").style.border="1px solid #A5ACB2";
        }
      }
    console.log("functions.php?equipment_id_info_dump="+equipment_id);
    xmlhttp.open("GET","functions.php?equipment_id_info_dump="+equipment_id,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        var equipmentDetails = JSON.parse(this.responseText);
        console.log(equipmentDetails);
        document.getElementById("modify_equipment_id").value = equipmentDetails.equipment_id;
        document.getElementById("modify_equipment_name").value = equipmentDetails.name;
        document.getElementById("modify_equipment_location").value = equipmentDetails.location;
        document.getElementById("modify_equipment_description").value = equipmentDetails.description;
        }
    }
    return;
}