<?php 
session_start();

	include_once("includes/connection.php");
	include("includes/functions.php");

  $user_data = check_login($con);

  //function to get the dates the skip forwards/backwards buttons should redirect the user to
  function date_skip_method($con, $current_date, $skip){
    if($skip == "-1"){
      $query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date DESC limit 1;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if (count($dates) == 0){
        return "null";
      } else {
      return $dates[0]["date"];
      }
    }if($skip == "+1"){
      $query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 1;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if (count($dates) == 0){
        return "null";
      } else {
      return $dates[0]["date"];
      }
    }if($skip == "-5"){
      $query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date DESC limit 5;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if(mysqli_num_rows($result) == 0){
        return "null";
      } else {
        if(count($dates) >= 5){
          return $dates[4]["date"];
        }else{
          return $dates[count($dates) - 1]["date"];
        }
      }
    }if($skip == "+5"){
      $query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 5;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if(mysqli_num_rows($result) == 0){
        return "null";
      } else {
        return $dates[count($dates)-1]["date"];
      }
    }if($skip == "-4"){
      $query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date DESC limit 4;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if(mysqli_num_rows($result) == 0){
        return "null";
      } else {
        if(count($dates) >= 4){
          return $dates[3]["date"];
        }else{
          return $dates[count($dates) - 1]["date"];
        }
      }
    }if($skip == "+4"){
      $query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 4;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if(mysqli_num_rows($result) == 0){
        return "null";
      } else {
        return $dates[count($dates)-1]["date"];
      }
    }
  }

  //function to return an array of 5 dates and the final valid date in the array. 
  function get_parade_date_range($con, $current_date, $admin)	{
    $query = "SELECT date FROM parades WHERE date >= '$current_date' ORDER BY date ASC limit 5;";
    $result = mysqli_query($con, $query);
    $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (count($dates) < 5)  {//if their are less than 5 dates then the array is filled with an error message
      $end_date = $dates[count($dates)-1]["date"];
      while(count($dates) < 5) {
        $dates[] = ["date" => "null"];
      }
    } else {//the admin will have one less date displayed since they have the admin edit panel displayed
      if($admin == 1){        
        $end_date = $dates[count($dates)-2]["date"];
      }else{
        $end_date = $dates[count($dates)-1]["date"];
      }
    }
    return [$dates, $end_date];
  }

  function html_for_displaying_an_event($con, $event_id, $event_display_type, $user_id){
    $query = "SELECT * FROM events WHERE events.event_id = " . $event_id . ";";
    $result = mysqli_query($con, $query);
    $event = mysqli_fetch_assoc($result);
    //desciding the colour of the event based off its aproval status
    if($event["final_aproval"] == 0){
      $style_class = "event_not_aproved";
    }elseif($event["final_aproval"] == 1){
      $style_class = "event_aproved";
    }elseif($event["final_aproval"] == 2){
      $style_class = "event_aproval_requested";
    }
    if($event_display_type == "admin"){//if the user is an admin then display the event owners full name and the edit on admin panel edit button
      $query = "SELECT `first_name`, `last_name`, `rank` FROM users WHERE user_id = " . $event["owner"] . ";";
      $result = mysqli_query($con, $query);
      $owner = mysqli_fetch_assoc($result);
      $return_html = "<div class=\"" . $style_class . "\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a>" . $event["event_name"] . "</a><br>\n<a>" . $owner["rank"] . " " . $owner["first_name"] . " " . $owner["last_name"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a><br>\n<button onclick=\"populateAdminEditEventForm('" . $event["parade_id"] . "', '" . $event["event_id"] . "', '" . $event["event_type"] . "', '" . $event["event_name"] . "', '" .  $event["event_start"] . "', '" . $event["event_end"] . "', '" . $event["owner"] . "', '" .  $event["final_aproval"] . "')\">click for admin panel edit</button></div>\n";
    }elseif($event_display_type == "G4"){//if in future events were to be displayed differently they can be easilly changed here
      $return_html = "<div class=\"" . $style_class . "\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a></div>\n";
    }elseif($event_display_type == "standard"){
      if ($event["owner"] == $user_id){
        $return_html = "<div class=\"" . $style_class . "\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a></div>\n";
      }elseif($event["duty"] == $user_id){
        $return_html = "<div class=\"" . $style_class . "\"><a>duty event</a><br><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a></div>\n";
      }else{
        $return_html = "<div class=\"event\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a>" . $event["event_name"] . "</a></div>\n";
      }
    }
    return $return_html;
  }

  function html_for_equipment_request_log($equipment_reuqest_log){//function to display and equipment request log given an array of equipment requests
    $log = "<div class=\"event\">\n";
    $log .= "<h3 style=\"text-decoration: underline;\">log of aproved equipment requests</h3>";
    $log .= "<table>";
    $log .= "<tr>\n";
    $log .= "<th>name</th>";
    $log .= "<th>location</th>";
    $log .= "<th>start time</th>";
    $log .= "<th>finish time</th>";
    $log .= "<th>lesson name</th>";
    $log .= "</tr>";
    foreach ($equipment_reuqest_log as $request) { 
      $log .= "<tr>";
      $log .= "<td>" . $request["name"] . "</td>";
      $log .= "<td>" . $request["location"] . "</td>";
      $log .= "<td>" . $request["event_start"] . "</td>";
      $log .= "<td>" . $request["event_end"] . "</td>";
      $log .= "<td>" . $request["event_name"] . "</td>";
      $log .= "</tr>";
    }
    $log .= "</table>";
    $log .= "</div>\n";
    return $log;
  }
  
  //fuction to generate all the html for a parade with a known date
  function html_for_parade_on_callendar($con, $parade_date, $user_data){
    //selecting the parade_id
    $query = "SELECT parade_id, parade_name FROM parades WHERE date = '$parade_date';";
    $result = mysqli_query($con, $query);
    $parade = mysqli_fetch_assoc($result);
    //setting the display type of the user i.e. should they see an equipment request log or should they have the admin panel edit button
    if($user_data["admin"] == 1 or $user_data["G4"] == 1){//if the user is admin or G4 then display all events for the parade
      $query = "SELECT events.* FROM events WHERE parade_id =" . $parade["parade_id"] . " ORDER BY events.event_start;";
      $event_display_type = "admin";
    }elseif($user_data["G4"] == 1){
      $query = "SELECT events.* FROM events WHERE parade_id =" . $parade["parade_id"] . " ORDER BY events.event_start;";
      $event_display_type = "G4";
    }else{//if the user is not admin or G4 then they should only see events they are related to
      $query = "SELECT DISTINCT events.* FROM events LEFT JOIN user_event ON events.event_id = user_event.event_id WHERE (parade_id = " . $parade["parade_id"] . " AND user_event.user_id = " . $user_data["user_id"] . ") OR ((events.duty = " . $user_data["user_id"] . " OR events.owner = " . $user_data["user_id"] . ") AND parade_id = " . $parade["parade_id"] . ") ORDER BY events.event_start;";
      $event_display_type = "standard";
    }
    $result = mysqli_query($con, $query);
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $parade_html = "<div class=\"event\"><h2>" . $parade_date . "</h2><h2>" . $parade["parade_name"] . "</h2>";
    $parade_html .= "</div>\n";
    $event_count = 0;
    if(count($events) == 0){
      $parade_html .= "<div class=\"event\"><a>you have no events on this parade night</a></div>";
    }else{
      if ($user_data["G4"] == 1){//if the user is G4 then an equipment request log must be produced
        while($event_count < count($events)){//loop to produce the html for each event and append the equipment requests to the array of requests
          $parade_html .= html_for_displaying_an_event($con, $events[$event_count]["event_id"], $event_display_type, $user_data["user_id"]);
          //query to selct approved equipment requests for an event which are appended to the array equipment_request_log
          $query = "SELECT equipment.name, equipment.location, events.event_name, events.event_start, events.event_end, users.rank, users.first_name, users.last_name FROM equipment, events, users, equipment_requests WHERE events.event_id = " . $events[$event_count]["event_id"] . " AND users.user_id = events.owner AND equipment_requests.event_id = events.event_id AND equipment.equipment_id = equipment_requests.equipment_id AND equipment_requests.aproved = 1";
          $result = mysqli_query($con, $query);
          while($request = mysqli_fetch_assoc($result)){//appending to the equipment request log
            $equipment_reuqest_log[] = $request;
          }
          $event_count = $event_count + 1;
        }
        if (count($equipment_reuqest_log) > 0){//outputing an equipment request log if their are requests
          $parade_html .= html_for_equipment_request_log($equipment_reuqest_log);
        }
      }else{
        while($event_count < count($events)){//loop to produce the html for each event
          $parade_html .= html_for_displaying_an_event($con, $events[$event_count]["event_id"], $event_display_type, $user_data["user_id"]);
          $event_count = $event_count + 1;
        }
      }
    }
  return $parade_html;
  }

  function html_for_admin_page_on_callandar(){//function to output the html needed for the admin panel edit form 
    $html = "<div class=\"event\">";
    $html .= "<h2>admin panel</h2>\n";
    $html .= "<link rel=\"stylesheet\" href=\"css/event-owner-form-style.css\">\n";
    $html .= "<form class=\"modify_lesson_details\" action=\"requests/event_details_requests.php\" method=\"POST\">\n";
    $html .= "<input hidden value=\"modify_event_details\" type=\"text\" name=\"flag\" id=\"flag\">\n";
    $html .= "<input hidden value=\"1\" type=\"text\" name=\"calendar_flag\" id=\"calendar_flag\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"parade_id\" id=\"parade_id\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"event_id\" id=\"event_id\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"owner_id\" id=\"owner_id\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"original_aproval\" id=\"original_aproval\">\n";
    $html .= "<label>event type</label>\n";
    $html .= "<input type=\"text\" name=\"event_type\" id=\"event_type\" onkeyup=\"REGEXCheckEvent(this.value, 'event_type')\">\n";
    $html .= "<label>event name</label>\n";
    $html .= "<input type=\"text\" name=\"event_name\" id=\"event_name\" onkeyup=\"REGEXCheckEvent(this.value, 'event_name')\">\n";
    $html .= "<label>event start</label>\n";
    $html .= "<input type=\"time\" name=\"event_start\" id=\"event_start\" onkeyup=\"REGEXCheckEvent(this.value, 'event_start')\">\n";
    $html .= "<label>event end</label>\n";
    $html .= "<input type=\"time\" name=\"event_end\" id=\"event_end\" onkeyup=\"REGEXCheckEvent(this.value, 'event_end')\">\n";
    $html .= "<label>approved</label>\n";
    $html .= "<select id=\"final_aproval\" name=\"final_aproval\" onclick=\"REGEXCheckEvent(this.value, 'final_aproval')\">\n";
    $html .= "<option value=\"0\">not-aproved</option>\n";
    $html .= "<option value=\"1\">aproved</option>\n";
    $html .= "<option value=\"2\">aproval requested</option>\n";
    $html .= "</select>\n";
    $html .= "<label>event owner</label>\n";
    $html .= "<input type=\"text\" name=\"event_owner_search_box\" id=\"event_owner_search_box\" onkeyup=\"showResutsSearchForOwner(this.value)\">\n";
    $html .= "<div class=\"input_handeling\" id=\"livesearch_owner\"></div>\n";
    $html .= "<div class=\"input_handeling\" id=\"event-input-handeling\"></div>\n";
    $html .= "<div class=\"input_handeling\" id=\"display_current_owner\"></div>\n";
    $html .= "<button class=\"input_handeling\" id=\"add-event-submit\" disabled>submit</button>\n";
    $html .= "</form>\n";
    $html .= "<form class=\"modify_lesson_details\" action=\"requests/event_details_requests.php\" method=\"POST\">\n";
    $html .= "<input hidden value=\"delete_event\" type=\"text\" name=\"flag\" id=\"flag\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"delete_parade_id\" id=\"delete_parade_id\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"delete_event_id\" id=\"delete_event_id\">\n";
    $html .= "<button class=\"input_handeling\" id=\"delete-event-submit\" style=\"width: 100%;\" disabled>delete event</button>\n";
    $html .= "</form>\n";
    $html .= "</div>\n";
    return $html;
  }

  include("requests/get_request_scanning.php");
  //retreving the starting date for the calendar page
  if(isset($_GET["current_date"]) and get_request("current_date") != "null") {
    $current_date = get_request("current_date");
  } else {//no starting date set so use todays date
    $current_date = str_replace("/", "-", date("Y/m/d"));
  }
  //getting the parade date range and the end date storing in variable temp because functions can only output one object
  $temp = get_parade_date_range($con, $current_date, $user_data["admin"]);
  $parade_dates = $temp[0];
  $end_date = $temp[1];
  $temp = null;
  $min_add = date_skip_method($con, $current_date, "+1");
  $min_subtract = date_skip_method($con, $current_date, "-1");
  if($user_data["admin"] == 0) {//if the user doesent have the admin edit panel then they use all 5 slots on the calendar page so they skip forward/back by 5 parades
    $max_add = date_skip_method($con, $current_date, "+5");
    $max_subtract = date_skip_method($con, $current_date, "-5");
  } else {//admins have the admin panel edit so they only skip by 4 parades
    $max_add = date_skip_method($con, $current_date, "+4");
    $max_subtract = date_skip_method($con, $current_date, "-4");
  }
  $output_count = 0;
?>

<!DOCTYPE html>
<html>
<head>
  <title>my Dashbord</title>
  <link rel="stylesheet" href="css/calendar-style.css">
  <link rel="stylesheet" href="css/event-display-block-style.css">
  <script src="js/calendar.js"></script>
  <script src="js/event_owner_form_handeling.js"></script>
</head>
<body>
  <?php include("includes/nav.php");?>
  <div>
    <div class="banner">
      <input hidden value=<?php echo($current_date);?> type="date" name="current-date" id="current-date">
      <div class="prev">
        <button onclick="window.location.href='calendar.php?current_date=<?php echo($max_subtract)?>';"><<<</button>
        <button onclick="window.location.href='calendar.php?current_date=<?php echo($min_subtract)?>';"><</button>
      </div>
      <div class="display-dates-overview">
        <a id="display-dates-overview"><?php echo($current_date . " till " . $end_date);?></a>
      </div>
      <div class="next">
        <button onclick="window.location.href='calendar.php?current_date=<?php echo($min_add)?>';">></button>
        <button onclick="window.location.href='calendar.php?current_date=<?php echo($max_add)?>';">>>></button>
      </div>
    </div>
    <div class="calendar">
      <div class="parade1">
        <?php 
        if($user_data["admin"] == 1) {
          echo(html_for_admin_page_on_callandar());
        }else {
          echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data));
          $output_count = $output_count + 1;
        }
        ?>
      </div>
      <div class="parade2">
        <?php 
          if ($parade_dates[$output_count]["date"] == "null"){
            echo("<div class=\"event\"><h2>no parades beyond this point</h2></div>");
          }else{
            echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data));
          }
          $output_count = $output_count + 1;
        ?>
      </div>
      <div class="parade3">
        <?php 
          if ($parade_dates[$output_count]["date"] == "null"){
            echo("<div class=\"event\"><h2>no parades beyond this point</h2></div>");
          }else{
            echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data));
          }
          $output_count = $output_count + 1;
        ?>
      </div>
      <div class="parade4">
        <?php 
          if ($parade_dates[$output_count]["date"] == "null"){
            echo("<div class=\"event\"><h2>no parades beyond this point</h2></div>");
          }else{
            echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data));
          }
          $output_count = $output_count + 1;
        ?>
      </div>
      <div class="parade5">
        <?php 
          if ($parade_dates[$output_count]["date"] == "null"){
            echo("<div class=\"event\"><h2>no parades beyond this point</h2></div>");
          }else{
            echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data));
          }
          $output_count = $output_count + 1;
        ?>
      </div>
    </div>
  </div>
</body>
</html>
<?php mysqli_close($con)?>