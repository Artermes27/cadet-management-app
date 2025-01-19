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
            //make the $allData array and set column count to 0
            #echo(mysqli_num_rows($result));
            while($parade = mysqli_fetch_assoc($result)) {
                //retreve events for each parade
                #print_r($row);
                $query = "SELECT events.* FROM events, user_event WHERE events.parade_id = '$parade[parade_id]' and user_event.user_id = '" . get_id() . "' and user_event.event_id = events.event_id;";
                echo($query);
                $all_events = mysqli_query($con, $query);
                #print_r(mysqli_fetch_assoc($all_events_for_1_parade));
                while($event = mysqli_fetch_assoc($all_events)) {
                    #loop through each event and place it into array for later retreval
                }
                }
            }
            //process of outputing data stored in $allData to HTML code
            echo("<div class=\"grid-container\">\n");
            if ($user_data["admin"] == 1) {
                echo("<div class=\"grid-item\">\n");
                echo("<h3> this is the admin panle</h3>\n");
                $maxColumn = 4;
                $columnCount = 0;
                while($columnCount < $maxColumn){
                    //HTML code for each of the more infomation tabs for each event
                    $eventCount = 1;
                    while($eventCount < 5){
                        echo("<div class=\"R".$columnCount. "M". ($eventCount - 1)."\"hidden>\n");
                        echo("<a href=\"event.php?paradeID=". $allData[$columnCount][0]["eventDate"]. "&eventID=". $allData[$columnCount][$eventCount]["eventID"]. "\">click for edit page</a><br>\n");
                        echo("<a>event type: ". $allData[$columnCount][$eventCount]["eventType"]."</a><br>\n");
                        echo("<a>event name: ". $allData[$columnCount][$eventCount]["eventName"]."</a><br>\n");
                        echo("<a>event start time: ". $allData[$columnCount][$eventCount]["eventStart"]."</a><br>\n");
                        echo("<a>event end time: ". $allData[$columnCount][$eventCount]["eventEnd"]."</a><br>\n");
                        echo("<a>event owner: ". $allData[$columnCount][$eventCount]["first_name"]. $allData[$columnCount][$eventCount]["last_name"]. "</a><br>\n");
                        if($allData[$columnCount][$eventCount]["first_name"] == "1"){
                            echo("<a>approved: TRUE</a><br>\n");
                        }else{
                            echo("<a>approved: FALSE</a><br>\n");
                        }
                        echo("<a>equipment request printout here</a><br>\n");
                        echo("</div>\n");
                        $eventCount = $eventCount + 1;
                    }
                    $columnCount = $columnCount + 1;
                    }
                //close the admin column
                echo("</div>\n");
            } else  {
                $maxColumn = 5;
            }
            $columnCount = 0;
            while($columnCount < $maxColumn){
                if($allData[$columnCount]){
                    $eventCount = 0;
                    //HTML code for each column of the callendar
                    echo("<div class=\"grid-item\">");
                    echo("<h3>". $allData[$columnCount][0]["eventDate"]. "<br>". $allData[$columnCount][0]["eventStartTime"]. " till ". $allData[$columnCount][0]["eventEndTime"]. "</h3>" ."\n");
                    $eventCount = 1;
                    if ($user_data["admin"] == 1) {
                        while($eventCount < 5) {
                            //html code for each event in the column
                            echo("<button id=\"R". $columnCount. "I". ($eventCount-1). "\">click for more</button>\n");
                            echo("<L class=\"event\">". $allData[$columnCount][$eventCount]["eventStart"]." till ". $allData[$columnCount][$eventCount]["eventEnd"]."<br>". $allData[$columnCount][$eventCount]["eventName"] ."\n");
                            echo("<br>". $allData[$columnCount][$eventCount]["first_name"]." ". $allData[$columnCount][$eventCount]["last_name"]. "</L>" ."\n");
                            $eventCount = $eventCount + 1;
                        }
                    }else{
                        while($eventCount < 5) {
                            //html code for each event in the column
                            echo("<L class=\"event\">". $allData[$columnCount][$eventCount]["eventStart"]." till ". $allData[$columnCount][$eventCount]["eventEnd"]."<br>". $allData[$columnCount][$eventCount]["eventName"] ."\n");
                            echo("<br>". $allData[$columnCount][$eventCount]["first_name"]." ". $allData[$columnCount][$eventCount]["last_name"]. "</L>" ."\n");
                            $eventCount = $eventCount + 1;
                        }
                    }
                }else {
                    //HTML code for when their are no more parade nights
                    echo("<div class=\"grid-item\">");
                    echo("<h3>no events on this day</h3>");
                    echo("</div>");
                    $columnCount = $columnCount + 1;
                }

                echo("</div>" ."\n");
                $columnCount = $columnCount + 1;
                }
            echo("</div>" ."\n");
            echo("</ul>");
        ?>
</ul>
</body>
<?php include("includes/footer.php");?>
</html>