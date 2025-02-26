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
      xmlhttp.open("GET","requests/event_get_requests.php?search_first_name="+str+"&event_id=" + event_id,true);
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
    xmlhttp.open("GET","requests/event_get_requests.php?search_first_name_delete="+str+"&event_id=" + event_id,true);
    console.log("requests/event_get_requests.php?search_first_name_delete="+str+"&event_id=" + event_id);
    xmlhttp.send();
  }
}

function showResultSearchOtherCadet(str, event_id) {
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
  console.log("requests/event_get_requests.php?search_first_name_other_cadet="+str+"&event_id=" + event_id);
  xmlhttp.open("GET","requests/event_get_requests.php?search_first_name_other_cadet="+str+"&event_id=" + event_id,true);
  xmlhttp.send();

}
  
function resultHasBeenClickedAdd(user_id, event_id) {
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.open("POST", "requests/event_get_requests.php?add_user_id=" + user_id + "&event_id=" + event_id + "")
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
    var xmlhttp=new XMLHttpRequest();
  xmlhttp.open("POST", "requests/event_get_requests.php?remove_user_id=" + user_id + "&event_id=" + event_id + "")
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
  xmlhttp.open("GET","requests/event_get_requests.php?search_equipment_add="+str+"&event_id=" + event_id,true);
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
  xmlhttp.open("GET", "requests/event_get_requests.php?search_equipment_delete=" + str + "&event_id=" + event_id, true);
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
  xmlhttp.open("GET", "requests/event_get_requests.php?search_equipment_other=" + str + "&event_id=" + event_id, true);
  xmlhttp.send();
}

function resultHasBeenClickedAddEquipment(equipment_id, event_id){
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "requests/event_get_requests.php?add_equipment_id=" + equipment_id + "&event_id=" + event_id);
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
  xmlhttp.open("POST", "requests/event_get_requests.php?remove_equipment_id=" + equipment_id + "&event_id=" + event_id);
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
    if(document.getElementById("final_aproval") !== "null"){
    document.getElementById("final_aproval").value = state;
  }
}

function setStateOfEquipmentRequest(state, equipment_id){
  if(document.getElementById(equipment_id) !== "null"){
    document.getElementById(equipment_id).value = state;
  }
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
      if (str.match("^.{255,}$")){        event_feedback["event_type"] = "<a>event type is to long<a><br>";
        event_array["event_type"] = 0;
      } else if(str === ""){
        event_feedback["event_type"] = "<a>event type cant empty<a><br>";
        event_array["event_type"] = 0;
      } else{
        event_feedback["event_type"] = "";
        event_array["event_type"] = 1;
      }
    } else if (input_to_check === "event_name"){
      if (str.match("^.{255,}$")){        event_feedback["event_name"] = "<a>event name is to long<a><br>";
        event_array["event_name"] = 0;
      } else if(str === ""){        event_feedback["event_name"] = "<a>event name cant empty<a><br>";
        event_array["event_name"] = 0;
      } else{
        event_feedback["event_name"] = "";
        event_array["event_name"] = 1
      }
    } else if (input_to_check === "event_start"){
      if (str === ""){
        event_feedback["event_start"] = "<a>event start can't be empty<a><br>";
        event_array["event_start"] = 0;
      } else if (!str.match(/^\d{2}:\d{2}$/)) {         event_feedback["event_start"] = "<a>event start must be in the format HH:MM<a><br>";
        event_array["event_start"] = 0;
      } else {
        event_feedback["event_start"] = "";
        event_array["event_start"] = 1;
      }
    } else if (input_to_check === "event_end"){
      if (str === ""){
        event_feedback["event_end"] = "<a>event end can't be empty<a><br>";
        event_array["event_end"] = 0;
      } else if (!str.match(/^\d{2}:\d{2}$/)) {         event_feedback["event_end"] = "<a>event end must be in the format HH:MM<a><br>";
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
        document.getElementById("add-event-submit").disabled = false;
        document.getElementById("event-input-handeling").innerHTML = "";
  }else{
        document.getElementById("add-event-submit").disabled = true;
        document.getElementById("event-input-handeling").innerHTML = returnFeedbackHTMl(event_feedback);
  }
}

function REGEXCheckRegister(str, user_id){
  if(str === ""){
    register_array[user_id] = 0;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","requests/add_get_requests.php?user_id_info_dump="+user_id,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      let userDetails = JSON.parse(this.responseText);
      register_feedback[user_id] = "<a>" + userDetails.rank + " " + userDetails.first_name + " " + userDetails.last_name + " cant have an empty registar box<a><br>";
      }
    }
  }else if(str !== "1" && str !== "0"){
    register_array[user_id] = 0;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET","requests/add_get_requests.php?user_id_info_dump="+user_id,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      let userDetails = JSON.parse(this.responseText);
      register_feedback[user_id] = "<a>" + userDetails.rank + " " + userDetails.first_name + " " + userDetails.last_name + " must have atendance of 1 or 0<a><br>";
      }
    }
  }else{
    register_array[user_id] = 1;
    register_feedback[user_id] = "";
  }
  if(checkAreAllValuesOne(register_array) === true){
    document.getElementById("register-submit").disabled = false;
    document.getElementById("register-input-handeling").innerHTML = "";
  }else{
    document.getElementById("register-submit").disabled = true;
    document.getElementById("register-input-handeling").innerHTML = returnFeedbackHTMl(register_feedback);
  }
}

function REGEXCheckEquipment(str, equipment_id, originial_aproval, G4){
  console.log(str);
  console.log(originial_aproval);
  if (G4 === "1"){
    if(str === "0" && originial_aproval !== "0"){
      equipment_array[equipment_id] = 0;
      equipment_feedback[equipment_id] = "<a>can't reverse an aproval decision<a><br>";
    } else if(str === "1" && originial_aproval === "2"){
      equipment_array[equipment_id] = 0;
      equipment_feedback[equipment_id] = "<a>can't aprove an already denied request<a><br>";
    } else if(str === "2" && originial_aproval === "1"){
      equipment_array[equipment_id] = 0;
      equipment_feedback[equipment_id] = "<a>can't deny an already aproved request<a><br>";
    }else{
      equipment_array[equipment_id] = 1;
      equipment_feedback[equipment_id] = "";
    }
  }else{
    if(str !== originial_aproval){
      equipment_array[equipment_id] = 0;
      equipment_feedback[equipment_id] = "<a>can't change an aproval decision you are not G4<a><br>";
    } else{
      equipment_array[equipment_id] = 1;
      equipment_feedback[equipment_id] = "";
    }
  }
      if(checkAreAllValuesOne(equipment_array) === true){
    document.getElementById("equipment-submit").disabled = false;
    document.getElementById("equipment-input-handeling").innerHTML = "";
  }else{
    document.getElementById("equipment-submit").disabled = true;
    document.getElementById("equipment-input-handeling").innerHTML = returnFeedbackHTMl(equipment_feedback);
  }
}