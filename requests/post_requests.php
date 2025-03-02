<?php

switch ($_POST["flag"]){
	case "add_new_parade";
		include_once("post_request_scanning.php");
		$date = post_request("date");
		$start = post_request("start");
		$end = post_request("end");
		$parade_name = post_request("parade_name");
		include_once("../includes/connection.php");
		$query = "SELECT MAX(parade_id) FROM parades;";
		$result = mysqli_query($con, $query);
		$parade_id = mysqli_fetch_assoc($result)["MAX(parade_id)"] + 1;
		$query = "INSERT INTO `parades` (`parade_id`, `date`, `start`, `end`, `parade_name`) VALUES ('" . $parade_id . "', '" . $date . "', '" . $start . "', '" . $end . "', '" . $parade_name . "');";
		$result = mysqli_query($con, $query);
		header("Location: ../add.php");
	case "add_new_event";
		include_once("post_request_scanning.php");
		$parade_id = post_request("parade_id");
		$event_type = post_request("event_type");
		$event_name = post_request("event_name");
		$event_start = post_request("event_start");
		$event_end = post_request("event_end");
		$owner = post_request("owner_id");
		include_once("../includes/connection.php");
		$query = "SELECT MAX(event_id) FROM events;";
		$result = mysqli_query($con, $query);
		$event_id = mysqli_fetch_assoc($result)["MAX(event_id)"] + 1;
		$query = "INSERT INTO `events` (`event_id`, `parade_id`, `event_type`, `event_name`, `event_start`, `event_end`, `owner`, `final_aproval`) VALUES ('" . $event_id . "', '" . $parade_id . "', '" . $event_type . "', '" . $event_name . "', '" . $event_start . "', '" . $event_end . "', '" . $owner . "', '0');";
		$result = mysqli_query($con, $query);
		header("Location: ../add.php");
	case "add_new_user";
		include_once("post_request_scanning.php");
		$email = post_request("email");
		$password = post_request("password");
		$first_name = post_request("first_name");
		$last_name = post_request("last_name");
		$DOB = post_request("DOB");
		$gender = post_request("gender");
		$rank = post_request("rank");
		$active = post_request("active");
		$admin = post_request("admin");
		$G4 = post_request("G4");
		include_once("../includes/connection.php");
		$query = "SELECT MAX(user_id) FROM users;";
		$result = mysqli_query($con, $query);
		$user_id = mysqli_fetch_assoc($result)["MAX(user_id)"] + 1;
		$query = "INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `DOB`, `gender`, `rank`, `active`, `admin`, `G4`) VALUES ('" . $user_id . "', '" . $email . "', '" . hash("sha256", $password) . "', '" . $first_name . "', '" . $last_name . "', '" . $DOB . "', '" . $gender . "', '" . $rank . "', " . $active . ", " . $admin . ", " . $G4 . ");";
		$result = mysqli_query($con, $query);
		header("Location: ../add.php");
	case "modify_user";
		include_once("post_request_scanning.php");
		$user_id = post_request("modify_user_id");
		$email = post_request("modify_email");
		$first_name = post_request("modify_first_name");
		$last_name = post_request("modify_last_name");
		$DOB = post_request("modify_DOB");
		$gender = post_request("modify_gender");
		$rank = post_request("modify_rank");
		$active = post_request("modify_active");
		$admin = post_request("modify_admin");
		$G4 = post_request("modify_G4");
		include_once("../includes/connection.php");
		if(isset($_POST["modify_password"])){
			$password = post_request("modify_password");
			$query = "UPDATE `users` SET `email` = '" . $email . "', `password` = '" . hash("sha256", $password) . "', `first_name` = '" . $first_name . "', `last_name` = '" . $last_name . "', `DOB` = '" . $DOB . "', `gender` = '" . $gender . "', `rank` = '" . $rank . "', `active` = " . $active . ", `admin` = " . $admin . ", `G4` = " . $G4 . " WHERE `users`.`user_id` = " . $user_id . ";";
			$result = mysqli_query($con, $query);
		}else{
			$query = "UPDATE `users` SET `email` = '" . $email . "', `first_name` = '" . $first_name . "', `last_name` = '" . $last_name . "', `DOB` = '" . $DOB . "', `gender` = '" . $gender . "', `rank` = '" . $rank . "', `active` = " . $active . ", `admin` = " . $admin . ", `G4` = " . $G4 . " WHERE `users`.`user_id` = " . $user_id . ";";
			$result = mysqli_query($con, $query);
		}
		header("Location: ../add.php");
	case "add_new_equipment";
		include_once("post_request_scanning.php");
		$equipment_id = post_request("equipment_id");
		$name = post_request("name");
		$description = post_request("description");
		$location = post_request("location");
		include_once("../includes/connection.php");
		$query = "SELECT MAX(equipment_id) FROM equipment;";
		$result = mysqli_query($con, $query);
		$equipment_id = mysqli_fetch_assoc($result)["MAX(equipment_id)"] + 1;
		$query = "INSERT INTO `equipment` (`equipment_id`, `name`, `description`, `location`) VALUES ('" . $equipment_id . "', '" . $name . "', '" . $description . "', '" . $location . "');";
		$result = mysqli_query($con, $query);
		header("Location: ../add.php");

	case "modify_equipment";
		if($_POST["operation"] == "delete"){
			include_once("post_request_scanning.php");
			$equipment_id = post_request("modify_equipment_id");
			include_once("../includes/connection.php");
			$query = "DELETE FROM `equipment` WHERE `equipment`.`equipment_id` = " . $equipment_id . ";";
			$result = mysqli_query($con, $query);
			header("Location: ../add.php");
		}else{
			include_once("post_request_scanning.php");
			$equipment_id = post_request("modify_equipment_id");
			$name = post_request("modify_equipment_name");
			$description = post_request("modify_equipment_description");
			$location = post_request("modify_equipment_location");
			include_once("../includes/connection.php");
			$query = "UPDATE `equipment` SET `name` = '" . $name . "', `description` = '" . $description . "', `location` = '" . $location . "' WHERE `equipment`.`equipment_id` = " . $equipment_id . ";";
			$result = mysqli_query($con, $query);
			header("Location: ../add.php");
		}
	case "modify_register";
		include_once("post_request_scanning.php");
		$event_id = post_request("event_id");
		unset($_POST["event_id"]);
		$parade_id = post_request("parade_id");
		unset($_POST["parade_id"]);
		unset($_POST["modify_register"]);
		include_once("../includes/connection.php");
		foreach ($_POST as $key => $value) {
			$query = "UPDATE user_event SET present = " . $value . " WHERE user_id = " . $key . " AND event_id = " . $event_id . "";
			echo($query);
			$result = mysqli_query($con, $query);
		}
		header("location: ../event.php?parade_id=" . $parade_id . "&event_id=" . $event_id);
	case "modify_equipment_register";
		include_once("post_request_scanning.php");
		$event_id = post_request("event_id");
		unset($_POST["event_id"]);
		$parade_id = post_request("parade_id");
		unset($_POST["parade_id"]);
		unset($_POST["modify_equipment_register"]);
		include_once("../includes/connection.php");
		foreach ($_POST as $key => $value) {
			$query = "UPDATE equipment_requests SET aproved = " . $value . " WHERE equipment_id = " . $key . " AND event_id = " . $event_id . "";
			$result = mysqli_query($con, $query);
		}
		header("location: ../event.php?parade_id=" . $parade_id . "&event_id=" . $event_id);
}
?>