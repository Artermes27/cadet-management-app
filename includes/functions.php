<?php

function check_login($con){
		if(isset($_SESSION['user_id']) && isset($_SESSION['password'])){
				$id = $_SESSION['user_id'];
				$password = $_SESSION['password'];
				$query = "SELECT * FROM users Where `user_id` = '$id' AND `password` = '$password' limit 1;";
				$result = mysqli_query($con,$query);
				if($result && mysqli_num_rows($result) > 0){
				$user_data = mysqli_fetch_assoc($result);
				if (isset($_GET["parade_id"])){
					$user_data["parade_id"] = $_GET["parade_id"];
				}if (isset($_GET["event_id"])){
					$user_data["event_id"] = $_GET["event_id"];
				}
				return $user_data;
		}
	}
		header("Location: login.php");
	die;

}
/*
function check_login($con){
	$query = "SELECT * FROM users WHERE user_id = 0;";
	$result = mysqli_query($con, $query);
	$user_data = mysqli_fetch_assoc($result);
	return $user_data;
}
*/

?>