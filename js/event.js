function showResultAddCadet(str, search_for, event_id) {
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
  
function showResultDeleteCadet(str, search_for, event_id) {
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

function showResultSearchOtherCadet(str, event_id) {
  //console.log(str);
  if (str.length==0) {
    document.getElementById("livesearch_other_cadet").innerHTML="";
    document.getElementById("livesearch_other_cadet").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      console.log(this.responseText);
      document.getElementById("livesearch_other_cadet").innerHTML=this.responseText;
      document.getElementById("livesearch_other_cadet").style.border="1px solid #A5ACB2";
    }
  }
  console.log("functions.php?search_first_name_other_cadet="+str+"&event_id=" + event_id);
  xmlhttp.open("GET","functions.php?search_first_name_other_cadet="+str+"&event_id=" + event_id,true);
  xmlhttp.send();

}
  
function resultHasBeenClickedAdd(user_id, event_id) {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.open("POST", "functions.php?add_user_id=" + user_id + "&event_id=" + event_id + "")
  xmlhttp.send();
  document.getElementById("livesearch").innerHTML="";
  document.getElementById("livesearch").style.border="0px";
  document.getElementById("search_first_name").value = "";
  setTimeout(function() {
    window.location.reload();
  }, 200);
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
  setTimeout(function() {
    window.location.reload();
  }, 200);
  return;
}

function showResultAddEquipment(str, event_id) {
  if (str.length==0) {
    document.getElementById("livesearch_equipment_add").innerHTML="";
    document.getElementById("livesearch_equipment_add").style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      console.log(this.responseText);
      document.getElementById("livesearch_equipment_add").innerHTML=this.responseText;
      document.getElementById("livesearch_equipment_add").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","functions.php?search_equipment_add="+str+"&event_id=" + event_id,true);
  xmlhttp.send();
}

function showResultDeleteEquipment(str, event_id){
  if (str.length == 0) {
    document.getElementById("livesearch_delete_equipment").innerHTML = "";
    document.getElementById("livesearch_delete_equipment").style.border = "0px";
    return;
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("livesearch_delete_equipment").innerHTML = this.responseText;
      document.getElementById("livesearch_delete_equipment").style.border = "1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET", "functions.php?search_equipment_delete=" + str + "&event_id=" + event_id, true);
  xmlhttp.send();
}

function showResultSearchOtherEquipment(str, event_id){
  if (str.length == 0) {
    document.getElementById("livesearch_other_equipment").innerHTML = "";
    document.getElementById("livesearch_other_equipment").style.border = "0px";
    return;
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("livesearch_other_equipment").innerHTML = this.responseText;
      document.getElementById("livesearch_other_equipment").style.border = "1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET", "functions.php?search_equipment_other=" + str + "&event_id=" + event_id, true);
  xmlhttp.send();
}

function resultHasBeenClickedAddEquipment(equipment_id, event_id){
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "functions.php?add_equipment_id=" + equipment_id + "&event_id=" + event_id);
  xmlhttp.send();
  document.getElementById("livesearch_equipment_add").innerHTML = "";
  document.getElementById("livesearch_equipment_add").style.border = "0px";
  document.getElementById("search_equipment_name_add").value = "";
  setTimeout(function() {
    window.location.reload();
  }, 200);
  return;

}

function resultHasBeenClickedDeleteEquipment(equipment_id, event_id){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "functions.php?remove_equipment_id=" + equipment_id + "&event_id=" + event_id);
  xmlhttp.send();
  document.getElementById("livesearch_delete_equipment").innerHTML = "";
  document.getElementById("livesearch_delete_equipment").style.border = "0px";
  document.getElementById("search_equipment_name_delete").value = "";
  setTimeout(function() {
    window.location.reload();
  }, 200);
  return;
}

function setStateOfEventApproval(state){
  //method to test if element final_aproval exists and act acordingly
  console.log(document.getElementById("final_aproval"));
  if(document.getElementById("final_aproval") !== "null"){
    document.getElementById("final_aproval").value = state;
  }
}

function setStateOfEquipmentRequest(state, equipment_id){
  document.getElementsByid(equipment_id).value = state;
}

function checkAreAllValuesOne(obj) {
  for (let key in obj) {
      if (obj.hasOwnProperty(key) && obj[key] !== 1) {
          return false;
      }
  }
  return true;
}

function returnFeedbackHTMl(obj){
  returnHTML = ""
  for (let key in obj) {
    if (obj.hasOwnProperty(key) && obj[key] !== "") {
      returnHTML = returnHTML + obj[key];
    }
  }
  return returnHTML;
}

function REGEXCheckEvent(str, input_to_check, admin){
  console.log(str);
  if (typeof event_array === 'undefined'){
    event_array = {event_type: 1, event_name: 1, event_start: 1, event_end: 1, final_aproval: 1};
  }
  if (typeof event_feedback === 'undefined'){
    event_feedback = {event_type: "", event_name: "", event_start: "", event_end: "", final_aproval: ""};
  }
  if (document.getElementById("original_aproval").value === "1") {
    event_feedback["final_aproval"] = "<a>this event has already been approved so can't be edited</a>";
    event_array["final_aproval"] = 0;
  }else {
    if (input_to_check === "event_type"){
      if (str.match("^.{255,}$")){//checking the input is less than 255 in length
        event_feedback["event_type"] = "<a>event type is to long<a><br>";
        event_array["event_type"] = 0;
      } else if(str === ""){
        event_feedback["event_type"] = "<a>event type cant empty<a><br>";
        event_array["event_type"] = 0;
      } else{
        event_feedback["event_type"] = "";
        event_array["event_type"] = 1;
      }
    } else if (input_to_check === "event_name"){
      if (str.match("^.{255,}$")){//checking the input is less than 255 in length
        event_feedback["event_name"] = "<a>event name is to long<a><br>";
        event_array["event_name"] = 0;
      } else if(str === ""){//checking the input isnt empty
        event_feedback["event_name"] = "<a>event name cant empty<a><br>";
        event_array["event_name"] = 0;
      } else{
        event_feedback["event_name"] = "";
        event_array["event_name"] = 1
      }
    } else if (input_to_check === "event_start"){
      if (str === ""){
        event_feedback["event_start"] = "<a>event start can't be empty<a><br>";
        event_array["event_start"] = 0;
      } else if (!str.match(/^\d{2}:\d{2}$/)) { // checking the input fits the general form of a time input (HH:MM)
        event_feedback["event_start"] = "<a>event start must be in the format HH:MM<a><br>";
        event_array["event_start"] = 0;
      } else {
        event_feedback["event_start"] = "";
        event_array["event_start"] = 1;
      }
    } else if (input_to_check === "event_end"){
      if (str === ""){
        event_feedback["event_end"] = "<a>event end can't be empty<a><br>";
        event_array["event_end"] = 0;
      } else if (!str.match(/^\d{2}:\d{2}$/)) { // checking the input fits the general form of a time input (HH:MM)
        event_feedback["event_end"] = "<a>event end must be in the format HH:MM<a><br>";
        event_array["event_end"] = 0;
      } else {
        event_feedback["event_end"] = "";
        event_array["event_end"] = 1;
      }
    } else if (input_to_check === "final_aproval"){
      console.log(str);
      if (str === "1" && admin === "0"){
        event_feedback["final_aproval"] = "<a>only the admin can aprove an event<a><br>";
        event_array["final_aproval"] = 0;
      } else {
        event_feedback["final_aproval"] = "";
        event_array["final_aproval"] = 1;
      }
    }
  }
  if (checkAreAllValuesOne(event_array) === true){
    //no error flags so activate the submit button
    document.getElementById("add-event-submit").disabled = false;
    //emptying the input handeling notification div
    document.getElementById("event-input-handeling").innerHTML = "";
  }else{
    //error flags so deactivate the submit button
    document.getElementById("add-event-submit").disabled = true;
    //populating the feedback box
    document.getElementById("event-input-handeling").innerHTML = returnFeedbackHTMl(event_feedback);
  }
}

function REGEXCheckEquipment(str, original_state){
  return null
}