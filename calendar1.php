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
            $query = "select eventDate from parades where eventDate >= '$todaysDate' limit 5";
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
        $query = "select * from parades where eventDate >= '$todaysDate' limit 5";
        $result = mysqli_query($con, $query);
        if ($result->num_rows > 0) {
            echo("<div class=\"grid-container\">");
            // output date of each row and make respective column
            if ($user_data["admin"] == 1) {
              echo("<div class=\"grid-item\">");
              echo("<h3> this is the admin panle</h3>");
              echo("<p id=\"R1M1\"hidden>hidden text1</p>");
              echo("<p id=\"R1M2\"hidden>hidden text2</p>");
              echo("<p id=\"R1M3\"hidden>hidden text3</p>");
              echo("<p id=\"R1M4\"hidden>hidden text4</p>");
              echo("</div>");
              $columnCount = 2;
            } else  {
              $columnCount = 3;
            }
            $allData = array();
            while($row = $result->fetch_assoc()) {
                //make this arrays line
                $line = [];
                //retrieve info for event 1 to 4

                $query = "select * from event where eventID = '". $row["event1ID"]. "'";
                $result1 = mysqli_query($con, $query);
                $line[0] = $result1->fetch_assoc();
                $query = "select first_name, last_name from user where id = '". $line[0]["ownerID"]. "'";
                $result1 = mysqli_query($con, $query);
                $rowL1Owner = $result1->fetch_assoc();
                print_r($result1->fetch_assoc());
                $line[0]["first name"] = $result1->fetch_assoc();
                $query = "select * from event where eventID = '". $row["event2ID"]. "'";
                $result2 = mysqli_query($con, $query);
                $rowL2 = $result2->fetch_assoc();
                $line[1] = $result2->fetch_assoc();
                $query = "select first_name, last_name from user where id = '". $rowL2["ownerID"]. "'";
                $result2 = mysqli_query($con, $query);
                $rowL2Owner = $result2->fetch_assoc();
                $query = "select * from event where eventID = '". $row["event3ID"]. "'";
                $result3 = mysqli_query($con, $query);
                $rowL3 = $result3->fetch_assoc();
                $query = "select first_name, last_name from user where id = '". $rowL3["ownerID"]. "'";
                $result3 = mysqli_query($con, $query);
                $rowL3Owner = $result3->fetch_assoc();
                $query = "select * from event where eventID = '". $row["event4ID"]. "'";
                $result4 = mysqli_query($con, $query);
                $rowL4 = $result4->fetch_assoc();
                $query = "select first_name, last_name from user where id = '". $rowL4["ownerID"]. "'";
                $result4 = mysqli_query($con, $query);
                $rowL4Owner = $result4->fetch_assoc();
                //print the outputs in HTML code for each
                // href=\"event.php?paradeID=1&eventID=1\"
                echo("<div class=\"grid-item\">");
                //print_r($line);
                print_r($line);
                echo($line[0]);
                echo("<h3>". $row["eventDate"]. "<br>". $row["eventStartTime"]. " till ". $row["eventEndTime"]. "</h3>" ."\n");
                echo("<button id=\"R". $columnCount. "I1\">click for more</button>\n");
                echo("<L class=\"event\">". $rowL1["eventStart"]." till ". $rowL1["eventEnd"]."<br>". $rowL1["eventName"] ."\n");
                echo("<br>". $rowL1Owner["first_name"]." ". $rowL1Owner["last_name"]. "</L>" ."\n");
                echo("<button id=\"R". $columnCount. "I2\">click for more</button>\n");
                echo("<L class=\"event\">". $rowL2["eventStart"]." till ". $rowL2["eventEnd"]."<br>". $rowL2["eventName"]);
                echo("<br>". $rowL2Owner["first_name"]." ". $rowL2Owner["last_name"]. "</L>" ."\n");
                echo("<button id=\"R". $columnCount. "I3\">click for more</button>\n");
                echo("<L class=\"event\">". $rowL3["eventStart"]." till ". $rowL3["eventEnd"]."<br>". $rowL3["eventName"]);
                echo("<br>". $rowL3Owner["first_name"]." ". $rowL3Owner["last_name"]. "</L>" ."\n");
                echo("<button id=\"R". $columnCount. "I4\">click for more</button>\n");
                echo("<L class=\"event\">". $rowL4["eventStart"]." till ". $rowL4["eventEnd"]."<br>". $rowL4["eventName"]);
                echo("<br>". $rowL4Owner["first_name"]." ". $rowL4Owner["last_name"]. "</L>" ."\n");
                echo("</div>" ."\n");
                $columnCount = $columnCount + 1;
            }
            while ($columnCount <= 4) {
              echo("<div class=\"grid-item\">");
              echo("<h3>no events on this day</h3>");
              echo("</div>");
              $columnCount = $columnCount + 1;
            }
            echo("</ul>");
          } else {
            echo("no results for upcoming parades");
          }
        ?>
</ul>
</body>
<?php include("includes/footer.php");?>
</html>