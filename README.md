# Help Page

This is a help page with navigation and guidance for various user roles.

## Categories

- [All Users Issues](#all-users-issues)
- [All Users Guidance](#all-users-guidance)
- [Basic Users](#basic-users)
- [Event Owner](#event-owner)
- [Duty Cadets](#duty-cadets)
- [G4 (Logistics Cadets)](#g4-logistics-cadets)
- [Admin](#admin)

---

## All Users Issues

- Any issues with logins or passwords? Speak to the system admin.
- If your account has been incorrectly deactivated, speak to the admin.
- Any issues with permissions (e.g., G4 or Admin), contact the system admin.

---

## All Users Guidance

- For navigation, use the navigation bar at the top of the page.
- To view your user details, hover over your profile photo.
- To change your profile photo, use the user details drop-down menu and upload a new photo.
- To view parades not in the current range, use the `>`, `>>>`, `<`, or `<<<` buttons at the top of the calendar.
- Since all search features on this page use regular expressions, it is best to keep your searches non-descript. To see all possible results, enter the characters `+*`.

---

## Basic Users Guidance

- As a basic user, you will be able to view the lessons you have upcoming for the next few parades on the calendar page.

---

## Event Owner Guidance

- As an event owner, you will be able to view the approval status of your event on the calendar page. Event statuses will be indicated by color:

  - **Red**: Event not approved.
  - **Amber**: Approval requested.
  - **Green**: Event approved.

### Functionality When an Event Is Not Approved

- To change the approval status of the event, click the event's link on the calendar to access the event page.
- Events that are approved cannot have their details changed. Be sure the details are correct before requesting approval.
- The admin will always be able to see your event on the calendar. Once approval is requested, they will either approve it or set it as "not approved", meaning changes are required.

### Once the Event Is Approved:

#### Register

- To add cadets to the register, search for their first name in the "add" box and select the result.
- If a cadet cannot attend the event, they will not appear in the results.
- To see why a cadet cannot attend, search for their name in the "other" box to view the event name and time.
- To remove cadets from the register, search for their first name in the "remove" box and select the result.
- At the start of your lesson, populate the register with `1` for present and `0` for absent, then click the submit register button to update the register.

#### Equipment Requests Log

- To add an equipment request, search for the equipment name in the "add" box and select the result.
- If the equipment is unavailable due to being used elsewhere, it will not appear in the results.
- To see where the equipment is being used, search for it in the "other" box to view the event name and time where it's being used.
- To remove equipment from the log, search for it in the "remove" box and select the result.
- G4 cadets will approve or deny the equipment requests. Once a request has been approved or denied, its status cannot be changed without deleting the request.

---

## Duty Cadets Guidance

- As a duty cadet, you will have all the same controls over an event as the event owner. The purpose of this role is to monitor the events you've been assigned to.
- Events you are assigned to will appear on the calendar with the words "Duty Event" at the top.

---

## G4 (Logistics Cadets) Guidance

- As a G4 cadet, you will see all events on the calendar page, and you will be able to view them as if you were the event owner.
- Your main responsibility is to approve or deny equipment requests.
- If you accidentally approve or deny an equipment request, you may delete the request from the log, re-add it, and set its approval status to the correct setting.
- When a request is denied, the system no longer recognizes it, meaning it will appear as available in future searches for equipment.

---

## Admin Guidance

As the admin, you have access to functions and pages other users do not. Below are some of the key areas:

### Add Page:

- The **Add Page** will be your primary tool to create, modify, or delete items in the system.
- To add a parade, fill out the form and provide a descriptive name to keep the calendar organized.
- To add an event, go to the "Add Event" form and populate the fields. Ensure the following details are accurate:
  
  - **Event Owner**: This will be the person teaching the lesson. They are responsible for setting the event's timings and details according to the specifications set by their senior cadet (C/SGT to RSM). Once the event is approved, they must populate the register and equipment requests.
  
  - **Duty Cadet**: This will be the senior (C/SGT to RSM) overseeing the planning of the event. Initially, you should set the event owner as this person, so they may delegate the event to a lower rank for organization. The duty cadet cannot be changed once the event is created.
  
  - **Parade**: This will be the parade the event is scheduled for. Check the date of the selected parade to ensure accuracy.

- To add a user, go to the "Add User" form at the top center of the page, fill out the form, and submit it to add the user to the system.
- To modify a user's details, go to the "Modify User" form below the "Add User" form. First, search for the user, select the result, and update their information. Instead of deleting users, mark their active status as non-active when they leave the cadet force to prevent them from logging in.

- To add equipment to the system, use the "Add Equipment" form on the top right of the page. Be sure to use detailed descriptions for the locations (e.g., "Clothing Store Shelf 1").
- To modify equipment, use the "Modify Equipment" form below the "Add Equipment" form. First, search for the equipment and select the desired result. If you intend to delete equipment, set the action to "delete" before submitting the form.

### Calendar Page:

- The admin's calendar page will display all events for all parades within the date range.
- To edit an event from the calendar, click the "Edit" button on the event. This will open the admin panel, where you can modify the event's details and submit the changes.
- To access the event page for a lesson, click the link displaying the event's name.

### Event Page:

- To set the approval status of an event to "approved," go to the "Modify Event Details" form at the center of the page, set the approval to "approved," and submit the form. This will update the event's status, allowing the register to be modified and equipment requests to be made.

### galary of the pages on the system

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

