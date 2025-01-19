<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "SELECT * FROM user Where id = '$id' limit 1;";

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

function get_current_rank($con)
{
	$ranks = array("cadett", "Lance_Corporal", "Corporal", "Sergeant", "Staff_Sergeant", "CQMS", "CSM", "RQMS", "RSM");
	$id = $_SESSION['user_id'];
	$rank = null;
	$x = 8;
	while($rank == null AND $x > -1){
		$query = "SELECT * FROM `rank` WHERE id ='$id' AND $ranks[$x] IS NULL;";
		$result = mysqli_query($con,$query);
		//echo var_dump($result);
		if(mysqli_num_rows($result) == 0){
			$rank = $ranks[$x];
		}
		$x = $x - 1;
	}
	return $rank;
}

function get_rank($con, $rank_reference)
{
	$ranks = array("cadett", "Lance_Corporal", "Corporal", "Sergeant", "Staff_Sergeant", "CQMS", "CSM", "RQMS", "RSM");
	$id = $_SESSION['user_id'];
	$rank_reference = $ranks[$rank_reference];
	$query = "SELECT $rank_reference FROM `rank` WHERE id = '$id';";
	$result = mysqli_fetch_assoc(mysqli_query($con, $query));
	echo $result[$rank_reference];
}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}