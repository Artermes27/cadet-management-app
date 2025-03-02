<?php 
session_start();

	include_once("includes/connection.php");
	include("includes/functions.php");

	$user_data = check_login($con);
    if($user_data["admin"] == 0) {
        header("Location: calendar.php");
    }

    function get_latest_parade($con)	{
        $query = "SELECT date FROM parades ORDER BY date DESC LIMIT 1;";
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) > 0)
        {
            return mysqli_fetch_assoc($result)["date"];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>my Dashbord</title>
	<link rel="stylesheet" href="css/add-style.css">
    <script src="js/event_owner_form_handeling.js"></script>
  <script src="js/add.js"></script>
</head>
<body>
    <?php include("includes/nav.php");?>
    <div class="grid-container">
        <div class="events-parades">
            <h2>events/parades</h2>
            <div class="add-parade">
                <form id="add_new_parade" action="requests/post_requests.php" method="POST">
                    <h4 >add a Parade</h4>
                    <a>the latest scheduled parade is curently set to:<?php $latest = get_latest_parade($con); echo($latest);?></a>
                    <a>the next parade should be: <?php echo(date("Y-m-d", strtotime($latest . " +7 days")));?></a>
                    <input hidden value="add_new_parade" type="text" name="flag" id="flag">
                    <label>date</label>
                    <input type="date" name="date" id="date" onkeyup="REGEXCheckParade(this.value, 'date')" onclick="REGEXCheckParade(this.value, 'date')">
                    <label>start time</label>
                    <input type="time" name="start" id="start" onkeyup="REGEXCheckParade(this.value, 'start')" onclick="REGEXCheckParade(this.value, 'start')">
                    <label>finish time</label>
                    <input type="time" name="end" id="end" onkeyup="REGEXCheckParade(this.value, 'end')" onclick="REGEXCheckParade(this.value, 'end')">
                    <label>parade name</label>
                    <input type="text" name="parade_name" id="parade_name" onkeyup="REGEXCheckParade(this.value, 'parade_name')">
                    <div class="input-error-handeling" id="parade-input-handeling"></div>
                    <button id="add-parade-submit" disabled>submit</button>
                </form>
            </div>
            <div class="add-event">
                <form id="add_new_event" action="requests/post_requests.php" method="POST">
                    <h4 >add an event</h4>
                    <input hidden value="add_new_event" type="text" name="flag" id="flag">
                    <input hidden value="" type="text" name="parade_id" id="parade_id">
                    <input hidden value="" type="text" name="owner_id" id="owner_id">
                    <label>event type</label>
                    <input type="text" name="event_type" id="event_type" onkeyup="REGEXCheckEvent(this.value, 'event_type')">
                    <label>event name</label>
                    <input type="text" name="event_name" id="event_name" onkeyup="REGEXCheckEvent(this.value, 'event_name')">
                    <label>event start</label>
                    <input type="time" name="event_start" id="event_start" onkeyup="REGEXCheckEvent(this.value, 'event_start')" onclick="REGEXCheckEvent(this.value, 'event_start')">
                    <label>event end</label>
                    <input type="time" name="event_end" id="event_end" onkeyup="REGEXCheckEvent(this.value, 'event_end')" onclick="REGEXCheckEvent(this.value, 'event_end')">
                    <label>event owner</label>
                    <input type="text" name="event_owner_search_box" id="event_owner_search_box" onkeyup="showResutsSearchForOwner(this.value)">
                    <div id="display_current_owner">
                        <a>current owner: none selected</a>
                    </div>
                    <div class="livesearch" id="livesearch_owner"></div>
                    <label>parade</label>
                    <input value="" type="text" name="parade_id_search_box" id="parade_id_search_box" onkeyup="ShowResultsSearchForParade(this.value)">
                    <div id="display_current_parade">
                        <a>current parade: none selected</a>
                    </div>
                    <div class="livesearch" id="livesearch_parade_id"></div>
                    <div class="input-error-handeling" id="event-input-handeling"></div>
                    <button id="add-event-submit" disabled>submit</button>
                </form>
            </div>
        </div>
        <div class="users">
            <h2>users</h2>
            <div class="add-user">
                <form id="add_user" action="requests/post_requests.php" method="POST">
                    <h4 >add a user</h4>
                    <input hidden value="add_new_user" type="text" name="flag" id="flag">
                    <label>email</label>
                    <input type="text" name="email" id="email" onkeyup="REGEXCheckAddUser(this.value, 'email')">
                    <label>password</label>
                    <input type="password" name="password" id="password" onkeyup="REGEXCheckAddUser(this.value, 'password')">
                    <label>first name</label>
                    <input type="text" name="first_name" id="first_name" onkeyup="REGEXCheckAddUser(this.value, 'first_name')">
                    <label>last name</label>
                    <input type="text" name="last_name" id="last_name" onkeyup="REGEXCheckAddUser(this.value, 'last_name')">
                    <label>date of birth</label>
                    <input type="date" name="DOB" id="DOB" onkeyup="REGEXCheckAddUser(this.value, 'DOB')">
                    <label>gender</label>
                    <input type="text" name="gender" id="gender" onkeyup="REGEXCheckAddUser(this.value, 'gender')">
                    <label>rank</label>
                    <input type="text" name="rank" id="rank" onkeyup="REGEXCheckAddUser(this.value, 'rank')">
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
                    <label>G4</label>
                    <select id="G4" name="G4">
                        <option value="0">non-G4</option>
                        <option value="1">G4</option>
                    </select>
                    <div class="input-error-handeling" id="user-input-handeling"></div>
                    <button id="add-user-submit" disabled>submit</button>
                </form>
            </div>
            <div class="modify-user">
                <form id="add_user" action="requests/post_requests.php" method="POST">
                    <h4 >modify a user</h4>
                    <a style="grid-column: span 2;">leave the password field blank to leave it unchanged</a>
                    <input hidden value="modify_user" type="text" name="flag" id="flag">
                    <input hidden value="" type="text" name="modify_user_id" id="modify_user_id">
                    <label>search by first name</label>
                    <input type="text" name="input_search_first_name" id="input_search_first_name" onkeyup="showResutsSearchForUserFirstName(this.value)">
                    <div class="livesearch" id="livesearch_first_name"></div>
                    <label>search by last name</label>
                    <input type="text" name="input_search_last_name" id="input_search_last_name" onkeyup="showResutsSearchForUserLastName(this.value)">
                    <div class="livesearch" id="livesearch_last_name"></div>
                    <label>email</label>
                    <input type="text" name="modify_email" id="modify_email" onkeyup="REGEXCheckModifyUser(this.value, 'modify_email')">
                    <label>password</label>
                    <input type="password" name="modify_password" id="modify_password" onkeyup="REGEXCheckModifyUser(this.value, 'modify_password')">
                    <label>first name</label>
                    <input type="text" name="modify_first_name" id="modify_first_name" onkeyup="REGEXCheckModifyUser(this.value, 'modify_first_name')">
                    <label>last name</label>
                    <input type="text" name="modify_last_name" id="modify_last_name" onkeyup="REGEXCheckModifyUser(this.value, 'modify_last_name')">
                    <label>date of birth</label>
                    <input type="date" name="modify_DOB" id="modify_DOB" onkeyup="REGEXCheckModifyUser(this.value, 'modify_DOB')">
                    <label>gender</label>
                    <input type="text" name="modify_gender" id="modify_gender" onkeyup="REGEXCheckModifyUser(this.value, 'modify_gender')">
                    <label>rank</label>
                    <input type="text" name="modify_rank" id="modify_rank" onkeyup="REGEXCheckModifyUser(this.value, 'modify_rank')">
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
                    <label>G4</label>
                    <select id="modify_G4" name="modify_G4">
                        <option value="0">non-G4</option>
                        <option value="1">G4</option>
                    </select>
                    <div class="input-error-handeling" id="modify-user-input-handeling"></div>
                    <button id="modify-user-submit" disabled>submit</button>
                </form>
            </div>
        </div>
        <div class="equipment">
            <h2>equipment</h2>
            <div class="add-equipment">
                <form id="add_equipment" action="requests/post_requests.php" method="POST">
                    <h4 >add equipment</h4>
                    <input hidden value="add_new_equipment" type="text" name="flag" id="flag">
                    <label>equipment name</label>
                    <input type="text" name="name" id="name" onkeyup="REGEXCheckAddEquipment(this.value, 'name')">
                    <label>equipment description</label>
                    <input type="text" name="description" id="description" onkeyup="REGEXCheckAddEquipment(this.value, 'description')">
                    <label>equipment location</label>
                    <input type="text" name="location" id="location" onkeyup="REGEXCheckAddEquipment(this.value, 'location')">
                    <div class="input-error-handeling" id="equipment-input-handeling"></div>
                    <button id="add-equipment-submit" disabled>submit</button>
                </form>
            </div>
            <div class="modify-equipment">
                <form id="modify_existing_equipment" action="requests/post_requests.php" method="POST">
                    <h4 >update equipment</h4>
                    <input hidden value="modify_equipment" type="text" name="flag" id="flag">
                    <input hidden value="" type="text" name="modify_equipment_id" id="modify_equipment_id">
                    <label>search for equipment by name</label>
                    <input type="text" name="input_search_equipment_name" id="input_search_equipment_name" onkeyup="showResutsSearchForEquipmentByName(this.value)">
                    <div class="livesearch" id="livesearch_equipment_name"></div>
                    <label>search for equipment by location</label>
                    <input type="text" name="input_search_equipment_location" id="input_search_equipment_location" onkeyup="showResutsSearchForEquipmentByLocation(this.value)">
                    <div class="livesearch" id="livesearch_equipment_location"></div>
                    <label>equipment name</label>
                    <input type="text" name="modify_equipment_name" id="modify_equipment_name" onkeyup="REGEXCheckModifyEquipment(this.value, 'modify_equipment_name')">
                    <label>equipment description</label>
                    <input type="text" name="modify_equipment_description" id="modify_equipment_description" onkeyup="REGEXCheckModifyEquipment(this.value, 'modify_equipment_description')">
                    <label>equipment location</label>
                    <input type="text" name="modify_equipment_location" id="modify_equipment_location" onkeyup="REGEXCheckModifyEquipment(this.value, 'modify_equipment_location')">
                    <label style="text-decoration: underline;">action</label>
                    <select id="operation" name="operation">
                        <option value="modify">modify</option>
                        <option value="delete">delete</option>
                    </select><br>
                    <div class="input-error-handeling" id="modify-equipment-input-handeling"></div>
                    <button type="submit" onclick="setModifyEquipment()" id="modify-equipment-submit" disabled>submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
<?php 
mysqli_close($con)
?>