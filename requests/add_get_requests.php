<?php

if(isset($_GET["search_parade_name"])){//search method for creating an event used by add.js for searching for user by last name
    $parade_name = $_GET["search_parade_name"];
    include_once("../includes/connection.php");
    $query = "SELECT parade_id, date, parade_name FROM parades WHERE parade_name REGEXP '" . str_replace('"', "", $parade_name) . "';";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)	{
        //their are names symalar
        //print_r(mysqli_fetch_all($result));
        $output = "";
        while($parade = mysqli_fetch_assoc($result)){
            //echo $output;
            $output .= "<a style=\"background-color:#ddd;\" onclick=\"ResultHasBeenClickedParade('" . $parade["parade_id"] . "', '" . $parade["date"] . "', '" . $parade["parade_name"] . "')\">" . $parade["parade_name"] . "</a><br>";
        }
        echo $output;
    }	else{
        //their are no symalar names
        echo "<a>no names match your prompt</a>";
    }
}

if(isset($_GET["search_first_name_user"])){//search method for user's first name used by add.js for searching for user by first name
    $name = $_GET["search_first_name_user"];
    include_once("../includes/connection.php");
    $query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE first_name REGEXP '" . str_replace('"', "", $name) . "' ORDER BY first_name ASC;";
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
    include_once("../includes/connection.php");
    $query = "SELECT users.user_id, users.rank, users.first_name, users.last_name FROM users WHERE last_name REGEXP '" . str_replace('"', "", $name) . "' ORDER BY last_name ASC;";
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
    include_once("../includes/connection.php");
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
    include_once("../includes/connection.php");
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

if(isset($_GET["equipment_id_info_dump"])){//retreve all information about a piece of equipment from its id used by add.js to populate the modify equipment form
    include_once("../includes/connection.php");
    $query = "SELECT * FROM equipment WHERE equipment_id = " . $_GET["equipment_id_info_dump"] . ";";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0)	{
        $equipment = mysqli_fetch_assoc($result);
        echo json_encode($equipment);
    } else {
        return json_encode(["message" => "no names match your prompt"]);
    }
}

if(isset($_GET["user_id_info_dump"])){//retreve all user data for a user_id used by add.js to populate the modify user form
    include_once("../includes/connection.php");
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

?>