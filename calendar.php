<?php 
session_start();

	include_once("includes/connection.php");
	include("includes/functions.php");

  $user_data = check_login($con);

  function date_skip_method($con, $current_date, $skip){//retreving the dates for the skip buttons on calendar.php
    if($skip == "-1"){
      $query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date DESC limit 1;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if (count($dates) == 0)  {
        return "null";
      } else {
      return $dates[0]["date"];
      }
    }if($skip == "+1"){
      $query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 1;";
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if (count($dates) == 0)  {
        return "null";
      } else {
      return $dates[0]["date"];
      }
    }if($skip == "-5"){
      $query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date DESC limit 5;";
      //echo($query);
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
      //echo($query);
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if(mysqli_num_rows($result) == 0){
        return "null";
      } else {
        return $dates[count($dates)-1]["date"];
      }
    }if($skip == "-4"){
      $query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date DESC limit 4;";
      //echo($query);
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
      //echo($query);
      $result = mysqli_query($con, $query);
      $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if(mysqli_num_rows($result) == 0){
        return "null";
      } else {
        return $dates[count($dates)-1]["date"];
      }
    }
  }

  function get_parade_date_range($con, $current_date, $admin)	{//retreving the next 5 parade dates
    $query = "SELECT date FROM parades WHERE date >= '$current_date' ORDER BY date ASC limit 5;";
    //echo($query);
    $result = mysqli_query($con, $query);
    $dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (count($dates) < 5)  {
      $end_date = $dates[count($dates)-1]["date"];
      while(count($dates) < 5) {
        $dates[] = ["date" => "no parades beyond this date"];
      }
    } else {
      if($admin == 1){//corecting the displayed end date given the admin panle takes up a parade slot
        $end_date = $dates[count($dates)-2]["date"];
      }else{
        $end_date = $dates[count($dates)-1]["date"];
      }
    }
    return [$dates, $end_date];
  }

  function html_for_parade_on_callendar($con, $parade_date, $user_data){//echo the HTML for the parade on the calendar
    $query = "SELECT parade_id, parade_name FROM parades WHERE date = '$parade_date';";
    $result = mysqli_query($con, $query);
    $parade = mysqli_fetch_assoc($result);
    if($user_data["admin"] == 1){//admin will see events they are not in | cadets must be in a lesson to see it
      $query = "SELECT events.* FROM events WHERE parade_id =" . $parade["parade_id"] . " ORDER BY events.event_start;";
    }else{
      $query = "SELECT DISTINCT events.* FROM events LEFT JOIN user_event ON events.event_id = user_event.event_id WHERE (parade_id = " . $parade["parade_id"] . " AND user_event.user_id = " . $user_data["user_id"] . ") OR (events.owner = " . $user_data["user_id"] . " AND parade_id = " . $parade["parade_id"] . ") ORDER BY events.event_start;";
    }
    $result = mysqli_query($con, $query);
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $event_count = 0;
    $event_html = "<div class=\"event\"><h2>" . $parade_date . "</h2><h2>" . $parade["parade_name"]. "</h2></div>";
    if(count($events) == 0){//the user has no events on this parade night
      $event_html = $event_html . "<div class=\"event\"><a>you have no events on this parade night</a></div>";
    }else{//the user has events on this parade night
      while($event_count < count($events)){
        //giving the owner the option to modify their event
        if($events[$event_count]["final_aproval"] == 0){//the event is not aproved
          $style_class = "event_not_aproved";
        }elseif($events[$event_count]["final_aproval"] == 1){//the event is aproved
          $style_class = "event_aproved";
        }elseif($events[$event_count]["final_aproval"] == 2){//the event is pending aproval
          $style_class = "event_aproval_requested";
        }
        if($user_data["admin"] == 1){//admin so add buttons to activate the event specific element of the admin panle
          $query = "SELECT `first_name`, `last_name`, `rank` FROM users WHERE user_id = " . $events[$event_count]["owner"] . ";";
          $result = mysqli_query($con, $query);
          $owner = mysqli_fetch_assoc($result);
            $event_html = $event_html . "<div class=\"" . $style_class . "\"><a>" . $events[$event_count]["event_start"] .  " till " . $events[$event_count]["event_end"] . "</a><br>\n<a>" . $events[$event_count]["event_name"] . "</a><br>\n<a>" . $owner["rank"] . " " . $owner["first_name"] . " " . $owner["last_name"] . "</a><br>\n<a href=\"event.php?parade_id=" . $parade["parade_id"] . "&event_id=" . $events[$event_count]["event_id"] . "\">" .  $events[$event_count]["event_name"] . "</a><br>\n<button onclick=\"populateAdminEditEventForm('" . $events[$event_count]["parade_id"] . "', '" . $events[$event_count]["event_id"] . "', '" . $events[$event_count]["event_type"] . "', '" . $events[$event_count]["event_name"] . "', '" .  $events[$event_count]["event_start"] . "', '" . $events[$event_count]["event_end"] . "', '" . $events[$event_count]["owner"] . "', '" .  $events[$event_count]["final_aproval"] . "')\">click for admin panel edit</button></div>\n";
          }elseif($user_data["user_id"] == $events[$event_count]["owner"]){
            $event_html = $event_html . "<div class=\"event\"><a>" . $events[$event_count]["event_start"] .  " till " . $events[$event_count]["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $parade["parade_id"] . "&event_id=" . $events[$event_count]["event_id"] . "\">" .  $events[$event_count]["event_name"] . "</a></div>\n";
          }else {//non owner so they can only view the event
            $event_html = $event_html . "<div class=\"event\"><a>" . $events[$event_count]["event_start"] .  " till " . $events[$event_count]["event_end"] . "</a><br>\n<a>" . $events[$event_count]["event_name"] . "</a></div>\n";
          }
        $event_count = $event_count + 1;
      }
    }
    return $event_html;
  }

  function html_for_admin_page_on_callandar(){//generate the general form for the admin panle on calendar.php
    $html = "<div class=\"event\">";
    $html .= "<h2>admin panel</h2>\n";
    $html .= "<div id=\"curent_event_owner_full_name\"></div>\n";
    $html .= "<form action=\"requests/event_details_requests.php\" method=\"POST\">\n";
    $html .= "<div class=\"modify_event_form\">\n";
    $html .= "<input hidden value=\"1\" type=\"text\" name=\"modify_event_details\" id=\"modify_event_details\">\n";
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
    $html .= "</div>\n";
    $html .= "</form>\n";
    $html .= "<form action=\"requests/event_details_requests.php\" method=\"POST\">\n";
    $html .= "<input hidden value=\"1\" type=\"text\" name=\"delete_event\" id=\"delete_event\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"delete_parade_id\" id=\"delete_parade_id\">\n";
    $html .= "<input hidden value=\"\" type=\"text\" name=\"delete_event_id\" id=\"delete_event_id\">\n";
    $html .= "<button class=\"input_handeling\" id=\"delete-event-submit\" style=\"width: 100%;\" disabled>delete event</button>\n";
    $html .= "</form>\n";
    $html .= "</div>\n";
    return $html;
  }  

  //checking for the current date variable from the previous page
  if(isset($_GET["current_date"]) and $_GET["current_date"] != "null") {
    $current_date = $_GET["current_date"];
  } else {
    $current_date = "2025-01-24";
  }
  //getting the parade dates for the current date
  $temp = get_parade_date_range($con, $current_date, $user_data["admin"]);
  $parade_dates = $temp[0];
  $end_date = $temp[1];
  //defining the variables for the skip forwards and back in the calendar
  $min_add = date_skip_method($con, $current_date, "+1");
  $min_subtract = date_skip_method($con, $current_date, "-1");
  //skip is different for admin because they have the admin panle on the left which take up a parade slot
  if($user_data["admin"] == 0) {
    $max_add = date_skip_method($con, $current_date, "+5");
    $max_subtract = date_skip_method($con, $current_date, "-5");
  } else {
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
  <script src="js/calendar.js"></script>
  <script src="js/event_owner_form_handeling.js"></script>
</head>
<body>
  <?php include("includes/nav.php");?>
  <div calss="container">
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
        } else {
          echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data));
          $output_count = $output_count + 1;
        }
        ?>
      </div>
      <div class="parade2">
        <?php echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data)); $output_count = $output_count + 1;?>
      </div>
      <div class="parade3">
        <?php echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data)); $output_count = $output_count + 1;?>
      </div>
      <div class="parade4">
        <?php echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data)); $output_count = $output_count + 1;?>
      </div>
      <div class="parade5">
        <?php echo(html_for_parade_on_callendar($con, $parade_dates[$output_count]["date"], $user_data)); $output_count = $output_count + 1;?>
      </div>
    </div>
  </div>
</body>
</html>
<?php mysqli_close($con)?>