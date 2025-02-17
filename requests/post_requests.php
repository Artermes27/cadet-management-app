<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){//post methods for updating the database from add.php
	if(isset($_POST["add_new_user"]) and $_POST["add_new_user"] == "1"){
		include_once("../includes/connection.php");
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
		header("Location: ../add.php");
	}if(isset($_POST["add_new_equipment"]) and $_POST["add_new_equipment"] == "1"){
		include_once("../includes/connection.php");
		$query = "SELECT MAX(equipment_id) FROM equipment;";
		$result = mysqli_query($con, $query);
		$equipment_id = mysqli_fetch_assoc($result)["MAX(equipment_id)"] + 1;
		$name = $_POST["name"];
		$description = $_POST["description"];
		$location = $_POST["location"];
		$query = "INSERT INTO `equipment` (`equipment_id`, `name`, `description`, `location`) VALUES ('" . $equipment_id . "', '" . $name . "', '" . $description . "', '" . $location . "');";
		$result = mysqli_query($con, $query);
		header("Location: ../add.php");
	}if(isset($_POST["add_new_parade"]) and $_POST["add_new_parade"] == "1"){
		include_once("../includes/connection.php");
		$query = "SELECT MAX(parade_id) FROM parades;";
		$result = mysqli_query($con, $query);
		$parade_id = mysqli_fetch_assoc($result)["MAX(parade_id)"] + 1;
		$date = $_POST["date"];
		$start = $_POST["start"];
		$end = $_POST["end"];
		$parade_name = $_POST["parade_name"];
		$query = "INSERT INTO `parades` (`parade_id`, `date`, `start`, `end`, `parade_name`) VALUES ('" . $parade_id . "', '" . $date . "', '" . $start . "', '" . $end . "', '" . $parade_name . "');";
		$result = mysqli_query($con, $query);
		header("Location: ../add.php");
	}if(isset($_POST["add_new_event"]) and $_POST["add_new_event"] == "1"){
		$parade_id = $_POST["parade_id"];
		$event_type = $_POST["event_type"];
		$event_name = $_POST["event_name"];
		$event_start = $_POST["event_start"];
		$event_end = $_POST["event_end"];
		$owner = $_POST["owner_id"];
		include_once("../includes/connection.php");
		$query = "SELECT MAX(event_id) FROM events;";
		$result = mysqli_query($con, $query);
		$event_id = mysqli_fetch_assoc($result)["MAX(event_id)"] + 1;
		$query = "INSERT INTO `events` (`event_id`, `parade_id`, `event_type`, `event_name`, `event_start`, `event_end`, `owner`, `final_aproval`) VALUES ('" . $event_id . "', '" . $parade_id . "', '" . $event_type . "', '" . $event_name . "', '" . $event_start . "', '" . $event_end . "', '" . $owner . "', '0');";
		$result = mysqli_query($con, $query);
		header("Location: ../add.php");
	}if(isset($_POST["modify_user"]) and $_POST["modify_user"] == "1"){
		include_once("../includes/connection.php");
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
		header("Location: ../add.php");
	}if(isset($_POST["modify_equipment"]) and $_POST["modify_equipment"] == "1"){
		if($_POST["operation"] == "delete"){
			include_once("../includes/connection.php");
			$equipment_id = $_POST["modify_equipment_id"];
			$query = "DELETE FROM `equipment` WHERE `equipment`.`equipment_id` = " . $equipment_id . ";";
			$result = mysqli_query($con, $query);
			header("Location: ../add.php");
		}else{
			include_once("../includes/connection.php");
			$equipment_id = $_POST["modify_equipment_id"];
			$name = $_POST["modify_equipment_name"];
			$description = $_POST["modify_equipment_description"];
			$location = $_POST["modify_equipment_location"];
			$query = "UPDATE `equipment` SET `name` = '" . $name . "', `description` = '" . $description . "', `location` = '" . $location . "' WHERE `equipment`.`equipment_id` = " . $equipment_id . ";";
			$result = mysqli_query($con, $query);
			header("Location: ../add.php");
		}
    }if(isset($_POST["modify_register"]) and $_POST["modify_register"] == "1"){
		include_once("../includes/connection.php");
		$event_id = $_POST["event_id"];
		unset($_POST["event_id"]);
		$parade_id = $_POST["parade_id"];
		unset($_POST["parade_id"]);
		unset($_POST["modify_register"]);
		print_r($_POST);
		foreach ($_POST as $key => $value) {
			$query = "UPDATE user_event SET present = " . $value . " WHERE user_id = " . $key . " AND event_id = " . $event_id . "";
			echo($query);
			$result = mysqli_query($con, $query);
		}
		header("location: ../event.php?parade_id=" . $parade_id . "&event_id=" . $event_id);
	}if(isset($_POST["modify_equipment_register"]) and $_POST["modify_equipment_register"] == 1){
		include_once("../includes/connection.php");
		$event_id = $_POST["event_id"];
		unset($_POST["event_id"]);
		$parade_id = $_POST["parade_id"];
		unset($_POST["parade_id"]);
		unset($_POST["modify_equipment_register"]);
		foreach ($_POST as $key => $value) {
			$query = "UPDATE equipment_requests SET aproved = " . $value . " WHERE equipment_id = " . $key . " AND event_id = " . $event_id . "";
			$result = mysqli_query($con, $query);
		}
		header("location: ../event.php?parade_id=" . $parade_id . "&event_id=" . $event_id);
	}
}
?>