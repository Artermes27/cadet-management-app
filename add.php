<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
?>
<!DOCTYPE html>
<html>
<head>
	<title>my Dashbord</title>
	<link rel="stylesheet" href="css/add-style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
  <script src="js/add.js"></script>
</head>
<body>
    <?php include("includes/nav.php");?>
    <div class="grid-container">
        <div class="events-parades">
            <h2>events/parades</h2>
            <div class="add-parade">
                <form id="add_new_parade" action="functions.php" method="POST">
                    <h4 >add a parade</h4>
                    <a>the latest scheduled parade is curently set to:<?php $latest = get_latest_parade($con); echo($latest);?></a>
                    <a>the next parade should be: <?php echo(date("Y-m-d", strtotime($latest . " +7 days")));?></a>
                    <input hidden value="1" type="text" name="add_new_parade" id="add_new_parade">
                    <label>date</label>
                    <input type="date" name="date" id="date">
                    <label>start time</label>
                    <input type="time" name="start" id="start">
                    <label>finish time</label>
                    <input type="time" name="end" id="end">
                    <button>submit</button>
                </form>
            </div>
            <div class="add-event">
                <form id="add_new_event" action="functions.php" method="POST">
                    <h4 >add an event</h4>
                    <label>parade date</label>
                    <input type="date" name="parade_date" id="parade_date">
                    <input hidden value="1" type="text" name="add_new_event" id="add_new_event">
                    <input hidden value="" type="text" name="owner_id" id="owner_id">
                    <label>event type</label>
                    <input type="text" name="event_type" id="event_type">
                    <label>event name</label>
                    <input type="text" name="event_name" id="event_name">
                    <label>event start</label>
                    <input type="time" name="event_start" id="event_start">
                    <label>event end</label>
                    <input type="time" name="event_end" id="event_end">
                    <label>event owner</label>
                    <input type="text" name="event_owner" id="event_owner" onkeyup="showResutsSearchForOwner(this.value)">
                    <div class="livesearch" id="livesearch_owner"></div>
                    <button>submit</button>
                </form>
            </div>
        </div>
        <div class="users">
            <h2>users</h2>
            <div class="add-user">
                <form id="add_user" action="functions.php" method="POST">
                    <h4 >add a user</h4>
                    <input hidden value="1" type="text" name="add_new_user" id="add_new_user">
                    <label>email</label>
                    <input type="text" name="email" id="email">
                    <label>password</label>
                    <input type="password" name="password" id="password">
                    <label>first name</label>
                    <input type="text" name="first_name" id="first_name">
                    <label>last name</label>
                    <input type="text" name="last_name" id="last_name">
                    <label>date of birth</label>
                    <input type="date" name="DOB" id="DOB">
                    <label>gender</label>
                    <input type="text" name="gender" id="gender">
                    <label>rank</label>
                    <input type="text" name="rank" id="rank">
                    <label>active</label>
                    <select id="active" name="active">
                        <option value="1">active</option>
                        <option value="0">inactive</option>
                    </select>
                    <label>admin</label>
                    <select id="admin" name="admin">
                        <option value="0">non-admin</option>
                        <option value="1">admin</option>
                    </select>
                    <button>submit</button>
                </form>
            </div>
            <div class="modify-user">
                <form id="add_user" action="functions.php" method="POST">
                    <h4 >modify a user</h4>
                    <input hidden value="1" type="text" name="modify_user" id="modify_user">
                    <input hidden value="" type="text" name="modify_user_id" id="modify_user_id">
                    <label>search by first name</label>
                    <input type="text" name="input_search_first_name" id="input_search_first_name" onkeyup="showResutsSearchForUserFirstName(this.value)">
                    <div class="livesearch" id="livesearch_first_name"></div>
                    <label>search by last name</label>
                    <input type="text" name="input_search_last_name" id="input_search_last_name" onkeyup="showResutsSearchForUserLastName(this.value)">
                    <div class="livesearch" id="livesearch_last_name"></div>
                    <label>email</label>
                    <input type="text" name="modify_email" id="modify_email">
                    <label>password</label>
                    <input type="password" name="modify_password" id="modify_password">
                    <label>first name</label>
                    <input type="text" name="modify_first_name" id="modify_first_name">
                    <label>last name</label>
                    <input type="text" name="modify_last_name" id="modify_last_name">
                    <label>date of birth</label>
                    <input type="date" name="modify_DOB" id="modify_DOB">
                    <label>gender</label>
                    <input type="text" name="modify_gender" id="modify_gender">
                    <label>rank</label>
                    <input type="text" name="modify_rank" id="modify_rank">
                    <label>active</label>
                    <select id="modify_active" name="modify_active">
                        <option value="1">active</option>
                        <option value="0">inactive</option>
                    </select>
                    <label>admin</label>
                    <select id="modify_admin" name="modify_admin">
                        <option value="0">non-admin</option>
                        <option value="1">admin</option>
                    </select>
                    <button>submit</button>
                </form>
            </div>
        </div>
        <div class="equipment">
            <h2>equipment</h2>
            <div class="add-equipment">
                <form id="add_equipment" action="functions.php" method="POST">
                    <h4 >add equipment</h4>
                    <input hidden value="1" type="text" name="add_new_equipment" id="add_new_equipment">
                    <label>equipment name</label>
                    <input type="text" name="name" id="name">
                    <label>equipment description</label>
                    <input type="text" name="description" id="description">
                    <label>equipment location</label>
                    <input type="text" name="location" id="location">
                    <button>submit</button>
                </form>
            </div>
            <div class="modify-equipment">
                <form id="modify_existing_equipment" action="functions.php" method="POST">
                    <h4 >update equipment</h4>
                    <input hidden value="1" type="text" name="modify_equipment" id="modify_equipment">
                    <input hidden value="" type="text" name="modify_equipment_id" id="modify_equipment_id">
                    <label>search for equipment by name</label>
                    <input type="text" name="input_search_equipment_name" id="input_search_equipment_name" onkeyup="showResutsSearchForEquipmentByName(this.value)">
                    <div class="livesearch" id="livesearch_equipment_name"></div>
                    <label>search for equipment by location</label>
                    <input type="text" name="input_search_equipment_location" id="input_search_equipment_location" onkeyup="showResutsSearchForEquipmentByLocation(this.value)">
                    <div class="livesearch" id="livesearch_equipment_location"></div>
                    <label>equipment name</label>
                    <input type="text" name="modify_equipment_name" id="modify_equipment_name">
                    <label>equipment description</label>
                    <input type="text" name="modify_equipment_description" id="modify_equipment_description">
                    <label>equipment location</label>
                    <input type="text" name="modify_equipment_location" id="modify_equipment_location">
                    <label>active</label>
                    <select id="operation" name="operation">
                        <option value="modify">modify</option>
                        <option value="delete">delete</option>
                    </select><br>
                    <button type="submit" onclick="setModifyEquipment()">update equipment</button>
                </form>
            </div>
        </div>
    </div>
</body>