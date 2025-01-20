<?php
    if (isset($_POST['submit_data'])) {
        echo("hello world");
    }
    
    if (isset($_POST['edit_data'])) {
        //second form
    }
?>


<form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
    <label for='name'>Naam:</label><br>
    <input type="text" id="name" name="name" placeholder = "John Doe" required><br>
    <input type="submit" name="submit_data" value="Save"><br>
</form>

<form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">
    <label for='name'>Naam:</label><br>
    <input type="text" id="name" name="name" placeholder = "John Doe" required><br>
    <input type="submit" name="edit_data" value="Edit"><br>
</form>