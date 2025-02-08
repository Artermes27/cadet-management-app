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

function REGEXCheckEvent(str, input_to_check){
  if (typeof event_array === 'undefined'){
    event_array = {event_type: 0, event_name: 0};
  }
  if (typeof event_feedback === 'undefined'){
    event_feedback = {event_type: "", event_name: ""};
  }
  if (input_to_check === "event_type") {
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