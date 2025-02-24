<?php
if(isset($_GET["search_first_name_owner"])){
	include_once("get_request_scanning.php");
	$name = get_request("search_first_name_owner");
    include_once("../includes/connection.php");
    $query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE first_name REGEXP '" . str_replace('"', "", $name) . "';";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)	{
        //their are names symalar
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
    }	else{
        //their are no symalar names
        echo "<a>no names match your prompt</a>";
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["modify_event_details"]) and $_POST["modify_event_details"] == "1"){
		include_once("post_request_scanning.php");
		$parade_id = post_request("parade_id");
		$event_id = post_request("event_id");
		$event_type = post_request("event_type");
		$event_name = post_request("event_name");
		$event_start = post_request("event_start");
		$event_end = post_request("event_end");
		$owner = post_request("owner_id");
		$final_aproval = post_request("final_aproval");
		include_once("../includes/connection.php");
		$query = "UPDATE events SET event_type = '" . $event_type . "', event_name = '" . $event_name . "', event_start = '" . $event_start . "', event_end = '" . $event_end . "', owner = " . $owner . ", final_aproval = " . $final_aproval . " WHERE event_id = " . $event_id;
		$result = mysqli_query($con, $query);
		session_start();
		include_once("../includes/functions.php");
		$user_data = check_login($con);
		if((post_request("user_id") == $owner or $user_data["admin"] == 1) and $_POST["calendar_flag"] == 0){
			header("location: ../event.php?parade_id=" . $parade_id . "&event_id=" . $event_id);
		}else{
			header("location: ../calendar.php");
		}
	}if(isset($_POST["delete_event"]) and $_POST["delete_event"] == "1"){
		include_once("post_request_scanning.php");
		$parade_id = post_request("delete_parade_id");
		$event_id = post_request("delete_event_id");
		include_once("../includes/connection.php");
		//removing constraints from user_event
		$query = "DELETE FROM user_event WHERE event_id = " . $event_id;
		mysqli_query($con, $query);
		//removing constraints from equipment_requests
		$query = "DELETE FROM equipment_requests WHERE event_id = " . $event_id;
		mysqli_query($con, $query);
		//deleteing the event
		$query = "DELETE FROM events WHERE event_id = " . $event_id;
		mysqli_query($con, $query);
		header("location: ../calendar.php");
    }
}
?>