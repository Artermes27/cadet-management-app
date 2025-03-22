# Help Page

This is a help page with navigation and guidance for various user roles.

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <div class="container">
    <nav class="navigation">
      <h2>Categories</h2>
      <ul>
        <li><a href="#all-users-issues">All Users Issues</a></li>
        <li><a href="#all-users-guidance">All Users Guidance</a></li>
        <li><a href="#basic-users">Basic Users</a></li>
        <li><a href="#event-owners">Event Owner</a></li>
        <li><a href="#duty-cadets">Duty Cadets</a></li>
        <li><a href="#g4">G4 (Logistics Cadets)</a></li>
        <li><a href="#admin">Admin</a></li>
      </ul>
      <button>Back to the system</button>
    </nav>

    <div class="content">
      <section id="all-users-issues">
        <h2>All Users Issues</h2>
        <ul class="help-list">
          <li>Any issues with logins or passwords? Speak to the system admin.</li>
          <li>If your account has been incorrectly deactivated, speak to the admin.</li>
          <li>Any issues with permissions (e.g., G4 or Admin), contact the system admin.</li>
        </ul>
      </section>

      <section id="all-users-guidance">
        <h2>All Users Guidance</h2>
        <ul class="help-list">
          <li>For navigation, use the navigation bar at the top of the page.</li>
          <li>To view your user details, hover over your profile photo.</li>
          <li>To change your profile photo, use the user details drop-down menu.</li>
          <li>To view parades not in the current range, use the buttons at the top of the calendar.</li>
        </ul>
      </section>

      <section id="basic-users">
        <h2>Basic Users Guidance</h2>
        <ul class="help-list">
          <li>As a basic user, you can view upcoming lessons on the calendar.</li>
        </ul>
      </section>

      <section id="event-owners">
        <h2>Event Owner Guidance</h2>
        <ul class="help-list">
          <li>Event approval statuses will be visible on the calendar.</li>
          <h3>Functionality when an event is not approved:</h3>
          <ul>
            <li>To change the event status, visit the event page from the calendar.</li>
            <li>Ensure details are correct before requesting approval.</li>
            <li>Admins will review the event and approve or reject it.</li>
          </ul>
          <h3>Once the event is approved:</h3>
          <h4>Register:</h4>
          <ul>
            <li>To add cadets to the register, search for their first name.</li>
            <li>To remove cadets, search and click their name to remove.</li>
            <li>Update the register by submitting it with "1" for present and "0" for absent.</li>
          </ul>
          <h4>Equipment Requests:</h4>
          <ul>
            <li>To add equipment, search and select the equipment you need.</li>
            <li>To remove equipment, search and select the item to remove.</li>
          </ul>
        </ul>
      </section>

      <section id="duty-cadets">
        <h2>Duty Cadets Guidance</h2>
        <ul class="help-list">
          <li>You can view and manage events like an event owner, but your role is to monitor the events you are assigned to.</li>
        </ul>
      </section>

      <section id="g4">
        <h2>G4 (Logistics Cadets) Guidance</h2>
        <ul class="help-list">
          <li>You can see all events and manage equipment requests.</li>
          <li>Once an equipment request is denied, you cannot change its status unless deleted and re-added.</li>
        </ul>
      </section>

      <section id="admin">
        <h2>Admin Guidance</h2>
        <ul class="help-list">
          <li>Admins have special access to create, modify, or delete users and events.</li>
          <h3>Add Page:</h3>
          <ul>
            <li>Admins can add events or users through dedicated forms on the system.</li>
            <li>Admins can modify user details and change active statuses.</li>
          </ul>
        </ul>
      </section>
    </div>
  </div>
</body>
</html>

calendar page for the admin and G4 users
![image](https://github.com/user-attachments/assets/16bc7a22-5f80-45d6-aa29-6d6b6f1b76df)
calendar page for the regular users
![image](https://github.com/user-attachments/assets/b5fb8107-986a-43c4-8009-a20adba023cb)
add php page for changeing attributes of objects in the database
![image](https://github.com/user-attachments/assets/6f10796d-0ad6-499f-91c7-ebc39f549023)
event php page for an aproved event with equipment requests and people on the register
![image](https://github.com/user-attachments/assets/653770fc-5ea4-4d9f-86c4-d19bd523fc98)
event php page for a non-aproved event
![image](https://github.com/user-attachments/assets/625f9102-8367-49ea-a30b-3fe60a1f6d26)

