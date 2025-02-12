<?php
    include_once("connection.php");

	$user_data = check_login($con);

    function html_to_display_profile_photo($user_id){
        $path = "profile-photos/" . $user_id;
        if (file_exists("profile-photos/" . $user_id . ".jpg") == TRUE){
            $path = "profile-photos/" . $user_id . ".jpg";
        }
        elseif (file_exists("profile-photos/" . $user_id . ".jpeg") == TRUE){
            $path = "profile-photos/" . $user_id . ".jpeg";
        }
        elseif (file_exists("profile-photos/" . $user_id . ".png") == TRUE){
            $path = "profile-photos/" . $user_id . ".png";
        }
        else{
            $path = "profile-photos/defalt.png";
        }
        return "<img data-active=\"my acount\" class=\"dropdown-button\" src=" . $path . ">";
    }
?>

<link rel="stylesheet" href="css/nav-style.css">
<nav>
        <div class="left">
            <a class="highlightable" data-active="my calendar" href="calendar.php">my calendar</a>
            <?php 
            if($user_data["admin"] == "1")  {
                echo("<a class=\"highlightable\" href=\"add.php\">add parade/event/acount/equipment</a>");
            }?>
        </div>
        <div class="right">
            <div class="dropdown-container">
                <?php echo(html_to_display_profile_photo($user_data["user_id"]));?>
                <div class="dropdown-content">
                    <a>user: <?php echo($user_data["rank"] . " " . $user_data["first_name"] . " " . $user_data["last_name"]);?></a>
                    <a>email: <?php echo($user_data["email"]);?></a>
                    <a>dob:  <?php echo($user_data["DOB"]);?></a>
                    <a>gender:  <?php echo($user_data["gender"]);?></a>
                    <form action="uploads.php" method="post" enctype="multipart/form-data">
                        <input type="submit" name="submit">change profile photo</input>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </form>
                    <a class="logout-button" href="logout.php">logout</a>
                </div>
            </div>
        </div>
    </nav>
