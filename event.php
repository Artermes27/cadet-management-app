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
            <h1>parade <?php echo($user_data["paradeID"]);?></h1>
            <div class="event">
                <a href="event.php?paradeID=1&eventID=1">lesson 1</a>
            </div>
            <div class="event">
                <h4>lesson 2</h4>
            </div>
        </div>
        <div class="right-side">
            <h1>lesson x</h1><h1></h1><h1></h1><h1></h1>
            <div class=register>
                <h4>this is the register</h4><br>
                <?php
                print_r($user_data);
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