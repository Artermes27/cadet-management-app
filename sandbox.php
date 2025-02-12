<?php
    session_start();
	include_once("connection.php");
	include("functions.php");
	$user_data = check_login($con);
    include("includes/nav.php"); 
?>