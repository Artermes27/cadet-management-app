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
	<link rel="stylesheet" href="css/add-style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
  <script src="js/calendar.js"></script>
</head>
<body>
    <?php include("includes/nav.php");?>
    <div class="grid-container">
        <div class="events-parades">
            <h3 style="text-align: center;">events/parades</h3>
            <div class="add-parade">
                <input type="text">
            </div>
            <div class="add-event">

            </div>
        </div>
        <div class="users">
            <h3 style="text-align: center;">users</h3>
            <div class="add-user">
                <div class="lables">
                    <h4 style="text-decoration:underline">add a user</h4>
                    <h5>first name</h5>
                    <h5>last name</h5>
                </div>
                <div class="input-fields">
                    <h4 style="height: 3px;"></h4><br style="height: 20px;">
                    <input type="text" name="" id="">
                    <input type="text" name="" id="">            
                </div>
            </div>
            <div class="remove-user">
                <h4 style="text-decoration:underline">remove a user</h4>
            </div>
            <div class="modify-user">
                <h4 style="text-decoration:underline">modify a user</h4>
            </div>
        </div>
        <div class="equipment">
            <h3 style="text-align: center;">equipment</h3>
            <div class="add-equipment">

            </div>
            <div class="remove-equipment">

            </div>
            <div class="modify-equipment">

            </div>
        </div>
    </div>
</body>