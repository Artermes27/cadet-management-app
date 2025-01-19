<?php 
session_start();
	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title>my profile</title>
    <link rel="stylesheet" href="css/profile-style.css">
    <link rel="stylesheet" href="css/nav-style.css">
    <link rel="stylesheet" href="css/footer-style.css">
    <?php include("includes/nav.php");?>
</head>
<body>
	<h1>my profile</h1>
    <div class="container">
        <div class="left">  
            <a><?php echo str_replace("_", " ", get_current_rank($con))," ", $user_data['last_name']; ?></a>
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
            <a href="profile.php">my profile</a>
            <a href="rank.php">my rank progres</a>
            <a href="qualifications.php">my qualifications</a>
            <a href="change-password.php">change password</a>
        </div>
        <div class="right">
            <h2>right</h2>
        </div>
    </div>
</body>
<?php include("includes/footer.php");?>
</html>