<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "SELECT * FROM users Where user_id = '$id' limit 1;";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			if ($_GET["paradeID"] and $_GET["eventID"]){
				$user_data["paradeID"] = $_GET["paradeID"];
				$user_data["eventID"] = $_GET["eventID"];
				return $user_data;
			}else{
				return $user_data;
			}
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function get_id()
{
	return $_SESSION['user_id'];
}

function get_rank($con, $id)
{
	$query = "SELECT * FROM users Where user_id = '$id' limit 1;";
	$result = mysqli_query($con, $query);
	
	if(mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_assoc($result)["rank"];
	}
}