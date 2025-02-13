<?php

function check_login($con){
	//testing for session data
	if(isset($_SESSION['user_id']) && isset($_SESSION['password'])){
		//retreving session data 
		$id = $_SESSION['user_id'];
		$password = $_SESSION['password'];
		//querying the database for users data
		$query = "SELECT * FROM users Where `user_id` = '$id' AND `password` = '$password' limit 1;";
		$result = mysqli_query($con,$query);
		//attaching user data if user found
		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			//testing for more data sent in get request
			if (isset($_GET["parade_id"])){
				$user_data["parade_id"] = $_GET["parade_id"];
			}if (isset($_GET["event_id"])){
				$user_data["event_id"] = $_GET["event_id"];
			}
			return $user_data;
		}
	}
	//redirect to login
	header("Location: login.php");
	die;

}

?>