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
  document.getElementById("original_aproval").value = final_aproval;
  document.getElementById("add-event-submit").disabled = false;
  document.getElementById("event-input-handeling").innerHTML = "";
  displayCurrentOwnerOfEvent(owner_id);
  event_array = undefined
  event_feedback = undefined
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
  console.log(str);
  if (typeof event_array === 'undefined'){
    event_array = {event_type: 1, event_name: 1, event_start: 1, event_end: 1, final_aproval: 1};
  }
  if (typeof event_feedback === 'undefined'){
    event_feedback = {event_type: "", event_name: "", event_start: "", event_end: "", final_aproval: ""};
  }
  if(document.getElementById('original_aproval').value === "1"){
    event_feedback["final_aproval"] = "<a>this event has already been aproved so cant be edited<a><br><a>click another event to continue editing<a><br>";
    event_array["final_aproval"] = 0;
  }else{
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