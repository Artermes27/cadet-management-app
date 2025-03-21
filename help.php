<head>
  <title>Help Page</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      line-height: 1.6;
    }
    
    .container {
      display: flex;
      min-height: 100vh;
    }
    
    .navigation {
      width: 15%;
      background-color: #f4f4f4;
      padding: 20px;
      box-sizing: border-box;
      border-right: 1px solid #ddd;
    }
    
    .navigation h2 {
      font-size: 18px;
      margin-top: 0;
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 1px solid #ccc;
    }
    
    .navigation ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
    
    .navigation li {
      margin-bottom: 15px;
    }
    
    .navigation a {
      text-decoration: none;
      color: #333;
    }
    
    .navigation a:hover {
      color: #007BFF;
    }
	
	button {
		grid-column: span 2;
		margin-top: 10px;
		padding: 10px 15px;
		font-size: 16px;
		background-color: #6b86c0;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		text-decoration: solid;
	}

	button:hover {
		background-color: #4c6baf;
	}
    
    /* Content Area */
    .content {
      flex: 1;
      padding: 20px;
      box-sizing: border-box;
    }
    
    .content section {
      margin-bottom: 40px;
    }
    
    .content h2 {
      color: #333;
      border-bottom: 2px solid #eee;
      padding-bottom: 10px;
    }
	
	.content h3 {
	  margin: 5px;
	  margin-left: 0px;
	}
	
	.content h4 {
	  margin: 5px;
	  margin-left: 25px;
	  text-decoration: underline;
	}
	
	.help-list {
      margin-top: 15px;
      padding-left: 20px;
    }
    
    .help-list li {
      margin-bottom: 8px;
    }
  </style>
</head>
<body>
    <?php
    session_start();
    $flag = false;
    if (isset($_SESSION["user_id"])){
        $flag = true;
        include("includes/functions.php");
        include("includes/nav.php");
    }
    ?>
  <div class="container">
    <div class="navigation">
      <h2>Categories</h2>
      <ul>
	    <li>
          <a href="#all-users-isues">All Users Isues</a>
        </li>
		<li>
          <a href="#all-users-guidance">All Users Guidance</a>
        </li>
        <li>
          <a href="#basic-users">Basic Users</a>
        </li>
        <li>
          <a href="#event-owners">Event Owner</a>
        </li>
        <li>
          <a href="#duty-cadets">Duty Cadets</a>
        </li>
        <li>
          <a href="#g4">G4 (Logistics Cadets)</a>
        </li>
        <li>
          <a href="#admin">Admin</a>
        </li>
      </ul>
      <?php
      if ($flag == false){
        echo "<a href=\"login.php\"><button>back to the login page</button></a>";
      }
      ?>
    </div>

    <div class="content">
	  <section id="all-users-isues">
        <h2>All Users Issues</h2>
        <ul class="help-list">
          <li>any issues with logins or passwords speak to the system admin they can fix these</li>
		  <li>if your account has been incorrectly deactivated, speak to the system admin they can fix this</li>
		  <li>any issues with permissions i.e. G4 or Admin speak to the system admin they can fix these</li>
        </ul>
      </section>
	  <section id="all-users-guidance">
        <h2>All Users Guidance</h2>
        <ul class="help-list">
          <li>for navigation at the top of all pages there is the navigation bar that will take you back to the calendar page at any time</li>
		  <li>to view your user details hover over your profile photo on the right of the navigation bar</li>
		  <li>to change your profile photo use the user details drop down menu to upload a photo to the system then press submit for it to be changed</li>
		  <li>to view parades not in the current range on the calendar page use the: >,>>>, < or <<< buttons at the top of the calendar page</li>
		  <li>since all search features on this page use regular expressions it is best to keep your searches non-descript and to see all possible results enter the characters +*</li>
        </ul>
      </section>
      <section id="basic-users">
        <h2>Basic Users Guidance</h2>
        <ul class="help-list">
          <li>as a basic user you will be able to view the lessons you have upcoming for the next few parades on the calendar page</li>
        </ul>
      </section>

      <section id="event-owners">
        <h2>Event Owner Guidance</h2>
        <ul class="help-list">
          <li>
		  as an event owner you will be able to view the approval status of your event on the calendar page:
			<ul class="status-list">
			  <li style="color: red;">Red: Indicates the event is not-approved</li>
			  <li style="color: orange;">Amber: Indicates the event has had approval requested</li>
			  <li style="color: green;">Green: Indicates the event is approved</li>
			</ul>
		  </li>
		  <h3>the following functionalities will be available when an event is not approved</h3>
		  <ul>
		  <li>to change the approval status of the event, you must click the link for your event on the calendar page which will take you to the event page where this can be done</li>
		  <li>event that are approved can't change their details so be sure the details are correct before you move the approval to requested</li>
		  <li>the admin will always be able to see your event in the calendar so once approval is requested, they will check the details and either approve it or set it to not-approved meaning some details must be changed</li>
		  </ul>
		  
		  <h3>the following functionalities will be available once the event is approved:</h3>
		  <h4>register</h4>
		  <ul>
		  <li>to add cadets to the register search their first name in the add box and click the result you want</li>
		  <li>if a cadet can’t make it to your event, they will not show up on this these results</li>
		  <li>to see why the cadet can’t make it search for them in the 'other' box to see the name of the cadet, the name of the event and the time of the event</li>
		  <li>to remove cadets from the register search their first name in the remove box and click the result you want</li>
		  <li>at the start of your lesson it is essential you populate the register with 1's to indicate a cadet is present and 0's if they are not then you must click the submit register button to update the register</li>
		  </ul>
		  
		  <h4>equipment requests log</h4>
		  <ul>
		  <li>to add an equipment request to the equipment request log search for the equipment name in the add box and click the result you want</li>
		  <li>if a piece of equipment is being used elsewhere and can't be used at your event, they will not show up on these results</li>
		  <li>to see where the piece of equipment is search for it in the 'other' box to see the name of the equipment, the name of the event and the time of the event where it is being used</li>
		  <li>to remove a piece of equipment from the register search the name of the equipment in the remove box and click the result you want</li>
		  <li>the G4 cadets will then approve/deny the equipment requests as they see fit once a piece of equipment has been denied/approved its status can’t be changed without deleting the request</li>
		  </ul>
		</ul>
      </section>

      <section id="duty-cadets">
        <h2>Duty Cadets Guidance</h2>
        <ul class="help-list">
          <li>As a duty cadet you will have all the same controls over an event as the event owner. The purpose of this role is to provide you the ability to see the progress of the events you have delegated.</li>
		  <li>Events that you are duty cadet for will show up on the calendar with the words duty event at the top.</li>
		</ul>
      </section>

      <section id="g4">
        <h2>G4 (Logistics Cadets) Guidance</h2>
        <ul class="help-list">
          <li>As a G4 you will see all events on the calendar page. Additionally, they will show up as if you are the event owner hence you can see their approval status.</li>
		  <li>Your role is to approve/deny equipment request as your team sees fit.</li>
		  <li>If you have accidently approved/denied an equipment request you may delete the request from the log and add the request back then set its approval status to the correct setting.</li>
		  <li>It is important to note that when a request is denied the system will no longer see this request. Hence, when searches are caried out for equipment that can be added to the log these pieces of equipment will show up as available.</li>
		</ul>
      </section>

      <section id="admin">
        <h2>Admin Guidance</h2>
        <ul class="help-list">
          <li>As the admin you have access to functions and pages other users don't:</li>
		  <h3>add page</h3>
		  <ul>
			<li>the add page will be your primary way to create/modify/delete items on the system</li>
			<li>to add a parade to the system fill out the form and be sure to properly name the parade since they stay on the system and descriptive names will help keep the calendar organised</li>
			<li>to add an event to the calendar go to the add an event form and populate the fields. Be sure to populate the following accurately:</li>
			<ul>
			<li>event owner: this will be the person teaching the lesson their role is to set the timings and names of the event according to the specifications set by their senior cadet (C/SGT to RSM). Once the event is approved, they must: populate the register and the equipment requests. </li>
			<li>duty cadet: this will be the person overseeing the planning of the event they are the senior (C/SGT to RSM) to the event owner. Initially you should set the event owner to this person so they may delegate the event to a lower rank for it to be organised. The duty cadet can’t be changed once the event is created.</li>
			<li>parade: This will be the parade that the event will take place on. Once you have selected this be sure to check the date of the selected parade to ensure it is the correct one. </li>
			</ul>
			<li>To add a user onto the system go to the add a user form in the top centre of the page. Populate the form here and submit it to add the user to the system.</li>
			<li>To modify the details of a user go to the modify a user form below the add a user. you must first search for the user then select the desired result. since users cant be deleted from the system you should instead set the active status of a user to non-active when they leave the cadet force. this will prevent the user from logging in to the system.</li>
			<li>To add equipment to the register populate the add equipment form on the top right of the page. be sure to use descriptive locations i.e. clothing store shelf 1. This will help G4 to locate equipment when it has been requested</li>
			<li>To modify equipment go to the modify equipment form below the add equipment form. you must first search for the piece of equipment and select the desired result. here you may edit the details of the piece of equipment be sure to have the action box set to modify unless you intend to delete the piece of equipment from the system</li>
		  </ul>
		  <h3>calendar page</h3>
		  <ul>
			<li>the calendar page for the admin will show all events for all parades withing the date range</li>
			<li>to edit an event from the calendar click the admin panel edit button for the event which will populate the admin panel edit form. From here change the necessary details and click submit to save the changes</li>
			<li>To access the event page for a lesson click the link that displays the name of the event</li>		  
		  </ul>
		  <h3>event page</h3>
		  <ul>
			<li>to set the approval status of an event to approved go to the modify event details form at the centre of the page and set the approval to approved and submit the form this will update the event's status so the register may be modified and the equipment requests can be made.</li>
		  <ul>
		</ul>
      </section>
    </div>
  </div>
</body>
</html>
