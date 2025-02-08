<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

    function is_event_aproved($con, $event_id){
        $query = "SELECT final_aproval from events WHERE event_id = " . $event_id . ";";
        $result = mysqli_query($con, $query);
        $final_aproval = mysqli_fetch_assoc($result)["final_aproval"];
        if($final_aproval == "1"){
            return "aproved";
        }else if($final_aproval == "2"){
            return "awating aproval";
        }else{
            return "not aproved";
        }
    }

    function get_event_name($con, $event_id){
        $query = "SELECT event_name FROM events WHERE event_id = " . $event_id . ";";
        $result = mysqli_query($con, $query);
        return mysqli_fetch_assoc($result)["event_name"];
    }

    function disable_or_enable_request_aproval_button($con, $event_id){//disable or enable the request aproval button on event.php
        $query = "SELECT final_aproval FROM events WHERE event_id = $event_id;";
        $result = mysqli_query($con, $query);
        $final_aproval = mysqli_fetch_assoc($result)["final_aproval"];
        if($final_aproval == 1 or $final_aproval == 2){
            return "disabled";
        }else{
            return "enabled";
        }
    }

    function get_parade_name_and_date_as_html_h1($con, $parade_id){
        $query = "SELECT parade_name, date FROM parades WHERE parade_id = " . $parade_id . ";";
        $result = mysqli_query($con, $query);
        $parade = mysqli_fetch_assoc($result);
        return "<h1>" . $parade["parade_name"] . "</h1><h1>" . $parade["date"] . "</h1>";
    }

    function generate_html_for_lesson_plan($con, $event_id){
        $query = "SELECT `event_type`, `event_name`, `event_start`, `event_end`, `owner`, `final_aproval` FROM events WHERE event_id = $event_id;";
        $result = mysqli_query($con, $query);
        $event = mysqli_fetch_assoc($result);
        $query = "SELECT `rank`, `first_name`, `last_name` FROM users WHERE user_id = " . $event["owner"] . ";";
        $result = mysqli_query($con, $query);
        $owner_info_dump = mysqli_fetch_assoc($result);
        $lesson_plan_html = "";
        $lesson_plan_html .= "<h4>modify lesson details</h4>\n";
        $lesson_plan_html .= "<div class=\"lesson_details\">\n";
        $lesson_plan_html .= "<form class=\"modify_lesson_details\" id=\"add_new_event\" action=\"functions.php\" method=\"POST\">\n";
        $lesson_plan_html .= "<label>parade date</label>\n";
        $lesson_plan_html .= "<input value=\"" . "\" type=\"date\" name=\"parade_date\" id=\"parade_date\">\n";
        $lesson_plan_html .= "<input hidden value=\"1\" type=\"text\" name=\"add_new_event\" id=\"add_new_event\">\n";
        $lesson_plan_html .= "<input hidden value=\"\" type=\"text\" name=\"owner_id\" id=\"owner_id\">\n";
        $lesson_plan_html .= "<label>event type</label>\n";
        $lesson_plan_html .= "<input value=\"" . $event["event_type"] . "\" type=\"text\" name=\"event_type\" id=\"event_type\" onkeyup=\"REGEXCheckEvent(this.value, 'event_type')\">\n";
        $lesson_plan_html .= "<label>event name</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_name"] . "\"type=\"text\" name=\"event_name\" id=\"event_name\" onkeyup=\"REGEXCheckEvent(this.value, 'event_name')\">\n";
        $lesson_plan_html .= "<label>event start</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_start"] . "\" type=\"time\" name=\"event_start\" id=\"event_start\">\n";
        $lesson_plan_html .= "<label>event end</label>\n";
        $lesson_plan_html .= "<input  value=\"" . $event["event_end"] . "\"type=\"time\" name=\"event_end\" id=\"event_end\">\n";
        $lesson_plan_html .= "<label>final approval</label>\n";
        $lesson_plan_html .= "<select value=\"" . $event["final_aproval"] . "\" id=\"final_aproval\" name=\"final_aproval\" onclick=\"REGEXCheckEvent(this.value, 'final_aproval')\">\n";
        $lesson_plan_html .= "<option value=\"0\">not-aproved</option>\n";
        $lesson_plan_html .= "<option value=\"1\">aproved</option>\n";
        $lesson_plan_html .= "<option value=\"2\">aproval requested</option>\n";
        $lesson_plan_html .= "</select>\n";
        $lesson_plan_html .= "<label>event owner</label>\n";
        $lesson_plan_html .= "<input type=\"text\" name=\"event_owner_search_box\" id=\"event_owner_search_box\" onkeyup=\"showResutsSearchForOwner(this.value)\">\n";
        $lesson_plan_html .= "<div class=\"livesearch\" id=\"livesearch_owner\"></div>\n";
        $lesson_plan_html .= "<div class=\"input_error_handeling\" id=\"event-input-handeling\"></div>\n";
        $lesson_plan_html .= "<div class=\"display_current_owner\" id=\"display_current_owner\"><a>curent owner: " . $owner_info_dump["rank"] . " " . $owner_info_dump["first_name"] . " " . $owner_info_dump["last_name"] . "</a></div>\n";
        $lesson_plan_html .= "<button class=\"submit_button\" id=\"add-event-submit\" disabled>update lesson details</button>\n";
        $lesson_plan_html .= "</form>\n";
        $lesson_plan_html .= "</div>\n";
        return $lesson_plan_html;
    }

    function html_for_list_of_parades_events($con, $parade_id, $user_id){//echo the HTML for the parade on the calendar
        $query = "SELECT events.* FROM events, user_event WHERE parade_id =" . $parade_id . " and events.event_id = user_event.event_id and user_event.user_id = " . $user_id . " ORDER BY events.event_start;";
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
?>

<!DOCTYPE html>
<html>
<head>
    <script src="js/event.js"></script>
    <script src="js/event_owner_form_handeling.js"></script>
	<title>my Dashbord</title>
	<link rel="stylesheet" href="css/event-style.css">
</head>
<body>
    <?php include("includes/nav.php");?>
    <div class="grid-container">
        <div class="left-side">
            <h1><?php include("connection.php"); echo(get_parade_name_and_date_as_html_h1($con, $user_data["parade_id"]));?></h1>
            <?php include("connection.php"); echo(html_for_list_of_parades_events($con, $user_data["parade_id"], $user_data["user_id"])); ?>
        </div>
        <div class="right-side">
            <h1><?php echo(get_event_name($con, $user_data["event_id"]));?></h1><h1></h1><h1></h1><h1></h1>
            <div class=register-box-all>
                <h4>register</h4>
                <?php
                //retreving the curent status of the register
                $query = "SELECT user_event.present, users.user_id, users.rank, users.first_name, users.last_name FROM user_event, users WHERE user_event.event_id = $user_data[event_id] and users.user_id = user_event.user_id;";
                $result = mysqli_query($con, $query);
                //creating an asosiative array of current status of each cadet
                $who_is_present_original = array();
                if(mysqli_num_rows($result) > 0)    {
                    echo("<div class=\"register-main\"><table>");?><form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>"><?php
                    while($cadet = mysqli_fetch_assoc($result)) {
                        //printing the current register to the webpage
                        echo("<tr>");
                        echo("<td><lable>". $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</lable></td>\n");
                        echo("<td><input style=\"width: 10px; height: 20px;\" type=\"text\" placeholder=\"". $cadet["present"] . "\" name=\"$cadet[user_id]\"></td>\n");
                        echo("</tr>");
                        //adding the cadets original present status to the asosiative array
                        $who_is_present_original[$cadet["user_id"]] = $cadet["present"];
                    }
                    //print_r($who_is_present_original);
                    //print_r(array_keys($who_is_present_original));
                    //printing the form for submiting the register
                    echo("</table></div>\n");
                    echo("<div style=\"padding-top:10px\" class=\"submit-the-register\"><input type=\"submit\" value=\"submit the register\" class=\"register-button\" name=\"submit-register\">\n");
                    echo("</form></div>");
                }
                else    {
                    echo("no cadets will be present");
                }
                //printing the form for adding a cadets
                echo("<div class=\"add-cadet-to-register\">\n");
                ?><form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>"><?php
                //echo("<input type=\"text\" placeholder=\"enter cadets name here\"></input><br>\n");
                echo("<input style=\"width: 180px;\" placeholder=\"add a cadet(search first name)\" type=\"text\" size=\"30\" id=\"search_first_name\" value=\"\" onkeyup=\"showResult(this.value, 'search_first_name', '" . $user_data["event_id"] . "')\"><br>\n");
                echo("<div id=\"livesearch\"></div>");
                echo("</form>\n");
                echo("</div>\n");
                //printing the form for revmoing a cadets
                echo("<div class=\"remove-cadet-from-register\">\n");
                ?><form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>"><?php
                echo("<input style=\"width: 180px;\" placeholder=\"remove a cadet(search first name)\" type=\"text\" size=\"30\" id=\"search_first_name_delete\" value=\"\" onkeyup=\"showResultDelete(this.value, 'search_first_name_delete', '" . $user_data["event_id"] . "')\"><br>\n");
                echo("<div id=\"livesearch_delete\"></div>");
                echo("</form>\n");
                echo("</div>\n");
                //prosesing method for when register is submited
                if(isset($_POST['submit-register']))
                {
                    $who_is_present_new = $_POST;
                    unset($who_is_present_new["submit-register"]);
                    $difference = array();
                    //print_r($who_is_present_original);
                    foreach($who_is_present_new as $id => $present) {
                        if(isset($who_is_present_original[$id]) != null) {
                            //echo("not empty");
                            if($who_is_present_original[$id] != $present) {
                                //echo(" no-match ");
                                $difference[$id] = $present;
                            }   else    {
                                //do nothing because the present status hasnt changed
                                //echo(" match ");
                            }
                        }
                    }
                    //print_r($difference);
                    foreach($difference as $id => $present) {
                        $query = "update user_event set present = " . $present . " where user_id = " . $id . " and event_id = " . $user_data["event_id"] . ";";
                        mysqli_query($con, $query);
                        echo($query);
                    }
                    //find a better way to do this i.e. refreshing is slow
                    header("refresh:0");
                }
                ?>
            </div>
            <div class="lesson-plan">
                <?php echo(generate_html_for_lesson_plan($con, $user_data["event_id"]));?>
            </div>
            <div class="status">
                <h4>this is the section to show approval status</h4>
                <a><?php echo(is_event_aproved($con, $user_data["event_id"]));?></a>
                <form action="functions.php" method="POST">
                    <input name="request_approval" id="request_approval" value="1" hidden></input>
                    <input name="event_id" id="event_id" value=<?php echo("\"" . $user_data["event_id"] . "\"");?> hidden></input>
                    <input name="parade_id" id="parade_id" value=<?php echo("\"" . $user_data["parade_id"] . "\"");?> hidden></input>
                    <button id="request_approval_submit" <?php echo(disable_or_enable_request_aproval_button($con, $user_data["event_id"]));?>>request approval</button>
                </form>
            </div>
            <div class="equipment-requests">
                <h4>equipment requests displayed here</h4>
            </div>
        </div>
    </div>

    
</body>
<?php include("includes/footer.php");?>
</html>