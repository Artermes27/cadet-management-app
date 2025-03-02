<?php
if (isset($_GET["flag"])){
	include_once("get_request_scanning.php");
	switch (get_request("flag")){
		case "add_user_id";
			include_once("../includes/connection.php");	
			$query = "INSERT INTO user_event (user_id, event_id, present) VALUES (" . get_request("add_user_id") . "," . get_request("event_id") . ",0);";
			mysqli_query($con, $query);
		case "remove_user_id";
			include_once("../includes/connection.php");	
			$query = "DELETE FROM user_event WHERE user_id=" . get_request("remove_user_id") . " AND event_id=" . get_request("event_id") . ";";
			mysqli_query($con, $query);
		case "add_equipment_id";
			include_once("../includes/connection.php");
			$query = "SELECT equipment_id FROM equipment_requests WHERE equipment_id=" . get_request("add_equipment_id") . " AND event_id=" . get_request("event_id") . ";";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0){
				$query = "UPDATE equipment_requests SET aproved=0 WHERE equipment_id=" . get_request("add_equipment_id") . " AND event_id=" . get_request("event_id") . ";";
			} else {
				$query = "INSERT INTO equipment_requests (equipment_id, event_id, aproved) VALUES (" . get_request("add_equipment_id") . "," . get_request("event_id") . ",0);";
			}
			mysqli_query($con, $query);
		case "remove_equipment_id";
			include_once("../includes/connection.php");
			$query = "DELETE FROM equipment_requests WHERE equipment_id=" . get_request("remove_equipment_id") . " AND event_id=" . get_request("event_id") . ";";
			mysqli_query($con, $query);
		case "search_first_name";
			$search_first_name = get_request("prompt");
			$event_id = get_request("event_id");
			include_once("../includes/connection.php");
			$query = "SELECT event_id, parade_id, event_start, event_end FROM events WHERE event_id = " . $event_id . ";";
			$result = mysqli_query($con, $query);
			$event = mysqli_fetch_assoc($result);
			$query = "SELECT users.first_name, users.last_name, users.rank, users.user_id
			FROM users 
			WHERE users.user_id NOT IN 
			(SELECT user_event.user_id FROM user_event, events 
			WHERE user_event.event_id = events.event_id 
			AND events.parade_id = " . $event["parade_id"] . "
			AND ((events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_start"] . "')
			OR (events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start > '" . $event["event_start"] . "' AND events.event_end < '" . $event["event_end"] . "')
			OR (events.event_start < '" . $event["event_end"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start = '" . $event["event_start"] . "' AND events.event_end = '" . $event["event_end"] . "')
			OR (events.event_id = " . $event["event_id"] . "))) 
			AND users.first_name REGEXP '" . str_replace('"', "", $search_first_name) . "';";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0)	{
				$output_html = "";
				while($cadet = mysqli_fetch_assoc($result)){
					$output_html .= "<a onclick='resultHasBeenClickedAdd(" . $cadet["user_id"] . ", " . $event_id . ")'>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
				}
				echo $output_html;
			}	else{
				echo "<a>no names match your prompt</a>";
			}
			break;
		case "search_first_name_delete";
			$first_name = get_request("prompt");
			$event_id = get_request("event_id");
			include_once("../includes/connection.php");
			$query = "SELECT users.first_name, users.last_name, users.rank, users.user_id FROM users WHERE users.user_id IN (SELECT user_event.user_id FROM user_event WHERE user_event.event_id = " . $event_id . ") AND users.first_name REGEXP '" . str_replace('"', "", $first_name) . "';";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0)	{
				$output_html = "";
				while($cadet = mysqli_fetch_assoc($result)){
					$output_html .= "<script src=\"js/search.js\"></script><a onclick='resultHasBeenClickedDelete(" . $cadet["user_id"] . ", " . $event_id . ")' name=" . $cadet["user_id"] . "href=>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
				}
				echo $output_html;
			}	else{
				echo "<a>no names match your prompt</a>";
			}
			break;
		case "search_first_name_other_cadet";
			$first_name = get_request("prompt");
			$event_id = get_request("event_id");
			include_once("../includes/connection.php");
			$query = "SELECT events.event_start, events.event_end, events.parade_id FROM events WHERE events.event_id = " . $event_id . ";";
			$result = mysqli_query($con, $query);
			$event = mysqli_fetch_assoc($result);
			$query = "SELECT users.first_name, users.last_name, users.rank, events.event_start, events.event_end, events.event_name, events.owner 
			FROM users, user_event, events 
			WHERE users.user_id = user_event.user_id 
			AND user_event.event_id = events.event_id
			AND events.parade_id = " . $event["parade_id"] . " 
			AND users.first_name REGEXP '" . str_replace('"', "", $first_name) . "' 
			AND events.event_id IN (
			SELECT events.event_id 
			FROM user_event, events 
			WHERE user_event.event_id = events.event_id 
			AND ((events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_start"] . "')
			OR (events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start > '" . $event["event_start"] . "' AND events.event_end < '" . $event["event_end"] . "')
			OR (events.event_start < '" . $event["event_end"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start = '" . $event["event_start"] . "' AND events.event_end = '" . $event["event_end"] . "')));";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0)	{
				$output_html = "";
				while($cadet = mysqli_fetch_assoc($result)){
					$output_html .= "<a>" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . " | " . $cadet["event_name"] . " " . $cadet["event_start"] . " " . $cadet["event_end"] . "</a><br>";
				}
				echo $output_html;
			}	else{
				echo "<a>no names match your prompt</a>";
			}
			break;
		case "search_equipment_add";
			$equipment_name = get_request("prompt");
			$event_id = get_request("event_id");
			include_once("../includes/connection.php");
			$query = "SELECT event_id, parade_id, event_start, event_end FROM events WHERE event_id = " . $event_id . ";";
			$result = mysqli_query($con, $query);
			$event = mysqli_fetch_assoc($result);
			$query = "SELECT equipment.equipment_id, equipment.name
			FROM equipment
			WHERE equipment.equipment_id NOT IN 
			(SELECT equipment_requests.equipment_id 
			FROM equipment_requests, events 
			WHERE events.event_id = equipment_requests.event_id
			AND events.parade_id = " . $event["parade_id"] . "
			AND equipment_requests.aproved != 2
			AND ((events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_start"] . "')
			OR (events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start > '" . $event["event_start"] . "' AND events.event_end < '" . $event["event_end"] . "')
			OR (events.event_start < '" . $event["event_end"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start = '" . $event["event_start"] . "' AND events.event_end = '" . $event["event_end"] . "')
			OR (events.event_id = " . $event["event_id"] . "))) 
			AND equipment.name REGEXP '" . str_replace('"', "", $equipment_name) . "';";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0){
				$output_html = "";
				while($equipment = mysqli_fetch_assoc($result)){
					$output_html .= "<a onclick=\"resultHasBeenClickedAddEquipment('" . $equipment["equipment_id"] . "', '" . $event_id . "')\">" . $equipment["name"] . "</a><br>";
				}
				echo $output_html;
			}else{
				echo "<a>no equipment matches your prompt</a>";
			}
			break;
		case "search_equipment_delete";
			$equipment_name = get_request("prompt");
			$event_id = get_request("event_id");
			include_once("../includes/connection.php");
			$query = "SELECT equipment.equipment_id, equipment.name FROM equipment WHERE equipment.equipment_id IN (SELECT equipment_requests.equipment_id FROM equipment_requests WHERE equipment_requests.event_id = " . $event_id . " AND equipment_requests.aproved != 2 ) AND equipment.name REGEXP '" . str_replace('"', "", $equipment_name) . "';";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0) {
				$output_html = "";
				while($equipment = mysqli_fetch_assoc($result)) {
					$output_html .= "<a onclick='resultHasBeenClickedDeleteEquipment(" . $equipment["equipment_id"] . ", " . $event_id . ")'>" . $equipment["name"] . "</a><br>";
				}
				echo $output_html;
			} else {
				echo "<a>no equipment matches your prompt</a>";
			}
			break;
		case "search_equipment_other";
			$equipment_name = get_request("prompt");
			$event_id = get_request("event_id");
			include_once("../includes/connection.php");
			$query = "SELECT events.event_start, events.event_end, events.parade_id FROM events WHERE events.event_id = " . $event_id . ";";
			$result = mysqli_query($con, $query);
			$event = mysqli_fetch_assoc($result);
			$query = "SELECT equipment.equipment_id, equipment.name, events.event_start, events.event_end, events.event_name 
			FROM equipment, equipment_requests, events 
			WHERE equipment.equipment_id = equipment_requests.equipment_id 
			AND equipment_requests.event_id = events.event_id
			AND events.event_end != '" . $event["event_start"] . "'
			AND events.event_start != '" . $event["event_end"] . "'
			AND events.parade_id = " . $event["parade_id"] . " 
			AND events.event_id != '" . $event_id . "'
			AND equipment.name REGEXP '" . str_replace('"', "", $equipment_name) . "' 
			AND equipment.equipment_id IN (
			SELECT equipment_requests.equipment_id 
			FROM equipment_requests, events 
			WHERE equipment_requests.event_id = events.event_id 
			AND equipment_requests.aproved = 1
			AND ((events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_start"] . "')
			OR (events.event_start < '" . $event["event_start"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start > '" . $event["event_start"] . "' AND events.event_end < '" . $event["event_end"] . "')
			OR (events.event_start < '" . $event["event_end"] . "' AND events.event_end > '" . $event["event_end"] . "')
			OR (events.event_start = '" . $event["event_start"] . "' AND events.event_end = '" . $event["event_end"] . "')
			OR (events.event_id != '" . $event_id . "')));";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0) {
				$output_html = "";
				while($equipment = mysqli_fetch_assoc($result)) {
					$output_html .= "<a>" . $equipment["name"] . " " . $equipment["event_name"] . " " . $equipment["event_start"] . " " . $equipment["event_end"] . "</a><br>";
				}
				echo $output_html;
			} else {
				echo "<a>no equipment matches your prompt</a>";
			}
			break;
	}
}
?>