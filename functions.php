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

function get_latest_parade($con)	{
	$query = "SELECT date FROM parades ORDER BY date DESC LIMIT 1;";
	$result = mysqli_query($con, $query);
	
	if(mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_assoc($result)["date"];
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

if($_SERVER["REQUEST_METHOD"] == "POST"){
	var_dump($_POST);
	if(isset($_POST["add_new_user"]) and $_POST["add_new_user"] == "1"){
		include("connection.php");
		echo("add new user process");
		$query = "SELECT MAX(user_id) FROM users;";
		$result = mysqli_query($con, $query);
		$user_id = mysqli_fetch_assoc($result)["MAX(user_id)"] + 1;
		$email = $_POST["email"];
		$password = $_POST["password"];
		$first_name = $_POST["first_name"];
		$last_name = $_POST["last_name"];
		$DOB = $_POST["DOB"];
		$gender = $_POST["gender"];
		$rank = $_POST["rank"];
		$active = $_POST["active"];
		$admin = $_POST["admin"];
		$query = "INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `DOB`, `gender`, `rank`, `active`, `admin`) VALUES ('" . $user_id . "', '" . $email . "', '" . hash("sha256", $password) . "', '" . $first_name . "', '" . $last_name . "', '" . $DOB . "', '" . $gender . "', '" . $rank . "', " . $active . ", " . $admin . ");";
		$result = mysqli_query($con, $query);
		header("Location: add.php");
	}if(isset($_POST["add_new_equipment"]) and $_POST["add_new_equipment"] == "1"){
		include("connection.php");
		echo("add new equipment process");
		$query = "SELECT MAX(equipment_id) FROM equipment;";
		$result = mysqli_query($con, $query);
		$equipment_id = mysqli_fetch_assoc($result)["MAX(equipment_id)"] + 1;
		$name = $_POST["name"];
		$description = $_POST["description"];
		$location = $_POST["location"];
		$query = "INSERT INTO `equipment` (`equipment_id`, `name`, `description`, `location`) VALUES ('" . $equipment_id . "', '" . $name . "', '" . $description . "', '" . $location . "');";
		echo($query);
		$result = mysqli_query($con, $query);
		header("Location: add.php");
	}if(isset($_POST["add_new_parade"]) and $_POST["add_new_parade"] == "1"){
		include("connection.php");
		echo("add new parade process");
		$query = "SELECT MAX(parade_id) FROM parades;";
		$result = mysqli_query($con, $query);
		$parade_id = mysqli_fetch_assoc($result)["MAX(parade_id)"] + 1;
		$date = $_POST["date"];
		$start = $_POST["start"];
		$end = $_POST["end"];
		$query = "INSERT INTO `parades` (`parade_id`, `date`, `start`, `end`) VALUES ('" . $parade_id . "', '" . $date . "', '" . $start . "', '" . $end . "');";
		$result = mysqli_query($con, $query);
		echo($query);
		header("Location: add.php");
	}if(isset($_POST["add_new_event"]) and $_POST["add_new_event"] == "1"){
		include("connection.php");
		echo("add new event process");
		$query = "SELECT MAX(event_id) FROM events;";
		$result = mysqli_query($con, $query);
		$event_id = mysqli_fetch_assoc($result)["MAX(event_id)"] + 1;
		$event_type = $_POST["event_type"];
		$event_name = $_POST["event_name"];
		$event_start = $_POST["event_start"];
		$event_end = $_POST["event_end"];
		$request_equipment_id = $event_id; 
		$query = "INSERT INTO `events` (`event_id`, `parade_id`, `event_type`, `event_name`, `event_start`, `event_end`, `request_equipment_id`l, `final_aproval`, `owner`) VALUES ('" . $event_id . "', '" . $event_type . "', '" . $event_name . "', '" . $event_start . "', '" . $event_end . "');";
		$result = mysqli_query($con, $query);
		header("Location: add.php");
	}
}