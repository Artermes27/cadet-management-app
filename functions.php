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
			if (isset($_GET["parade_id"]) and isset($_GET["event_id"])){
				$user_data["parade_id"] = $_GET["parade_id"];
				$user_data["event_id"] = $_GET["event_id"];
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

if(isset($_GET["add_user_id"]) and isset($_GET["event_id"]))	{
	include("connection.php");	
	$query = "INSERT INTO user_event (user_id, event_id, present) VALUES (" . $_GET["add_user_id"] . "," . $_GET["event_id"] . ",0);";
	//echo $query;
	$result = mysqli_query($con, $query);
}

if(isset($_GET["remove_user_id"]) and isset($_GET["event_id"]))	{
	include("connection.php");	
	$query = "DELETE FROM user_event WHERE user_id=" . $_GET["remove_user_id"] . " AND event_id=" . $_GET["event_id"]. ";";
	//echo $query;
	$result = mysqli_query($con, $query);
}

if(isset($_GET["search_first_name"]) != "" and isset($_GET["event_id"]) != ""){
	include("connection.php");
	//echo("search for first name");
	$first_name = $_GET["search_first_name"];
	$query = "SELECT users.first_name, users.last_name, users.rank, users.user_id FROM users WHERE first_name REGEXP '" . str_replace('"', "", $first_name) . "';";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		//print_r(mysqli_fetch_all($result));
		$output = "";
		while($cadet = mysqli_fetch_assoc($result)){
			//echo $output;
			if($output == ""){
				$output = "<script src=\"js/search.js\"></script><a onclick='resultHasBeenClicked(" . $cadet["user_id"] . ", " . $_GET["event_id"] . ")' name=" . $cadet["user_id"] . "href=>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}	else	{
				$output = $output . "<a onclick='resultHasBeenClicked(" . $cadet["user_id"] . ", " . $_GET["event_id"] . ")' name=" . $cadet["user_id"] . "href=>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}
		}
		echo $output;
		return $result;
	}	else{
		//their are no symalar names
		return "<a>no names match your prompt</a>";
	}
}

if(isset($_GET["search_first_name_delete"]) != "" and isset($_GET["event_id"]) != ""){
	include("connection.php");
	//echo("search for first name");
	$first_name = $_GET["search_first_name_delete"];
	$query = "SELECT users.first_name, users.last_name, users.rank, users.user_id FROM users, user_event WHERE users.first_name REGEXP '" . str_replace('"', "", $first_name) . "' AND user_event.user_id = users.user_id and user_event.event_id=" . $_GET["event_id"] . ";";
	$result = mysqli_query($con, $query);
	//echo($query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		//print_r(mysqli_fetch_all($result));
		//echo("hello");
		$output = "";
		while($cadet = mysqli_fetch_assoc($result)){
			//echo $output;
			if($output == ""){
				$output = "<script src=\"js/search.js\"></script><a onclick='resultHasBeenClickedDelete(" . $cadet["user_id"] . ", " . $_GET["event_id"] . ")' name=" . $cadet["user_id"] . "href=>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}	else	{
				$output = $output . "<a onclick='resultHasBeenClickedDelete(" . $cadet["user_id"] . ", " . $_GET["event_id"] . ")' name=" . $cadet["user_id"] . "href=>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}
		}
		echo $output;
		return $result;
	}	else{
		//their are no symalar names
		return "<a>no names match your prompt</a>";
	}
}