<?php
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
        if($event_display_type == "admin_calendar"){//if the user is an admin and they are on the calendar page, then the admin panel edit button must be displayed
            $query = "SELECT `first_name`, `last_name`, `rank` FROM users WHERE user_id = " . $event["owner"] . ";";
            $result = mysqli_query($con, $query);
            $owner = mysqli_fetch_assoc($result);
            $return_html = "<div class=\"" . $style_class . "\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a><br>\n<a>" . $owner["rank"] . " " . $owner["first_name"] . " " . $owner["last_name"] . "</a><br>\n<button onclick=\"populateAdminEditEventForm('" . $event["parade_id"] . "', '" . $event["event_id"] . "', '" . $event["event_type"] . "', '" . $event["event_name"] . "', '" .  $event["event_start"] . "', '" . $event["event_end"] . "', '" . $event["owner"] . "', '" .  $event["final_aproval"] . "')\">click for admin panel edit</button></div>\n";
        }elseif($event_display_type == "admin_event"){//if the user is an admin and they are on the event page, the admin panel edit button is not needed
            $query = "SELECT `first_name`, `last_name`, `rank` FROM users WHERE user_id = " . $event["owner"] . ";";
            $result = mysqli_query($con, $query);
            $owner = mysqli_fetch_assoc($result);
            $return_html = "<div class=\"" . $style_class . "\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a><br>\n<a>" . $owner["rank"] . " " . $owner["first_name"] . " " . $owner["last_name"] . "</a><br>\n</div>\n";
        }elseif($event_display_type == "G4"){//if in future events were to be displayed differently they can be easilly changed here
            $return_html = "<div class=\"" . $style_class . "\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a></div>\n";
        }elseif($event_display_type == "standard"){
            if ($event["owner"] == $user_id){//event owners must have the event.php link and the aproval status displayed
                $return_html = "<div class=\"" . $style_class . "\"><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a></div>\n";
            }elseif($event["duty"] == $user_id){//if the user is not the owner and instead they are the duty cadet then duty event must be displayed as well as the lik to the event page
                $return_html = "<div class=\"" . $style_class . "\"><a>duty event</a><br><a>" . $event["event_start"] .  " till " . $event["event_end"] . "</a><br>\n<a href=\"event.php?parade_id=" . $event["parade_id"] . "&event_id=" . $event["event_id"] . "\">" .  $event["event_name"] . "</a></div>\n";
            }else{//the user is just on the register so only display times of the event and the name. do not indicate the aproval status of the event 
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
            foreach ($equipment_reuqest_log as $request) {//looping through each equipment request
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
    function html_for_parade($con, $parade_date, $user_data, $output_format){
        //selecting the parade_id
        $query = "SELECT parade_id, parade_name FROM parades WHERE date = '$parade_date';";
        $result = mysqli_query($con, $query);
        $parade = mysqli_fetch_assoc($result);
        //setting the display type of the user i.e. should they see an equipment request log or should they have the admin panel edit button
        if($user_data["admin"] == 1 and $output_format == "calendar"){//if the user is admin or G4 then display all events for the parade
            $query = "SELECT events.* FROM events WHERE parade_id =" . $parade["parade_id"] . " ORDER BY events.event_start;";
            $event_display_type = "admin_calendar";
        }elseif($user_data["admin"] == 1 and $output_format == "event"){//if the user is admin or G4 then display all events for the parade
            $query = "SELECT events.* FROM events WHERE parade_id =" . $parade["parade_id"] . " ORDER BY events.event_start;";
            $event_display_type = "admin_event";
        }elseif($user_data["G4"] == 1){
            $query = "SELECT events.* FROM events WHERE parade_id =" . $parade["parade_id"] . " ORDER BY events.event_start;";
            $event_display_type = "G4";
        }else{//if the user is not admin or G4 then they should only see events they are related to
            $query = "SELECT DISTINCT events.* FROM events LEFT JOIN user_event ON events.event_id = user_event.event_id WHERE (parade_id = " . $parade["parade_id"] . " AND user_event.user_id = " . $user_data["user_id"] . ") OR ((events.duty = " . $user_data["user_id"] . " OR events.owner = " . $user_data["user_id"] . ") AND parade_id = " . $parade["parade_id"] . ") ORDER BY events.event_start;";
            $event_display_type = "standard";
        }
        $result = mysqli_query($con, $query);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if($output_format == "calendar"){//the headings of the parade are different formats for the calendar and event pages respectively
            $parade_html = "<div class=\"event\"><h2>" . $parade_date . "</h2><h2>" . $parade["parade_name"] . "</h2>";
            $parade_html .= "</div>\n";
        }if($output_format == "event"){
            $parade_html = "<h1>" . $parade_date . "</h1><h1>" . $parade["parade_name"] . "</h1>";
        }
        $event_count = 0;
        if(count($events) == 0){
        $parade_html .= "<div class=\"event\"><a>you have no events on this parade night</a></div>";
        }else{
            if ($user_data["G4"] == 1 and $output_format == "calendar"){//if the user is G4 then an equipment request log must be produced
                $equipment_reuqest_log = [];//initialising the equipment request log
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
?>