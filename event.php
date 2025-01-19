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
            <div class=register>
                <h4>register</h4>
                <?php
                $query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM user_event, users WHERE user_event.event_id = $user_data[event_id] and users.user_id = user_event.user_id;";
                $result = mysqli_query($con, $query);
                //prosesing method for when register is submited
                if($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    //something was posted
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if(!empty($email) && !empty($password))
                    {
                
                        //read from database
                        $query = "select * from users where email = '$email' limit 1";
                        $result = mysqli_query($con, $query);
                        if($result)
                        {
                            if($result && mysqli_num_rows($result) > 0)
                            {echo "query sucess,";
                
                                $user_data = mysqli_fetch_assoc($result);
                                
                                if($user_data['password'] === hash("sha256", $password));
                                {
                                    echo "password match";
                                    $_SESSION['user_id'] = $user_data['user_id'];
                                    header("Location: dashbord.php");
                                    die;
                                }
                            }
                        }
                        
                        echo "wrong password!";
                    }else
                    {
                        echo "wrong username!";
                    }
                }
                if(mysqli_num_rows($result) > 0)    {
                    while($cadet = mysqli_fetch_assoc($result)) {
                        echo("<lable>". $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</lable>\n");
                        echo("<input style=\"width: 10px; height: 20px;\" type=\number\" placeholder=\"0\" name=\"$cadet[user_id]\"><br>");
                    }
                    echo("<input type=\"submit\" value=\"submit the register\" class=\"register-button\">");
                }
                else    {
                    echo("no cadets will be present");
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