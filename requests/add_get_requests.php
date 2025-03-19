<?php

use Dom\Mysql;

if (isset($_GET["flag"])){
    include_once("get_request_scanning.php");
    switch (get_request("flag")){
        case "search_parade_name";
            $parade_name = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT parade_id, date, parade_name FROM parades WHERE parade_name REGEXP '" . str_replace('"', "", $parade_name) . "';";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)	{
                $output = "";
                while($parade = mysqli_fetch_assoc($result)){
                    $output .= "<a style=\"background-color:#ddd;\" onclick=\"ResultHasBeenClickedParade('" . $parade["parade_id"] . "', '" . $parade["date"] . "', '" . $parade["parade_name"] . "')\">" . $parade["parade_name"] . "</a><br>";
                }
                echo $output;
            }	else{
                echo "<a>no names match your prompt</a>";
            }
            break;
        case "search_duty";
            $first_name = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE first_name REGEXP '" . str_replace('"', "", $first_name) . "' ORDER BY first_name ASC;";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0){
                $output = "";
                while($cadet = mysqli_fetch_assoc($result)){
                    $output .= "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedDuty(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
                }
            } else{
                $output = "<a>no names match your prompt</a>";
            }
            echo $output;
            break;
        case "search_first_name_user";
            $name = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE first_name REGEXP '" . str_replace('"', "", $name) . "' ORDER BY first_name ASC;";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)	{
                $output = "";
                while($cadet = mysqli_fetch_assoc($result)){
                    if($output == ""){
                        $output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
                    }	else	{
                        $output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
                    }
                }
                echo $output;
                return $result;
            }	else{
                echo "<a>no names match your prompt</a>";
            }
            break;
        case "search_last_name_user";
            $name = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE last_name REGEXP '" . str_replace('"', "", $name) . "' ORDER BY last_name ASC;";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)	{
                $output = "";
                while($cadet = mysqli_fetch_assoc($result)){
                    if($output == ""){
                        $output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
                    }	else	{
                        $output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedUser(" . $cadet["user_id"] . ")' name=" . $cadet["user_id"] . ">" . $cadet["rank"] . " " . $cadet["first_name"] . " " . $cadet["last_name"] . "</a><br>";
                    }
                }
                echo $output;
                return $result;
            }	else{
                return "<a>no names match your prompt</a>";
            }
            break;
        case "search_equipment_name";
            $name = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT * FROM equipment WHERE name REGEXP '" . str_replace('"', "", $name) . "';";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)	{
                $output = "";
                while($equipment = mysqli_fetch_assoc($result)){
                    if($output == ""){
                        $output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
                    }	else	{
                        $output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
                    }
                }
                echo $output;
            }	else{
                echo("<a>no names match your prompt</a>");
            }
            break;
        case "search_equipment_location";
            $name = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT * FROM equipment WHERE location REGEXP '" . str_replace('"', "", $name) . "';";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)	{
                $output = "";
                while($equipment = mysqli_fetch_assoc($result)){
                    if($output == ""){
                        $output = "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
                    }	else	{
                        $output = $output . "<a style=\"background-color:#ddd;\" onclick='resultHasBeenClickedEquipment(" . $equipment["equipment_id"] . ")' name=" . $equipment["equipment_id"] . ">name:" . $equipment["name"] . " location:" . $equipment["location"] . "</a><br>";
                    }
                }
                echo $output;
            }	else{
                echo("<a>no locations match your prompt</a>");
            }
            break;
        case "equipment_id_info_dump";
            $equipment_id = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT * FROM equipment WHERE equipment_id = " . $equipment_id . ";";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)	{
                $equipment = mysqli_fetch_assoc($result);
                echo json_encode($equipment);
            } else {
                return json_encode(["message" => "no names match your prompt"]);
            }
            break;
        case "user_id_info_dump";
            $user_id = get_request("prompt");
            include_once("../includes/connection.php");
            $query = "SELECT * FROM users WHERE user_id = " . $user_id . ";";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0)	{
                $cadet = mysqli_fetch_assoc($result);
                $cadet["password"] = "";
                echo json_encode($cadet);
            } else {
                return json_encode(["message" => "no names match your prompt"]);
            }
            break;
    }
}
?>