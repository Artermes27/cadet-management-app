<?php
    include("connection.php");

	$user_data = check_login($con);
?>

<link rel="stylesheet" href="css/nav-style.css">
<nav>
        <div class="left">
            <a data-active="my dashbord" href="dashbord.php">my dashbord</a>
            <a data-active="my calendar" href="calendar1.php">my calendar</a>
            <a data-active="my events" href="contact.php">my events</a>
            <a data-active="my stores" href="contact.php">my stores</a>
        </div>
        <div class="right">
            <?php 
            if($user_data["admin"] == "1")  {
        echo("<a data-active=\"my-profile\" href=\"add.php\">add parade/event/acount/equipment</a>");
            }
            ?>
            <a data-active="my-profile" href="profile.php">my profile</a>
            <a data-active="logout" href="logout.php">logout</a>
        </div>
    </nav>
