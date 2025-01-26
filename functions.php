<?php

function check_login($con){

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

function get_id(){
	return $_SESSION['user_id'];
}

function get_rank($con, $id){
	$query = "SELECT * FROM users Where user_id = '$id' limit 1;";
	$result = mysqli_query($con, $query);
	
	if(mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_assoc($result)["rank"];
	}
}

function get_latest_parade($con)	{//get latest parade for next parade date sugestion on add.php
	$query = "SELECT date FROM parades ORDER BY date DESC LIMIT 1;";
	$result = mysqli_query($con, $query);
	
	if(mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_assoc($result)["date"];
	}
}

function get_parade_date_range($con, $current_date)	{//retreving the next 5 parade dates
	include("connection.php");
	$query = "SELECT date FROM parades WHERE date >= '$current_date' ORDER BY date ASC limit 5;";
	//echo($query);
	$result = mysqli_query($con, $query);
	$dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (count($dates) < 5)  {
		$end_date = $dates[count($dates)-1]["date"];
		while(count($dates) < 5) {
			$dates[] = ["date" => "no parades beyond this date"];
		}
	} else {
		$end_date = $dates[count($dates)-1]["date"];
	}
	return [$dates, $end_date];
}

function date_skip_method($con, $current_date, $skip){//retreving the dates for the skip buttons on calendar.php
	if($skip == "-1"){
		include("connection.php");
		$query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date DESC limit 1;";
		//echo($query);
		$result = mysqli_query($con, $query);
		$dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if (count($dates) == 0)  {
			return "null";
		} else {
		return $dates[0]["date"];
		}
	}if($skip == "+1"){
		include("connection.php");
		$query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 1;";
		//echo($query);
		$result = mysqli_query($con, $query);
		$dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if (count($dates) == 0)  {
			return "null";
		} else {
		return $dates[0]["date"];
		}
	}if($skip == "-5"){
		include("connection.php");
		$query = "SELECT date FROM parades WHERE date < '$current_date' ORDER BY date ASC limit 5;";
		//echo($query);
		$result = mysqli_query($con, $query);
		$dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if(mysqli_num_rows($result) == 0){
			return "null";
		} else {
			return $dates[0]["date"];
		}
	}if($skip == "+5"){
		include("connection.php");
		$query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 5;";
		//echo($query);
		$result = mysqli_query($con, $query);
		$dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if(mysqli_num_rows($result) == 0){
			return "null";
		} else {
			return $dates[count($dates)-1]["date"];
		}
	}if($skip == "-4"){
		include("connection.php");
		$query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 4;";
		//echo($query);
		$result = mysqli_query($con, $query);
		$dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if(mysqli_num_rows($result) == 0){
			return "null";
		} else {
			return $dates[0]["date"];
		}
	}if($skip == "+4"){
		include("connection.php");
		$query = "SELECT date FROM parades WHERE date > '$current_date' ORDER BY date ASC limit 4;";
		//echo($query);
		$result = mysqli_query($con, $query);
		$dates = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if(mysqli_num_rows($result) == 0){
			return "null";
		} else {
			return $dates[count($dates)-1]["date"];
		}
	}
}

function html_for_parade_on_callendar($con, $parade_date, $user_data){//echo the HTML for the parade on the calendar
	$query = "SELECT parade_id FROM parades WHERE date = '$parade_date';";
	$result = mysqli_query($con, $query);
	$parade = mysqli_fetch_assoc($result);
	$parade_id = $parade["parade_id"];
	$query = "SELECT events.* FROM events, user_event WHERE parade_id = $parade_id and events.event_id = user_event.event_id and user_event.user_id = " . $user_data["user_id"] . " ORDER BY events.event_start;";
	$result = mysqli_query($con, $query);
	$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$event_count = 0;
	$event_html = "<div class=\"event\"><h2>" . $parade_date . "</h2></div>";
	if(count($events) == 0){//the user has no events on this parade night
		$event_html = $event_html . "<div class=\"event\"><a>you have no events on this parade night</a></div>";
	}else{//the user has events on this parade night
		while($event_count < count($events)){
			//giving the owner the option to modify their event
			if($user_data["user_id"] == $events[$event_count]["owner"] or $user_data["admin"] == 1){
				$event_html = $event_html . "<div class=\"event\"><a>" . $events[$event_count]["event_start"] .  " till " . $events[$event_count]["event_end"] . "</a><br><a href=\"event.php?parade_id=" . $parade_id . "&event_id=" . $events[$event_count]["event_id"] . "\">" .  $events[$event_count]["event_name"] . "</a></div>";
			} else {//non owner so they can only view the event
				$event_html = $event_html . "<div class=\"event\"><a>" . $events[$event_count]["event_start"] .  " till " . $events[$event_count]["event_end"] . "</a><br><a>" . $events[$event_count]["event_name"] . "</a></div>";
			}
			$event_count = $event_count + 1;
		}
	}
	return $event_html;
}

if(isset($_GET["add_user_id"]) and isset($_GET["event_id"])){//search method for adding a user to an event used by search.js for searching for user by first name on event.php
	include("connection.php");	
	$query = "INSERT INTO user_event (user_id, event_id, present) VALUES (" . $_GET["add_user_id"] . "," . $_GET["event_id"] . ",0);";
	//echo $query;
	$result = mysqli_query($con, $query);
}

if(isset($_GET["remove_user_id"]) and isset($_GET["event_id"])){//search method for removing a user from an event used by search.js for searching for user by first name on event.php
	include("connection.php");	
	$query = "DELETE FROM user_event WHERE user_id=" . $_GET["remove_user_id"] . " AND event_id=" . $_GET["event_id"]. ";";
	//echo $query;
	$result = mysqli_query($con, $query);
}

if(isset($_GET["search_first_name"]) != "" and isset($_GET["event_id"]) != ""){//search method for adding a user to an event used by add.js for searching for user by first name on event.php
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

if(isset($_GET["search_first_name_delete"]) != "" and isset($_GET["event_id"]) != ""){//search method for removing a user from an event used by search.js for searching for user by first name on event.php
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

if(isset($_GET["search_first_name_owner"])){//search method for creating an event used by add.js for searching for user by first name
	$name = $_GET["search_first_name_owner"];
	include("connection.php");
	$query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE first_name REGEXP '" . str_replace('"', "", $name) . "';";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		//print_r(mysqli_fetch_all($result));
		$output = "";
		while($cadet = mysqli_fetch_assoc($result)){
			//echo $output;
			if($output == ""){
				$output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedOwner(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}	else	{
				$output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedOwner(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}
		}
		echo $output;
		return $result;
	}	else{
		//their are no symalar names
		return "<a>no names match your prompt</a>";
	}
}

if(isset($_GET["search_first_name_user"])){//search method for user's first name used by add.js for searching for user by first name
	$name = $_GET["search_first_name_user"];
	include("connection.php");
	$query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE first_name REGEXP '" . str_replace('"', "", $name) . "';";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		//print_r(mysqli_fetch_all($result));
		$output = "";
		while($cadet = mysqli_fetch_assoc($result)){
			//echo $output;
			if($output == ""){
				$output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}	else	{
				$output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}
		}
		echo $output;
		return $result;
	}	else{
		//their are no symalar names
		return "<a>no names match your prompt</a>";
	}
}

if(isset($_GET["search_last_name_user"])){//search method for user's last name used by add.js for searching for user by last name
	$name = $_GET["search_last_name_user"];
	include("connection.php");
	$query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE last_name REGEXP '" . str_replace('"', "", $name) . "';";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		//print_r(mysqli_fetch_all($result));
		$output = "";
		while($cadet = mysqli_fetch_assoc($result)){
			//echo $output;
			if($output == ""){
				$output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}	else	{
				$output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
			}
		}
		echo $output;
		return $result;
	}	else{
		//their are no symalar names
		return "<a>no names match your prompt</a>";
	}
}

if(isset($_GET["search_equipment_name"])){//search method for equipment name used by add.js for searching for equipment by name
	$name = $_GET["search_equipment_name"];
	include("connection.php");
	$query = "SELECT * FROM equipment WHERE name REGEXP '" . str_replace('"', "", $name) . "';";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		//print_r(mysqli_fetch_all($result));
		$output = "";
		while($equipment = mysqli_fetch_assoc($result)){
			//echo $output;
			if($output == ""){
				$output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
			}	else	{
				$output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
			}
		}
		echo $output;
	}	else{
		//their are no symalar names
		echo("<a>no names match your prompt</a>");
	}
}

if(isset($_GET["search_equipment_location"])){//search method used by add.js for searching for equipment by location
	$name = $_GET["search_equipment_location"];
	include("connection.php");
	$query = "SELECT * FROM equipment WHERE location REGEXP '" . str_replace('"', "", $name) . "';";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		//print_r(mysqli_fetch_all($result));
		$output = "";
		while($equipment = mysqli_fetch_assoc($result)){
			//echo $output;
			if($output == ""){
				$output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
			}	else	{
				$output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
			}
		}
		echo $output;
	}	else{
		//their are no symalar names
		echo("<a>no locations match your prompt</a>");
	}
}

if(isset($_GET["equipment_id_info_dump"])){//retreve all information about a piece of equipment from its id used by add.php to populate the modify equipment form
	include("connection.php");
	$query = "SELECT * FROM equipment WHERE equipment_id = " . $_GET["equipment_id_info_dump"] . ";";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		$equipment = mysqli_fetch_assoc($result);
		echo json_encode($equipment);
	} else {
		return json_encode(["message" => "no names match your prompt"]);
	}
}

if(isset($_GET["user_id_info_dump"])){//retreve all user data for a user_id used by add.php to populate the modify user form
	include("connection.php");
	$query = "SELECT * FROM users WHERE user_id = " . $_GET["user_id_info_dump"] . ";";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		$cadet = mysqli_fetch_assoc($result);
		$cadet["password"] = "";
		echo json_encode($cadet);
	} else {
		return json_encode(["message" => "no names match your prompt"]);
	}
}

if($_SERVER["REQUEST_METHOD"] == "POST"){//post methods for updating the database from add.php
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
		$query = "SELECT parade_id FROM parades WHERE date = '" . $_POST["parade_date"] . "';";
		echo($query);
		$result = mysqli_query($con, $query);
		$parade_id = mysqli_fetch_assoc($result)["parade_id"];
		$event_type = $_POST["event_type"];
		$event_name = $_POST["event_name"];
		$event_start = $_POST["event_start"];
		$event_end = $_POST["event_end"];
		$request_equipment_id = $event_id;
		$owner_id = $_POST["owner_id"];
		$query = "INSERT INTO `events` (`event_id`, `parade_id`, `event_type`, `event_name`, `event_start`, `event_end`, `request_equipment_id`, `final_aproval`, `owner`) VALUES (" . $event_id . ", " . $parade_id . ", '" . $event_type . "', '" . $event_name . "', '" . $event_start . "', '" . $event_end . "', '" . $request_equipment_id . "', 0, " . $owner_id . ");";
		echo($query);
		$result = mysqli_query($con, $query);
		header("Location: add.php");
	}if(isset($_POST["modify_user"]) and $_POST["modify_user"] == "1"){
		include("connection.php");
		echo("modify user process");
		$user_id = $_POST["modify_user_id"];
		$email = $_POST["modify_email"];
		$first_name = $_POST["modify_first_name"];
		$last_name = $_POST["modify_last_name"];
		$DOB = $_POST["modify_DOB"];
		$gender = $_POST["modify_gender"];
		$rank = $_POST["modify_rank"];
		$active = $_POST["modify_active"];
		$admin = $_POST["modify_admin"];
		if(isset($_POST["modify_password"])){
			$password = $_POST["modify_password"];
			$query = "UPDATE `users` SET `email` = '" . $email . "', `password` = '" . hash("sha256", $password) . "', `first_name` = '" . $first_name . "', `last_name` = '" . $last_name . "', `DOB` = '" . $DOB . "', `gender` = '" . $gender . "', `rank` = '" . $rank . "', `active` = " . $active . ", `admin` = " . $admin . " WHERE `users`.`user_id` = " . $user_id . ";";
			$result = mysqli_query($con, $query);
		}else{
			$query = "UPDATE `users` SET `email` = '" . $email . "', `first_name` = '" . $first_name . "', `last_name` = '" . $last_name . "', `DOB` = '" . $DOB . "', `gender` = '" . $gender . "', `rank` = '" . $rank . "', `active` = " . $active . ", `admin` = " . $admin . " WHERE `users`.`user_id` = " . $user_id . ";";
			$result = mysqli_query($con, $query);
		}
		header("Location: add.php");
	}if(isset($_POST["modify_equipment"]) and $_POST["modify_equipment"] == "1"){
		if($_POST["operation"] == "delete"){
			include("connection.php");
			echo("delete equipment process");
			$equipment_id = $_POST["modify_equipment_id"];
			$query = "DELETE FROM `equipment` WHERE `equipment`.`equipment_id` = " . $equipment_id . ";";
			echo($query);
			$result = mysqli_query($con, $query);
			header("Location: add.php");
		}else{
			include("connection.php");
			echo("modify equipment process");
			$equipment_id = $_POST["modify_equipment_id"];
			$name = $_POST["modify_equipment_name"];
			$description = $_POST["modify_equipment_description"];
			$location = $_POST["modify_equipment_location"];
			$query = "UPDATE `equipment` SET `name` = '" . $name . "', `description` = '" . $description . "', `location` = '" . $location . "' WHERE `equipment`.`equipment_id` = " . $equipment_id . ";";
			echo($query);
			$result = mysqli_query($con, $query);
			header("Location: add.php");
		}
	}
}