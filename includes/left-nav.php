<link rel="stylesheet" href="css/left-nav-style.css">
<div class="left">  
    <h3><?php echo str_replace("_", " ", get_current_rank($con))," ", $user_data['last_name']; ?></h3>
    <?php
    $path = "profile-photos/" . get_id();
    if (file_exists("profile-photos/" . get_id() . ".jpg") == TRUE){
        $path = "profile-photos/" . get_id() . ".jpg";
    }
    elseif (file_exists("profile-photos/" . get_id() . ".jpeg") == TRUE){
        $path = "profile-photos/" . get_id() . ".jpeg";
    }
    elseif (file_exists("profile-photos/" . get_id() . ".png") == TRUE){
        $path = "profile-photos/" . get_id() . ".png";
    }
    else{
        $path = "profile-photos/defalt.jpg";
    }
    ?>
    <img style="width: 200px; height: 200px" src=<?php echo $path ?>>
    <form action="uploads.php" method="post" enctype="multipart/form-data">
        <label>change profile photo<br></label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="uploadImage" name="submit">
    </form>
    <div class="links">
        <a href="profile.php">my profile</a>
        <a href="rank.php">my rank progres</a>
        <a href="qualifications.php">my qualifications</a>
        <a href="qualifications.php">change password</a>
    </div>
</div>