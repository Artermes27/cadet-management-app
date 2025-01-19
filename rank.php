<?php 
session_start();
	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title>my rank</title>
    <link rel="stylesheet" href="css/rank-style.css">
    <link rel="stylesheet" href="css/nav-style.css">
    <link rel="stylesheet" href="css/footer-style.css">
    <?php include("includes/nav.php");?>
</head>
<body>
	<h1>my rank</h1>
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
            <table>
            <tr>
                <th>rank</th>
                <th>date achieved</th>
            </tr>
            <tr>
                <td>cadett</td>
                <td><?php get_rank($con, 0)?></td>
            </tr>
            <tr>
                <td>Lance Corporal</td>
                <td><?php get_rank($con, 1)?></td>
            </tr>
            <tr>
                <td>Corporal</td>
                <td><?php get_rank($con, 2)?></td>
            </tr>
            <tr>
                <td>Sergeant</td>
                <td><?php get_rank($con, 3)?></td>
            </tr>
            <tr>
                <td>Staff Sergeant</td>
                <td><?php get_rank($con, 4)?></td>
            </tr>
            <tr>
                <td>CQMS</td>
                <td><?php get_rank($con, 5)?></td>
            </tr>
            <tr>
                <td>CSM</td>
                <td><?php get_rank($con, 6)?></td>
            </tr>
            <tr>
                <td>RQMS</td>
                <td><?php get_rank($con, 7)?></td>
            </tr>
            <tr>
                <td>RSM</td>
                <td><?php get_rank($con, 8)?></td>
            </tr>
            </table> 
        </div>
    </div>
</body>
<?php include("includes/footer.php");?>
</html>