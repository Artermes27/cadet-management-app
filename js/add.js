function showResutsSearchForUserFirstName(str) {        if (str.length==0) {
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
      xmlhttp.open("GET","requests/add_get_requests.php?flag=search_first_name_user&prompt="+str,true);
      xmlhttp.send();
}

function showResutsSearchForUserLastName(str) {        if (str.length==0) {
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
      xmlhttp.open("GET","requests/add_get_requests.php?flag=search_last_name_user&prompt="+str,true);
      xmlhttp.send();
}

function ShowResultsSearchForParade(str) {    if (str.length==0) {
      document.getElementById("livesearch_parade_id").innerHTML="";
      document.getElementById("livesearch_parade_id").style.border="0px";
      return;
    }
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch_parade_id").innerHTML=this.responseText;
        document.getElementById("livesearch_parade_id").style.border="1px solid #A5ACB2";
      }
    }
    xmlhttp.open("GET","requests/add_get_requests.php?flag=search_parade_name&prompt="+str,true);
    xmlhttp.send();
}

function ResultHasBeenClickedParade(parade_id, parade_date, parade_name) {    document.getElementById("livesearch_parade_id").innerHTML="";
  document.getElementById("livesearch_parade_id").style.border="0px";
  document.getElementById("parade_id_search_box").value = "";
  document.getElementById("parade_id").value = parade_id;
  document.getElementById("display_current_parade").innerHTML = "current parade: " + parade_name + " " + parade_date;
  REGEXCheckEvent(parade_id, "parade_id");
  return;
}

function resultHasBeenClickedUser(user_id) {    document.getElementById("livesearch_first_name").innerHTML="";
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
    xmlhttp.open("GET","requests/add_get_requests.php?flag=user_id_info_dump&prompt="+user_id,true);
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
        document.getElementById("modify_G4").value = userDetails.G4;
        document.getElementById("modify-user-submit").disabled = false;
        REGEXCheckModifyUser(userDetails.user_id, "user_id");
        }
    }
    return;
}

function showResutsSearchForEquipmentByName(str){        if (str.length==0) {
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
      xmlhttp.open("GET","requests/add_get_requests.php?flag=search_equipment_name&prompt="+str,true);
      xmlhttp.send();
}

function showResutsSearchForEquipmentByLocation(str){        if (str.length==0) {
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
      xmlhttp.open("GET","requests/add_get_requests.php?flag=search_equipment_location&prompt="+str,true);
      xmlhttp.send();
}

function resultHasBeenClickedEquipment(equipment_id){        document.getElementById("livesearch_equipment_name").innerHTML="";
    document.getElementById("livesearch_equipment_name").style.border="0px";
    document.getElementById("input_search_equipment_name").value = "";
    document.getElementById("livesearch_equipment_location").innerHTML="";
    document.getElementById("livesearch_equipment_location").style.border="0px";
    document.getElementById("input_search_equipment_location").value = "";
    document.getElementById("modify-equipment-submit").disabled = false;
    var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch_equipment_location").innerHTML=this.responseText;
          document.getElementById("livesearch_equipment_location").style.border="1px solid #A5ACB2";
        }
      }
    xmlhttp.open("GET","requests/add_get_requests.php?flag=equipment_id_info_dump&prompt="+equipment_id,true);
    xmlhttp.send();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        var equipmentDetails = JSON.parse(this.responseText);
        console.log(equipmentDetails);
        document.getElementById("modify_equipment_id").value = equipmentDetails.equipment_id;
        document.getElementById("modify_equipment_name").value = equipmentDetails.name;
        document.getElementById("modify_equipment_location").value = equipmentDetails.location;
        document.getElementById("modify_equipment_description").value = equipmentDetails.description;
        REGEXCheckModifyEquipment(equipmentDetails.equipmentDetails, "equipment_id")
        document.getElementById("modify-user-submit").disabled = false;
        }
    }
    return;
}

function checkAreAllValuesOne(obj) {
    for (let key in obj) {
      if (obj.hasOwnProperty(key) && obj[key] !== 1) {
          return false;
      }
  }
  return true;
}

function returnFeedbackHTMl(obj) {
    let returnHTML = "";
  for (let key in obj) {
      if (obj.hasOwnProperty(key) && obj[key] !== "") {
          returnHTML = returnHTML + obj[key];
      }
  }
  return returnHTML;
}

function REGEXCheckParade(str, input_to_check){  if (typeof parade_array === 'undefined'){
    parade_array = {date: 0, start: 0, end: 0, parade_name: 0};
  }if (typeof parade_feedback === 'undefined'){
    parade_feedback = {date: "", start: "", end: "", parade_name: ""};
  }if (input_to_check === "date") {
    if (!str.match(/^\d{4}-\d{2}-\d{2}$/)) {      parade_feedback["date"] = "<a>Invalid date format (YYYY-MM-DD)<a><br>";
      parade_array["date"] = 0;
    } else {
      parade_feedback["date"] = "";
      parade_array["date"] = 1;
    }
  } else if (input_to_check === "start") {
    if (!str.match(/^\d{2}:\d{2}$/)) {      parade_feedback["start"] = "<a>Invalid time format (HH:MM)<a><br>";
      parade_array["start"] = 0;
    } else {
      parade_feedback["start"] = "";
      parade_array["start"] = 1;
    }
  } else if (input_to_check === "end") {
    if (!str.match(/^\d{2}:\d{2}$/)) {      parade_feedback["end"] = "<a>Invalid time format (HH:MM)<a><br>";
      parade_array["end"] = 0;
    } else {
      parade_feedback["end"] = "";
      parade_array["end"] = 1;
    }
  } else if (input_to_check === "parade_name") {
    if (str.match("^.{255,}$")){      parade_feedback["parade_name"] = "<a>parade name is to long<a><br>";
      parade_array["parade_name"] = 0;
    } else if(str === ""){      parade_feedback["parade_name"] = "<a>parade name cant empty<a><br>";
      parade_array["parade_name"] = 0;
    } else {
      parade_feedback["parade_name"] = "";
      parade_array["parade_name"] = 1;
    }
  }
  if (checkAreAllValuesOne(parade_array) === true){
        document.getElementById("add-parade-submit").disabled = false;
        document.getElementById("parade-input-handeling").innerHTML = "";
  }else{
        document.getElementById("add-parade-submit").disabled = true;
        document.getElementById("parade-input-handeling").innerHTML = returnFeedbackHTMl(parade_feedback);
  }
}

function REGEXCheckEvent(str, input_to_check){
  if (typeof event_array === 'undefined'){
    event_array = {event_type: 0, event_name: 0, event_start: 0, event_end: 0, parade_id: 0, owner_id: 0};
  }
  if (typeof event_feedback === 'undefined'){
    event_feedback = {event_type: "", event_name: "", event_start: "", event_end: ""};
  }
  if (input_to_check === "event_type") {
    if (str.match("^.{255,}$")){      event_feedback["event_type"] = "<a>event type is to long<a><br>";
      event_array["event_type"] = 0;
    } else if(str === ""){
      event_feedback["event_type"] = "<a>event type cant empty<a><br>";
      event_array["event_type"] = 0;
    } else{
      event_feedback["event_type"] = "";
      event_array["event_type"] = 1;
    }
  } else if (input_to_check === "event_name"){
    if (str.match("^.{255,}$")){      event_feedback["event_name"] = "<a>event name is to long<a><br>";
      event_array["event_name"] = 0;
    } else if(str === ""){      event_feedback["event_name"] = "<a>event name cant empty<a><br>";
      event_array["event_name"] = 0;
    } else{
      event_feedback["event_name"] = "";
      event_array["event_name"] = 1
    }
  }else if (input_to_check === "event_start") {
    if (!str.match(/^\d{2}:\d{2}$/)) {      event_feedback["event_start"] = "<a>Invalid time format (HH:MM)<a><br>";
      event_array["event_start"] = 0;
    } else {
      event_feedback["event_start"] = "";
      event_array["event_start"] = 1;
    }
  } else if (input_to_check === "event_end") {
    if (!str.match(/^\d{2}:\d{2}$/)) {      event_feedback["event_end"] = "<a>Invalid time format (HH:MM)<a><br>";
      event_array["event_end"] = 0;
    } else {
      event_feedback["event_end"] = "";
      event_array["event_end"] = 1;
    }
  } else if (input_to_check === "parade_id") {
    event_array["parade_id"] = 1;
  } else if (input_to_check === "owner_id") {
    event_array["owner_id"] = 1;
  }
  if (checkAreAllValuesOne(event_array) === true){
        document.getElementById("add-event-submit").disabled = false;
        document.getElementById("event-input-handeling").innerHTML = "";
  }else{
        document.getElementById("add-event-submit").disabled = true;
        document.getElementById("event-input-handeling").innerHTML = returnFeedbackHTMl(event_feedback);
  }
}

function REGEXCheckAddUser(str, input_to_check){  if (typeof add_user_array === 'undefined'){
    add_user_array = {email: 0, password: 0, first_name: 0, last_name: 0, DOB: 0, gender: 0, rank: 0};
  }
  if (typeof add_user_feedback === 'undefined'){
    add_user_feedback = {email: "", password: "", first_name: "", last_name: "", DOB: "", gender: "", rank: ""};
  }
  if (input_to_check === "email") {
    if (str.length > 255){      add_user_feedback["email"] = "<a>email is to long<a><br>";
      add_user_array["email"] = 0;
    } else if(str === ""){      add_user_feedback["email"] = "<a>email cant be empty<a><br>";
      add_user_array["email"] = 0;
    } else if (!str.match("^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$")) {      add_user_feedback["email"] = "<a>Invalid email format<a><br>";
      add_user_array["email"] = 0;
    } else {
      add_user_feedback["email"] = "";
      add_user_array["email"] = 1;
    }
  } else if (input_to_check === "password") {
    if (str.length < 8) {
      add_user_feedback["password"] = "<a>Password must be at least 8 characters long<a><br>";
      add_user_array["password"] = 0;
    } else if(str.length > 255){
      add_user_feedback["password"] = "<a>Password is to long long<a><br>";
      add_user_array["password"] = 0;
    }else{
      add_user_feedback["password"] = "";
      add_user_array["password"] = 1;
    }
  } else if (input_to_check === "first_name") {
    if (str.length > 255) {
      add_user_feedback["first_name"] = "<a>First name is too long<a><br>";
      add_user_array["first_name"] = 0;
    } else if (str === "") {
      add_user_feedback["first_name"] = "<a>First name is required<a><br>";
      add_user_array["first_name"] = 0;
    } else {
      add_user_feedback["first_name"] = "";
      add_user_array["first_name"] = 1;
    }
  } else if (input_to_check === "last_name") {
    if (str.length > 255) {
      add_user_feedback["last_name"] = "<a>Last name is too long<a><br>";
      add_user_array["last_name"] = 0;
    } else if (str === "") {
      add_user_feedback["last_name"] = "<a>Last name is required<a><br>";
      add_user_array["last_name"] = 0;
    } else {
      add_user_feedback["last_name"] = "";
      add_user_array["last_name"] = 1;
    }
  } else if (input_to_check === "DOB") {
    if (!str.match(/^\d{4}-\d{2}-\d{2}$/)) {
      add_user_feedback["DOB"] = "<a>Invalid date format (YYYY-MM-DD)<a><br>";
      add_user_array["DOB"] = 0;
    } else {
      add_user_feedback["DOB"] = "";
      add_user_array["DOB"] = 1;
    }
  } else if (input_to_check === "gender") {
    if (str.length > 255) {
      add_user_feedback["gender"] = "<a>gender is too long<a><br>";
      add_user_array["gender"] = 0;
    } else if (str === "") {
      add_user_feedback["gender"] = "<a>gender is required<a><br>";
      add_user_array["gender"] = 0;
    } else {
      add_user_feedback["gender"] = "";
      add_user_array["gender"] = 1;
    }
  } else if (input_to_check === "rank") {
    if (str.length > 255) {
      add_user_feedback["rank"] = "<a>rank is too long<a><br>";
      add_user_array["rank"] = 0;
    } else if (str === "") {
      add_user_feedback["rank"] = "<a>rank is required<a><br>";
      add_user_array["rank"] = 0;
    } else {
      add_user_feedback["rank"] = "";
      add_user_array["rank"] = 1;
    }
  }
  if (checkAreAllValuesOne(add_user_array) === true){
        document.getElementById("add-user-submit").disabled = false;
        document.getElementById("user-input-handeling").innerHTML = "";
  } else {
        document.getElementById("add-user-submit").disabled = true;
        document.getElementById("user-input-handeling").innerHTML = returnFeedbackHTMl(add_user_feedback);
  }
}
 
function REGEXCheckModifyUser(str, input_to_check){  if (typeof modify_user_array === 'undefined'){
    modify_user_array = {modify_email: 1, modify_password: 1, modify_first_name: 1, modify_last_name: 1, modify_DOB: 1, modify_gender: 1, modify_rank: 1, user_id: 0};
  }
  if (typeof modify_user_feedback === 'undefined'){
    modify_user_feedback = {modify_email: "", modify_password: "", modify_first_name: "", modify_last_name: "", modify_DOB: "", modify_gender: "", modify_rank: ""};
  }
  if (input_to_check === "user_id"){
    modify_user_array["user_id"] = 1;
  } else if (input_to_check === "modify_email") {
    if (str.length > 255){      modify_user_feedback["modify_email"] = "<a>email is to long<a><br>";
      modify_user_array["modify_email"] = 0;
    } else if(str === ""){      modify_user_feedback["modify_email"] = "<a>email cant be empty<a><br>";
      modify_user_array["modify_email"] = 0;
    } else if (!str.match("^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$")) {      modify_user_feedback["modify_email"] = "<a>Invalid email format<a><br>";
      modify_user_array["modify_email"] = 0;
    } else {
      modify_user_feedback["modify_email"] = "";
      modify_user_array["modify_email"] = 1;
    }
  } else if (input_to_check === "modify_password") {
    if (str.length < 8 && str.length != 0) {
      modify_user_feedback["modify_password"] = "<a>Password must be at least 8 characters long or empty<a><br>";
      modify_user_array["modify_password"] = 0;
    } else if(str.length > 255){
      modify_user_feedback["modify_password"] = "<a>Password is to long long<a><br>";
      modify_user_array["modify_password"] = 0;
    }else{
      modify_user_feedback["modify_password"] = "";
      modify_user_array["modify_password"] = 1;
    }
  } else if (input_to_check === "modify_first_name") {
    if (str.length > 255) {
      modify_user_feedback["modify_first_name"] = "<a>First name is too long<a><br>";
      modify_user_array["modify_first_name"] = 0;
    } else if (str === "") {
      modify_user_feedback["modify_first_name"] = "<a>First name is required<a><br>";
      modify_user_array["modify_first_name"] = 0;
    } else {
      modify_user_feedback["modify_first_name"] = "";
      modify_user_array["modify_first_name"] = 1;
    }
  } else if (input_to_check === "modify_last_name") {
    if (str.length > 255) {
      modify_user_feedback["modify_last_name"] = "<a>Last name is too long<a><br>";
      modify_user_array["modify_last_name"] = 0;
    } else if (str === "") {
      modify_user_feedback["modify_last_name"] = "<a>Last name is required<a><br>";
      modify_user_array["modify_last_name"] = 0;
    } else {
      modify_user_feedback["modify_last_name"] = "";
      modify_user_array["modify_last_name"] = 1;
    }
  } else if (input_to_check === "modify_DOB") {
    if (!str.match(/^\d{4}-\d{2}-\d{2}$/)) {
      modify_user_feedback["modify_DOB"] = "<a>Invalid date format (YYYY-MM-DD)<a><br>";
      modify_user_array["modify_DOB"] = 0;
    } else {
      modify_user_feedback["modify_DOB"] = "";
      modify_user_array["modify_DOB"] = 1;
    }
  } else if (input_to_check === "modify_gender") {
    if (str.length > 255) {
      modify_user_feedback["modify_gender"] = "<a>gender is too long<a><br>";
      modify_user_array["modify_gender"] = 0;
    } else if (str === "") {
      modify_user_feedback["modify_gender"] = "<a>gender is required<a><br>";
      modify_user_array["modify_gender"] = 0;
    } else {
      modify_user_feedback["modify_gender"] = "";
      modify_user_array["modify_gender"] = 1;
    }
  } else if (input_to_check === "modify_rank") {
    if (str.length > 255) {
      modify_user_feedback["modify_rank"] = "<a>rank is too long<a><br>";
      modify_user_array["modify_rank"] = 0;
    } else if (str === "") {
      modify_user_feedback["modify_rank"] = "<a>rank is required<a><br>";
      modify_user_array["modify_rank"] = 0;
    } else {
      modify_user_feedback["modify_rank"] = "";
      modify_user_array["modify_rank"] = 1;
    }
  }
  console.log(modify_user_array);
  if (checkAreAllValuesOne(modify_user_array) === true){
        document.getElementById("modify-user-submit").disabled = false;
        document.getElementById("modify-user-input-handeling").innerHTML = "";
  } else {
        document.getElementById("modify-user-submit").disabled = true;
        document.getElementById("modify-user-input-handeling").innerHTML = returnFeedbackHTMl(modify_user_feedback);
  }
}

function REGEXCheckAddEquipment(str, input_to_check){  if (typeof add_equipment_array === 'undefined'){
    add_equipment_array = {name: 0, description: 0, location: 0};
  }
  if (typeof add_equipment_feedback === 'undefined'){
    add_equipment_feedback = {name: "", description: "", location: ""};
  }
  if (input_to_check === "name") {
    if (str.length > 255){      add_equipment_feedback["name"] = "<a>Name is too long<a><br>";
      add_equipment_array["name"] = 0;
    } else if(str === ""){      add_equipment_feedback["name"] = "<a>Name can't be empty<a><br>";
      add_equipment_array["name"] = 0;
    } else {
      add_equipment_feedback["name"] = "";
      add_equipment_array["name"] = 1;
    }
  } else if (input_to_check === "description") {
    if (str.length > 65535) {
      add_equipment_feedback["description"] = "<a>Description is too long<a><br>";
      add_equipment_array["description"] = 0;
    } else {
      add_equipment_feedback["description"] = "";
      add_equipment_array["description"] = 1;
    }
  } else if (input_to_check === "location") {
    if (str.length > 65535) {
      add_equipment_feedback["location"] = "<a>Location is too long<a><br>";
      add_equipment_array["location"] = 0;
    } else if (str === "") {
      add_equipment_feedback["location"] = "<a>Location can't be empty<a><br>";
      add_equipment_array["location"] = 0;
    } else {
      add_equipment_feedback["location"] = "";
      add_equipment_array["location"] = 1;
    }
  }
  if (checkAreAllValuesOne(add_equipment_array) === true){
        document.getElementById("add-equipment-submit").disabled = false;
        document.getElementById("equipment-input-handeling").innerHTML = "";
  } else {
        document.getElementById("add-equipment-submit").disabled = true;
        document.getElementById("equipment-input-handeling").innerHTML = returnFeedbackHTMl(add_equipment_feedback);
  }
}

function REGEXCheckModifyEquipment(str, input_to_check){  if (typeof modify_equipment_array === 'undefined'){
    modify_equipment_array = {modify_equipment_name: 1, modify_equipment_description: 1, modify_equipment_location: 1, equipment_id: 0};
  }
  if (typeof modify_equipment_feedback === 'undefined'){
    modify_equipment_feedback = {modify_equipment_name: "", modify_equipment_description: "", modify_equipment_location: ""};
  }
  if (input_to_check === "equipment_id"){
    modify_equipment_array["equipment_id"] = 1;
  }
  if (input_to_check === "modify_equipment_name") {
    if (str.length > 255){      
      modify_equipment_feedback["modify_equipment_name"] = "<a>Name is too long</a><br>";
      modify_equipment_array["modify_equipment_name"] = 0;
    } else if(str === ""){      
      modify_equipment_feedback["modify_equipment_name"] = "<a>Name can't be empty</a><br>";
      modify_equipment_array["modify_equipment_name"] = 0;
    } else {
      modify_equipment_feedback["modify_equipment_name"] = "";
      modify_equipment_array["modify_equipment_name"] = 1;
    }
  } else if (input_to_check === "modify_equipment_description") {
    if (str.length > 65535) {
      modify_equipment_feedback["modify_equipment_description"] = "<a>Description is too long</a><br>";
      modify_equipment_array["modify_equipment_description"] = 0;
    } else if(str === "") {
      modify_equipment_feedback["modify_equipment_description"] = "<a>description can't be empty</a><br>"
      modify_equipment_array["modify_equipment_description"] = 0;
    } else {
      modify_equipment_feedback["modify_equipment_description"] = "";
      modify_equipment_array["modify_equipment_description"] = 1;
    }
  } else if (input_to_check === "modify_equipment_location") {
    if (str.length > 65535) {
      modify_equipment_feedback["modify_equipment_location"] = "<a>Location is too long</a><br>";
      modify_equipment_array["modify_equipment_location"] = 0;
    } else if (str === "") {
      modify_equipment_feedback["modify_equipment_location"] = "<a>Location can't be empty</a><br>";
      modify_equipment_array["modify_equipment_location"] = 0;
    } else {
      modify_equipment_feedback["modify_equipment_location"] = "";
      modify_equipment_array["modify_equipment_location"] = 1;
    }
  }
  if (checkAreAllValuesOne(modify_equipment_array) === true){
        document.getElementById("modify-equipment-submit").disabled = false;
        document.getElementById("modify-equipment-input-handeling").innerHTML = "";
  } else {
        document.getElementById("modify-equipment-submit").disabled = true;
        document.getElementById("modify-equipment-input-handeling").innerHTML = returnFeedbackHTMl(modify_equipment_feedback);
  }
}