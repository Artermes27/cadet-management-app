<?php
    session_start();
	include_once("includes/connection.php");
	include("includes/functions.php");
	$user_data = check_login($con);
    include("includes/nav.php"); 
?>