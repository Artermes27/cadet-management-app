<?php
if(isset($_GET["search_first_name_owner"])){//search method for creating an event used by add.js for searching for user by first name
    $name = $_GET["search_first_name_owner"];
    include_once("connection.php");
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
        echo "<a>no names match your prompt</a>";
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["modify_event_details"]) and $_POST["modify_event_details"] == "1"){
		include_once("connection.php");
		$parade_id = $_POST["parade_id"];
		$event_id = $_POST["event_id"];
		$event_type = $_POST["event_type"];
		$event_name = $_POST["event_name"];
		$event_start = $_POST["event_start"];
		$event_end = $_POST["event_end"];
		$owner = $_POST["owner_id"];
		$final_aproval = $_POST["final_aproval"];
		$query = "UPDATE events SET event_type = '" . $event_type . "', event_name = '" . $event_name . "', event_start = '" . $event_start . "', event_end = '" . $event_end . "', owner = " . $owner . ", final_aproval = " . $final_aproval . " WHERE event_id = " . $event_id;
		echo($query);
		$result = mysqli_query($con, $query);
		if($_POST["user_id"] == $owner){
			header("location: event.php?parade_id=" . $parade_id . "&event_id=" . $event_id);
		}else{
			header("location: calendar.php");
		}
	}if(isset($_POST["delete_event"]) and $_POST["delete_event"] == "1"){
		include_once("connection.php");
		$parade_id = $_POST["delete_parade_id"];
		$event_id = $_POST["delete_event_id"];
		$query = "DELETE FROM user_event WHERE event_id = " . $event_id;
		$result = mysqli_query($con, $query);
		$query = "DELETE FROM events WHERE event_id = " . $event_id;
		$result = mysqli_query($con, $query);
		header("location: calendar.php");
    }
}
?>