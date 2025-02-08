<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

    function get_event_name($con, $event_id){
        $query = "SELECT event_name FROM events WHERE event_id = " . $event_id . ";";
        $result = mysqli_query($con, $query);
        return mysqli_fetch_assoc($result)["event_name"];
    }

    function get_event_aproval_value($con, $event_id){
        $query = "SELECT final_aproval FROM events WHERE event_id = $event_id;";
        $result = mysqli_query($con, $query);
        return mysqli_fetch_assoc($result)["final_aproval"];
    }

    function get_parade_name_and_date_as_html_h1($con, $parade_id){
        $query = "SELECT parade_name, date FROM parades WHERE parade_id = " . $parade_id . ";";
        $result = mysqli_query($con, $query);
        $parade = mysqli_fetch_assoc($result);
        return "<h1>" . $parade["parade_name"] . "</h1><h1>" . $parade["date"] . "</h1>";
    }

    function generate_html_for_lesson_plan($con, $event_id){
        $query = "SELECT `parade_id`, `event_type`, `event_name`, `event_start`, `event_end`, `owner`, `final_aproval` FROM events WHERE event_id = $event_id;";
        $result = mysqli_query($con, $query);
        $event = mysqli_fetch_assoc($result);
        $query = "SELECT `rank`, `first_name`, `last_name` FROM users WHERE user_id = " . $event["owner"] . ";";
        $result = mysqli_query($con, $query);
        $owner_info_dump = mysqli_fetch_assoc($result);
        $lesson_plan_html = "";
        $lesson_plan_html .= "<h4>modify lesson details</h4>\n";
        $lesson_plan_html .= "<div class=\"lesson_details\">\n";
        $lesson_plan_html .= "<form class=\"modify_lesson_details\" id=\"modify_event_details\" action=\"functions.php\" method=\"POST\">\n";
        $lesson_plan_html .= "<input hidden value=\"1\" type=\"text\" name=\"modify_event_details\" id=\"modify_event_details\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["owner"] . "\" type=\"text\" name=\"user_id\" id=\"user_id\">\n";//this is the user id of the user that is curently loged in, this is used to check if the user has changed the event owner and redirect the acordingly when form is submited
        $lesson_plan_html .= "<input hidden value=\"" . $event_id . "\" type=\"text\" name=\"event_id\" id=\"event_id\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["owner"] . "\" type=\"text\" name=\"owner_id\" id=\"owner_id\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["parade_id"] . "\" type=\"text\" name=\"parade_id\" id=\"parade_id\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["final_aproval"] . "\" type=\"text\" name=\"original_aproval\" id=\"original_aproval\">\n";
        $lesson_plan_html .= "<label>event type</label>\n";
        $lesson_plan_html .= "<input value=\"" . $event["event_type"] . "\" type=\"text\" name=\"event_type\" id=\"event_type\" onkeyup=\"REGEXCheckEvent(this.value, 'event_type')\">\n";
        $lesson_plan_html .= "<label>event name</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_name"] . "\"type=\"text\" name=\"event_name\" id=\"event_name\" onkeyup=\"REGEXCheckEvent(this.value, 'event_name')\">\n";
        $lesson_plan_html .= "<label>event start</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_start"] . "\" type=\"time\" name=\"event_start\" id=\"event_start\" onkeyup=\"REGEXCheckEvent(this.value, 'event_start')\">\n";
        $lesson_plan_html .= "<label>event end</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_end"] . "\"type=\"time\" name=\"event_end\" id=\"event_end\" onkeyup=\"REGEXCheckEvent(this.value, 'event_end')\">\n";
        $lesson_plan_html .= "<label>final approval</label>\n";
        $lesson_plan_html .= "<select value=\"" . $event["final_aproval"] . "\" id=\"final_aproval\" name=\"final_aproval\" onclick=\"REGEXCheckEvent(this.value, 'final_aproval')\">\n";
        $lesson_plan_html .= "<option value=\"0\">not-aproved</option>\n";
        $lesson_plan_html .= "<option value=\"1\">aproved</option>\n";
        $lesson_plan_html .= "<option value=\"2\">aproval requested</option>\n";
        $lesson_plan_html .= "</select>\n";
        $lesson_plan_html .= "<label>search for new event owner:</label>\n";
        $lesson_plan_html .= "<input type=\"text\" name=\"event_owner_search_box\" id=\"event_owner_search_box\" onkeyup=\"showResutsSearchForOwner(this.value)\">\n";
        $lesson_plan_html .= "<div class=\"livesearch\" id=\"livesearch_owner\"></div>\n";
        $lesson_plan_html .= "<div class=\"input_error_handeling\" id=\"event-input-handeling\"></div>\n";
        $lesson_plan_html .= "<div class=\"display_current_owner\" id=\"display_current_owner\"><a>curent owner: " . $owner_info_dump["rank"] . " " . $owner_info_dump["first_name"] . " " . $owner_info_dump["last_name"] . "</a></div>\n";
        $lesson_plan_html .= "<button class=\"submit_button\" id=\"add-event-submit\">update lesson details</button>\n";
        $lesson_plan_html .= "</form>\n";
        $lesson_plan_html .= "</div>\n";
        return $lesson_plan_html;
    }

    function html_for_list_of_parades_events($con, $parade_id, $user_id){
        $query = "SELECT DISTINCT events.* FROM events LEFT JOIN user_event ON events.event_id = user_event.event_id WHERE (parade_id = " . $parade_id . " AND user_event.user_id = " . $user_id . ") OR (events.owner = " . $user_id . " AND parade_id = " . $parade_id . ") ORDER BY events.event_start;";
        $result = mysqli_query($con, $query);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $event_count = 0;
        $event_html = "<div class=\"event\">\n";
        while($event_count < count($events)){
            if($user_id == $events[$event_count]["owner"]){
                $event_html .= "<div class=\"event\">\n";
                $event_html .= "<a>" . $events[$event_count]["event_start"] . " till " . $events[$event_count]["event_end"] . "</a><br>\n";
                $event_html .= "<a href=\"event.php?parade_id=" . $parade_id . "&event_id=" . $events[$event_count]["event_id"] . "\">" . $events[$event_count]["event_name"] . "</a>\n";
                $event_html .= "</div>\n";
            }else {//non owner so they can only view the event
                $event_html .= "<div class=\"event\">\n";
                $event_html .= "<a>" . $events[$event_count]["event_start"] . " till " . $events[$event_count]["event_end"] . "</a><br>\n";
                $event_html .= "<a>" . $events[$event_count]["event_name"] . "</a>\n";
                $event_html .= "</div>\n";
            }
            $event_count = $event_count + 1;
        }
        $event_html .= "</div>\n";
        return $event_html;
    }

    function html_for_register($con, $event_id, $parade_id){
        //retreving the curent status of the register
        $query = "SELECT user_event.present, users.user_id, users.rank, users.first_name, users.last_name FROM user_event, users WHERE user_event.event_id = " . $event_id . " and users.user_id = user_event.user_id;";
        $result = mysqli_query($con, $query);
        $output_html = "";
        if(mysqli_num_rows($result) > 0) {
            $output_html .= "<div class=\"register-main\"><table>\n";
            $output_html .= "<form method=\"post\" action=\"functions.php\">\n";
            $output_html .= "<input hidden value=\"1\" type=\"text\" name=\"modify_register\" id=\"modify_register\">\n";
            $output_html .= "<input hidden value=\"" . $event_id . "\" type=\"text\" name=\"event_id\" id=\"event_id\">\n";
            $output_html .= "<input hidden value=\"" . $parade_id . "\" type=\"text\" name=\"parade_id\" id=\"parade_id\">\n";
            while($cadet = mysqli_fetch_assoc($result)) {
                $output_html .= "<tr>\n";
                $output_html .= "<td><label>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</label></td>\n";
                $output_html .= "<td><input style=\"width: 10px; height: 20px;\" type=\"text\" value=\"" . $cadet["present"] . "\" placeholder=\"" . $cadet["present"] . "\" name=\"" . $cadet["user_id"] . "\"></td>\n";
                $output_html .= "</tr>\n";
                $who_is_present_original[$cadet["user_id"]] = $cadet["present"];
            }
            $output_html .= "</table></div>\n";
            $output_html .= "<div style=\"padding-top:10px\" class=\"submit-the-register\"><input type=\"submit\" value=\"submit the register\" class=\"register-button\">\n";
            $output_html .= "</form></div>\n";
        } else {
            $output_html .= "no cadets will be present\n";
        }
        return $output_html;    
    }

    function html_for_amending_the_register($event_id){
        $all_html = "";
        $all_html .= "<div class=\"add-cadet-to-register\">\n";
        $all_html .= "<input style=\"width: 180px;\" placeholder=\"add a cadet(search first name)\" type=\"text\" size=\"30\" id=\"search_first_name\" value=\"\" onkeyup=\"showResultAddCadet(this.value, 'search_first_name', '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch\"></div>";
        $all_html .= "</div>\n";
        $all_html .= "<div class=\"remove-cadet-from-register\">\n";
        $all_html .= "<input style=\"width: 180px;\" placeholder=\"remove a cadet(search first name)\" type=\"text\" size=\"30\" id=\"search_first_name_delete\" value=\"\" onkeyup=\"showResultDeleteCadet(this.value, 'search_first_name_delete', '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch_delete\"></div>";
        $all_html .= "</div>\n";
        return $all_html;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <script src="js/event.js"></script>
    <script src="js/event_owner_form_handeling.js"></script>
	<title>my Dashbord</title>
	<link rel="stylesheet" href="css/event-style.css">
</head>
<body onload='setStateOfEventApproval(<?php include("connection.php"); echo(get_event_aproval_value($con, $user_data["event_id"]))?>);'>
    <?php include("includes/nav.php");?>
    <div class="grid-container">
        <div class="left-side">
            <h1><?php include("connection.php"); echo(get_parade_name_and_date_as_html_h1($con, $user_data["parade_id"]));?></h1>
            <?php include("connection.php"); echo(html_for_list_of_parades_events($con, $user_data["parade_id"], $user_data["user_id"])); ?>
        </div>
        <div class="right-side">
            <h1><?php echo(get_event_name($con, $user_data["event_id"]));?></h1><h1></h1><h1></h1>
            <div class=register-box-all>
                <h4>register</h4>
                <?php
                if(get_event_aproval_value($con, $user_data["event_id"]) == 1){
                    echo(html_for_register($con, $user_data["event_id"], $user_data["parade_id"]));
                    echo(html_for_amending_the_register($user_data["event_id"]));
                } else {
                    echo("<a>register is not available untill event is aproved</a>");
                }
                ?>
            </div>
            <div class="lesson-plan">
                <?php 
                if(get_event_aproval_value($con, $user_data["event_id"]) == 1){
                    echo("<h4>event aproved lesson plan not modifiable</h4>");
                } else {
                    echo(generate_html_for_lesson_plan($con, $user_data["event_id"]));
                }?>
            </div>
            <div class="equipment-requests">
                <h4>equipment requests displayed here</h4>
            </div>
        </div>
    </div>

    
</body>
</html>