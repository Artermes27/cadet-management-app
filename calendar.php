<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title>my Dashbord</title>
	<link rel="stylesheet" href="css/calendar-style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
  <script src="js/calendar.js"></script>
</head>
<body>
    <?php include("includes/nav.php");?>
    <div class="month">
        <ul>
            <li class="prev">&#10094;</li>
            <li class="next">&#10095;</li>
            <li><?php 
            // get todays date
            //$todaysDate = str_replace("/", "-", date("Y/m/d"));
            $todaysDate = "2024-11-29";
            //search for parades with date >= todays date
            $query = "select date from parades where date >= '$todaysDate' limit 5";
            $result = mysqli_query($con, $query);
            if ($result->num_rows > 0)  {
              $dates = $result->fetch_all();
              $length = $result->num_rows;
              echo($dates[0][0]);
              echo("<br>till<br>");
              echo($dates[$length-1][0]);
            } else  {
              echo("no upcoming parades");
            }
            ?></li>
        </ul>
        </div>

        <?php 
        // get todays date
        //$todaysDate = str_replace("/", "-", date("Y/m/d"));
        $todaysDate = "2024-11-29";
        //search for parades with date >= todays date
        $query = "select * from parades where date >= '$todaysDate' limit 5";
        $result = mysqli_query($con, $query);
        if ($result->num_rows > 0) {
            //make the $all_data array and set column count to 0
            $column_count = 0;
            $all_data = [];
            while($parade = mysqli_fetch_assoc($result)) {
                //retreve events for a parade
                $column = [];
                $event_count = 1;
                $query = "SELECT events.* FROM events, user_event WHERE events.parade_id = '$parade[parade_id]' and user_event.user_id = '" . get_id() . "' and user_event.event_id = events.event_id ORDER BY event_start;";
                $all_events = mysqli_query($con, $query);
                $column[0] = $parade;
                while($event = mysqli_fetch_assoc($all_events)) {
                    //loop through each event
                    $column[$event_count] = $event;
                    $query = "SELECT users.last_name, users.rank FROM users, events WHERE users.user_id = events.owner and events.event_id = $event[event_id];";
                    $owner = mysqli_query($con, $query);
                    $column[$event_count]["owner"] = mysqli_fetch_assoc($owner)["last_name"];
                    $event_count = $event_count + 1;
                }
                $all_data[$column_count] = $column;
                $column_count = $column_count + 1;
                }
            //print_r($all_data);
            }
            //process of outputing data stored in $all_data to HTML code
            echo("<div class=\"grid-container\">\n");
            if ($user_data["admin"] == 1) {
                echo("<div class=\"grid-item\">\n");
                echo("<h3> this is the admin panle</h3>\n");
                $maxColumn = 4;
                $column_count = 0;
                while($column_count < $maxColumn){
                    //HTML code for each of the more infomation tabs for each event
                    $event_count = 1;
                    while($event_count < 5){
                        echo("<div class=\"R".$column_count. "M". ($event_count - 1)."\"hidden>\n");
                        echo("<a href=\"event.php?parade_id=". $all_data[$column_count][0]["parade_id"]. "&event_id=". $all_data[$column_count][$event_count]["event_id"]. "\">click for edit page</a><br>\n");
                        echo("<a>event type: ". $all_data[$column_count][$event_count]["event_type"]."</a><br>\n");
                        echo("<a>event name: ". $all_data[$column_count][$event_count]["event_name"]."</a><br>\n");
                        echo("<a>event start time: ". $all_data[$column_count][$event_count]["event_start"]."</a><br>\n");
                        echo("<a>event end time: ". $all_data[$column_count][$event_count]["event_end"]."</a><br>\n");
                        echo("<a>event owner: ". $all_data[$column_count][$event_count]["owner"]. $all_data[$column_count][$event_count]["last_name"]. "</a><br>\n");
                        if($all_data[$column_count][$event_count]["final_aproval"] == "1"){
                            echo("<a>approved: TRUE</a><br>\n");
                        }else{
                            echo("<a>approved: FALSE</a><br>\n");
                        }
                        echo("<a>equipment request printout here</a><br>\n");
                        echo("</div>\n");
                        $event_count = $event_count + 1;
                    }
                    $column_count = $column_count + 1;
                    }
                //close the admin column
                echo("</div>\n");
            } else  {
                $maxColumn = 5;
            }
            $column_count = 0;
            while($column_count < $maxColumn){
                if($all_data[$column_count]){
                    $event_count = 0;
                    //HTML code for each column of the callendar
                    echo("<div class=\"grid-item\">");
                    echo("<h3>". $all_data[$column_count][0]["date"]. "<br>". $all_data[$column_count][0]["start"]. " till ". $all_data[$column_count][0]["end"]. "</h3>" ."\n");
                    $event_count = 1;
                    if ($user_data["admin"] == 1) {
                        while($event_count < 5) {
                            //html code for each event in the column
                            echo("<button id=\"R". $column_count. "I". ($event_count-1). "\">click for more</button>\n");
                            echo("<L class=\"event\">". $all_data[$column_count][$event_count]["event_start"]." till ". $all_data[$column_count][$event_count]["event_end"]."<br>". $all_data[$column_count][$event_count]["event_name"] ."\n");
                            echo("<br>". $all_data[$column_count][$event_count]["first_name"]." ". $all_data[$column_count][$event_count]["last_name"]. "</L>" ."\n");
                            $event_count = $event_count + 1;
                        }
                    }else{
                        while($event_count < 5) {
                            //html code for each event in the column
                            echo("<L class=\"event\">". $all_data[$column_count][$event_count]["event_start"]." till ". $all_data[$column_count][$event_count]["event_end"]."<br>". $all_data[$column_count][$event_count]["event_name"] ."\n");
                            echo("<br>". $all_data[$column_count][$event_count]["first_name"]." ". $all_data[$column_count][$event_count]["last_name"]. "</L>" ."\n");
                            //echo($all_data[$column_count][$event_count]);
                            $event_count = $event_count + 1;
                        }
                    }
                }else {
                    //HTML code for when their are no more parade nights
                    echo("<div class=\"grid-item\">");
                    echo("<h3>no events on this day". $column_count . "</h3>");
                    echo("</div>");
                    $column_count = $column_count + 1;
                }

                echo("</div>" ."\n");
                $column_count = $column_count + 1;
                }
            echo("</div>" ."\n");
            echo("</ul>");
        ?>
</ul>
</body>
<?php include("includes/footer.php");?>
</html>