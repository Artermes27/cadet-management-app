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
	<link rel="stylesheet" href="css/event-style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
  <script src="js/event.js"></script>
</head>
<body>
    <?php include("includes/nav.php");?>
    <div class="grid-container">
        <div class="left-side">
            <h1>parade <?php echo($user_data["parade_id"]);?></h1>
            <div class="event">
                <a href="event.php?parade_id=1&event_id=1">lesson 1</a>
            </div>
            <div class="event">
                <h4>lesson 2</h4>
            </div>
        </div>
        <div class="right-side">
            <h1>lesson x</h1><h1></h1><h1></h1><h1></h1>
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
                echo("<input type=\"text\" placeholder=\"enter cadets name here\"></input><br>\n");
                echo("<input type=\"submit\" value=\"add cadet to the register\" name=\"add-cadet\"class=\"register-button\">\n");
                echo("</form>\n");
                echo("</div>\n");
                //printing the form for revmoing a cadets
                echo("<div class=\"remove-cadet-from-register\">\n");
                ?><form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>"><?php
                echo("<input type=\"text\" placeholder=\"enter cadets name here\"></input><br>\n");
                echo("<input type=\"submit\" value=\"remove cadet from register\" name=\"remove-cadet\"class=\"register-button\">\n");
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
                    }
                    //find a better way to do this i.e. refreshing is slow
                    header("refresh:0");
                }
                //prosesing method for when a cadets name is enterd to the add cadet box and submited
                if(isset($_POST['add-cadet']))
                {
                    echo("add a cadet process");
                }
                //prosessing method for whena  cadets name is enterd to the remove a cadet box and submited
                if(isset($_POST['remove-cadet']))
                {
                    echo("remove a cadet process");
                }
                ?>
            </div>
            <div class="lesson-plan">
                <h4>this is the lesson plan</h4>
            </div>
            <div class="status">
                <h4>this is the section to show approval status</h4>
            </div>
            <div class="equipment-requests">
                <h4>equipment requests displayed here</h4>
            </div>
        </div>
    </div>

    
</body>
<?php include("includes/footer.php");?>
</html>