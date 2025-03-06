<?php 
session_start();

	include_once("includes/connection.php");
	include("includes/functions.php");

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

    function generate_html_for_lesson_plan($con, $event_id, $admin){
        $query = "SELECT `parade_id`, `event_type`, `event_name`, `event_start`, `event_end`, `owner`, `final_aproval` FROM events WHERE event_id = $event_id;";
        $result = mysqli_query($con, $query);
        $event = mysqli_fetch_assoc($result);
        $query = "SELECT `rank`, `first_name`, `last_name` FROM users WHERE user_id = " . $event["owner"] . ";";
        $result = mysqli_query($con, $query);
        $owner_info_dump = mysqli_fetch_assoc($result);
        $lesson_plan_html = "";
        $lesson_plan_html .= "<h4>modify event details</h4>\n";
        $lesson_plan_html .= "<link rel=\"stylesheet\" href=\"css/event-owner-form-style.css\">\n";
        $lesson_plan_html .= "<form class=\"modify_lesson_details\" id=\"modify_event_details\" action=\"requests/event_details_requests.php\" method=\"POST\">\n";
        $lesson_plan_html .= "<input hidden value=\"modify_event_details\" type=\"text\" name=\"flag\" id=\"flag\">\n";
        $lesson_plan_html .= "<input hidden value=\"0\" type=\"text\" name=\"calendar_flag\" id=\"calendar_flag\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["owner"] . "\" type=\"text\" name=\"user_id\" id=\"user_id\">\n";        $lesson_plan_html .= "<input hidden value=\"" . $event_id . "\" type=\"text\" name=\"event_id\" id=\"event_id\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["owner"] . "\" type=\"text\" name=\"owner_id\" id=\"owner_id\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["parade_id"] . "\" type=\"text\" name=\"parade_id\" id=\"parade_id\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["final_aproval"] . "\" type=\"text\" name=\"original_aproval\" id=\"original_aproval\">\n";
        $lesson_plan_html .= "<label>event type</label>\n";
        $lesson_plan_html .= "<input value=\"" . $event["event_type"] . "\" type=\"text\" name=\"event_type\" id=\"event_type\" onkeyup=\"REGEXCheckEvent(this.value, 'event_type', '" . $admin . "')\">\n";
        $lesson_plan_html .= "<label>event name</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_name"] . "\"type=\"text\" name=\"event_name\" id=\"event_name\" onkeyup=\"REGEXCheckEvent(this.value, 'event_name', '" . $admin . "')\">\n";
        $lesson_plan_html .= "<label>event start</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_start"] . "\" type=\"time\" name=\"event_start\" id=\"event_start\" onkeyup=\"REGEXCheckEvent(this.value, 'event_start', '" . $admin . "')\">\n";
        $lesson_plan_html .= "<label>event end</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_end"] . "\"type=\"time\" name=\"event_end\" id=\"event_end\" onkeyup=\"REGEXCheckEvent(this.value, 'event_end', '" . $admin . "')\">\n";
        $lesson_plan_html .= "<label>final approval</label>\n";
        $lesson_plan_html .= "<select value=\"" . $event["final_aproval"] . "\" id=\"final_aproval\" name=\"final_aproval\" onclick=\"REGEXCheckEvent(this.value, 'final_aproval', '" . $admin . "')\">\n";
        $lesson_plan_html .= "<option value=\"0\">not-aproved</option>\n";
        $lesson_plan_html .= "<option value=\"1\">aproved</option>\n";
        $lesson_plan_html .= "<option value=\"2\">aproval requested</option>\n";
        $lesson_plan_html .= "</select>\n";
        $lesson_plan_html .= "<label>search for new event owner:</label>\n";
        $lesson_plan_html .= "<input type=\"text\" name=\"event_owner_search_box\" id=\"event_owner_search_box\" onkeyup=\"showResutsSearchForOwner(this.value)\">\n";
        $lesson_plan_html .= "<div class=\"livesearch\" id=\"livesearch_owner\"></div>\n";
        $lesson_plan_html .= "<div class=\"input_error_handeling\" id=\"event-input-handeling\"></div>\n";
        $lesson_plan_html .= "<div class=\"display_current_owner\" id=\"display_current_owner\"><a>curent owner: " . $owner_info_dump["rank"] . " " . $owner_info_dump["first_name"] . " " . $owner_info_dump["last_name"] . "</a></div>\n";
        $lesson_plan_html .= "<button class=\"submit_button\" id=\"add-event-submit\">update event details</button>\n";
        $lesson_plan_html .= "</form>\n";
        $lesson_plan_html .= "<form class=\"modify_lesson_details\" action=\"requests/event_details_requests.php\" method=\"POST\">\n";
        $lesson_plan_html .= "<input hidden value=\"delete_event\" type=\"text\" name=\"flag\" id=\"flag\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event["parade_id"]. "\" type=\"text\" name=\"delete_parade_id\" id=\"delete_parade_id\">\n";
        $lesson_plan_html .= "<input hidden value=\"" . $event_id . "\" type=\"text\" name=\"delete_event_id\" id=\"delete_event_id\">\n";
        $lesson_plan_html .= "<button class=\"input_handeling\" id=\"delete-event-submit\" style=\"width: 100%;\">delete event</button>\n";
        $lesson_plan_html .= "</form>\n";
        return $lesson_plan_html;
    }

    function html_for_list_of_parades_events($con, $parade_id, $user_id, $admin, $G4){
        if ($admin == 1 or $G4 == 1){
            $query = "SELECT * FROM events WHERE parade_id = " . $parade_id . " ORDER BY event_start;";
        } else {
            $query = "SELECT DISTINCT events.* FROM events LEFT JOIN user_event ON events.event_id = user_event.event_id WHERE (parade_id = " . $parade_id . " AND user_event.user_id = " . $user_id . ") OR (events.owner = " . $user_id . " AND parade_id = " . $parade_id . ") ORDER BY events.event_start;";
        }
        $result = mysqli_query($con, $query);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $event_count = 0;
        $event_html = "<div class=\"event\">\n";
        while($event_count < count($events)){
            if($events[$event_count]["final_aproval"] == 0){
                $style_class = "event_not_aproved";
              }elseif($events[$event_count]["final_aproval"] == 1){
                $style_class = "event_aproved";
              }elseif($events[$event_count]["final_aproval"] == 2){
                $style_class = "event_aproval_requested";
              }
            if($user_id == $events[$event_count]["owner"] or $admin == 1 or $G4 == 1){
                $event_html .= "<div class=\"" . $style_class . "\">\n";
                $event_html .= "<a>" . $events[$event_count]["event_start"] . " till " . $events[$event_count]["event_end"] . "</a><br>\n";
                $event_html .= "<a href=\"event.php?parade_id=" . $parade_id . "&event_id=" . $events[$event_count]["event_id"] . "\">" . $events[$event_count]["event_name"] . "</a>\n";
                $event_html .= "</div>\n";
            }else {
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
                $query = "SELECT user_event.present, users.user_id, users.rank, users.first_name, users.last_name FROM user_event, users WHERE user_event.event_id = " . $event_id . " and users.user_id = user_event.user_id;";
        $result = mysqli_query($con, $query);
        $output_html = "";
        if(mysqli_num_rows($result) > 0) {
            $output_html .= "<div class=\"register-main\"><table>\n";
            $output_html .= "<form method=\"post\" action=\"requests/post_requests.php\">\n";
            $output_html .= "<input hidden value=\"modify_register\" type=\"text\" name=\"flag\" id=\"flag\">\n";
            $output_html .= "<input hidden value=\"" . $event_id . "\" type=\"text\" name=\"event_id\" id=\"event_id\">\n";
            $output_html .= "<input hidden value=\"" . $parade_id . "\" type=\"text\" name=\"parade_id\" id=\"parade_id\">\n";
            while($cadet = mysqli_fetch_assoc($result)) {
                $output_html .= "<tr>\n";
                $output_html .= "<td><label>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</label></td>\n";
                $output_html .= "<td><input style=\"width: 10px; height: 20px;\" type=\"text\" value=\"" . $cadet["present"] . "\" placeholder=\"" . $cadet["present"] . "\" name=\"" . $cadet["user_id"] . "\" onkeyup=\"REGEXCheckRegister(this.value, " . $cadet["user_id"] . ")\"></td>\n";
                $output_html .= "</tr>\n";
            }
            $output_html .= "</table></div>\n";
            $output_html .= "<div class=\"input_error_handeling\" id=\"register-input-handeling\"></div>\n";
            $output_html .= "<div style=\"padding-top:10px\" class=\"submit-the-register\"><input type=\"submit\" value=\"submit the register\" id= \"register-submit\" class=\"register-button\">\n";
            $output_html .= "</form></div>\n";
        } else {
            $output_html .= "no cadets will be present\n";
        }
        return $output_html;    
    }

    function html_for_amending_the_register($event_id){
        $all_html = "";
        $all_html .= "<div class=\"search-box-all\">\n";
        $all_html .= "<input placeholder=\"add a cadet (search first name)\" type=\"text\" size=\"30\" id=\"search_first_name\" value=\"\" onkeyup=\"showResultAddCadet(this.value, 'search_first_name', '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch\"></div>";
        $all_html .= "</div>\n";
        $all_html .= "<div class=\"search-box-all\">\n";
        $all_html .= "<input placeholder=\"remove a cadet (search first name)\" type=\"text\" size=\"30\" id=\"search_first_name_delete\" value=\"\" onkeyup=\"showResultDeleteCadet(this.value, 'search_first_name_delete', '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch_delete\"></div>";
        $all_html .= "</div>\n";
        $all_html .= "<div class=\"search-box-all\">\n";
        $all_html .= "<input placeholder=\"search for another cadet's event\" type=\"text\" size=\"30\" id=\"search_first_name_other\" value=\"\" onkeyup=\"showResultSearchOtherCadet(this.value, '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch_other_cadet\"></div>";
        $all_html .= "</div>\n";
        return $all_html;
    }

    function html_for_equipment($con, $event_id, $parade_id, $G4){
        $query = "SELECT equipment_requests.equipment_id, equipment_requests.aproved, equipment.name FROM equipment_requests, equipment WHERE event_id = " . $event_id . " AND equipment_requests.equipment_id = equipment.equipment_id;";
        $result = mysqli_query($con, $query);
        $all_html = "";
        if(mysqli_num_rows($result) > 0){
            $all_html .= "<div class=\"equipemnt-display-register-main\">\n";
            $all_html .= "<table>\n";
            $all_html .= "<form method=\"post\" action=\"requests/post_requests.php\">\n";
            $all_html .= "<input hidden value=\"modify_equipment_register\" type=\"text\" name=\"flag\" id=\"flag\">\n";
            $all_html .= "<input hidden value=\"" . $event_id . "\" type=\"text\" name=\"event_id\" id=\"event_id\">\n";
            $all_html .= "<input hidden value=\"" . $parade_id . "\" type=\"text\" name=\"parade_id\" id=\"parade_id\">\n";
            while($equipment_request = mysqli_fetch_assoc($result)){
                $all_html .= "<tr>\n";
                $all_html .= "<td><label>" . $equipment_request["name"] . "</label></td>\n";
                $all_html .= "<td><select value=\"" . $equipment_request["aproved"] . "\" id=\"" . $equipment_request["equipment_id"] . "\" name=\"" . $equipment_request["equipment_id"] . "\" onclick=\"REGEXCheckEquipment(this.value, '" . $equipment_request["equipment_id"] . "', '" . $equipment_request["aproved"] . "', '" . $G4 . "')\">\n";
                $all_html .= "<option value=\"0\">requested</option>\n";
                $all_html .= "<option value=\"1\">aproved</option>\n";
                $all_html .= "<option value=\"2\">denied</option>\n";
                $all_html .= "</select></td>\n";
                $all_html .= "</tr>\n";
            }
            $all_html .= "</table><div style=\"padding-top:10px\" class=\"submit-the-equipment\"><input type=\"submit\" value=\"submit the equipment request log\" class=\"register-button\" id=\"equipment-submit\">\n";
            $all_html .= "</form></div>\n";
            $all_html .= "<div class=\"input_error_handeling\" id=\"equipment-input-handeling\"></div>\n"; 
            $all_html .= "</div>\n";
        } else{
            $all_html .= "<a>no equipment requests</a>\n";
            }
        return $all_html;
    }

    function html_for_amending_the_equipment($event_id){
        $all_html = "";
        $all_html .= "<div class=\"search-box-all\">\n";
        $all_html .= "<input placeholder=\"add equipment request (search name)\" type=\"text\" size=\"30\" id=\"search_equipment_name_add\" name=\"search_equipment_name_add\" value=\"\" onkeyup=\"showResultAddEquipment(this.value, '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch_equipment_add\"></div>";
        $all_html .= "</div>\n";
        $all_html .= "<div class=\"search-box-all\">\n";
        $all_html .= "<input placeholder=\"remove equipment request (search name)\" type=\"text\" size=\"30\" id=\"search_equipment_name_delete\" value=\"\" onkeyup=\"showResultDeleteEquipment(this.value, '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch_delete_equipment\"></div>";
        $all_html .= "</div>\n";
        $all_html .= "<div class=\"search-box-all\">\n";
        $all_html .= "<input placeholder=\"search for another equipment request\" type=\"text\" size=\"30\" id=\"search_equipment_name_other\" value=\"\" onkeyup=\"showResultSearchOtherEquipment(this.value, '" . $event_id . "')\"><br>\n";
        $all_html .= "<div id=\"livesearch_other_equipment\"></div>";
        $all_html .= "</div>\n";
        return $all_html;
    }

    function javascript_for_onload($con, $event_id){
        $return_js = "";
        $event_aproval = get_event_aproval_value($con, $event_id);
        if($event_aproval != 1){
            $return_js .= "setStateOfEventApproval(" . $event_aproval . ");";
        }else{
            $initialise_array = "register_array = {";
            $initialise_feedback = "register_feedback = {";
            $query = "SELECT user_id FROM user_event WHERE event_id = " . $event_id . ";";
            $result = mysqli_query($con, $query);
            while($cadet = mysqli_fetch_assoc($result)){
                $initialise_array .= $cadet["user_id"] . ": 1,";
                $initialise_feedback .= $cadet["user_id"] . ": \"\",";
            }
            $initialise_array .= "};equipment_array = {";
            $initialise_feedback .= "};equipment_feedback = {";
            $query = "SELECT equipment_id, aproved FROM equipment_requests WHERE event_id = " . $event_id . ";";
            $result = mysqli_query($con, $query);
            while($equipment_request = mysqli_fetch_assoc($result)){
                $return_js .= "setStateOfEquipmentRequest(" . $equipment_request["aproved"] . ", " . $equipment_request["equipment_id"] . ");";
                $initialise_array .= $equipment_request["equipment_id"] . ": 1,";
                $initialise_feedback .= $equipment_request["equipment_id"] . ": \"\",";
            }
            $initialise_array .= "};";
            $initialise_feedback .= "};";
            $return_js .= $initialise_array . $initialise_feedback;
        }
        return $return_js;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <script src="js/event.js"></script>
    <script src="js/event_owner_form_handeling.js"></script>
	<title>my Dashbord</title>
	<link rel="stylesheet" href="css/event-style.css">
    <link rel="stylesheet" href="css/event-display-block-style.css">
    <link rel="stylesheet" href="css/register-and-equipment-reuqests-style.css">
</head>
<body onload='<?php echo(javascript_for_onload($con, $user_data["event_id"]));?>'>
    <?php include("includes/nav.php");?>
    <div class="grid-container">
        <div class="left-side">
            <?php echo(get_parade_name_and_date_as_html_h1($con, $user_data["parade_id"]));?>
            <?php echo(html_for_list_of_parades_events($con, $user_data["parade_id"], $user_data["user_id"], $user_data["admin"], $user_data["G4"])); ?>
        </div>
        <div class="right-side">
            <h1><?php echo(get_event_name($con, $user_data["event_id"]));?></h1><h1></h1><h1></h1>
            <div class="register-box-all">
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
                    echo("<h4>event aproved, lesson plan not modifiable</h4>");
                } else {
                    echo(generate_html_for_lesson_plan($con, $user_data["event_id"], $user_data["admin"]));
                }?>
            </div>
            <div class="equipment-requests">
                <h4>equipment requests displayed here</h4>
                <?php 
                if(get_event_aproval_value($con, $user_data["event_id"]) == 1){
                    echo(html_for_equipment($con, $user_data["event_id"], $user_data["parade_id"], $user_data["G4"]));
                    echo(html_for_amending_the_equipment($user_data["event_id"]));
                } else {
                    echo("<a>equipment requests are not available untill event is aproved</a>");
                }
                ?>
            </div>
        </div>
    </div>

    
</body>
</html>
<?php mysqli_close($con)?>