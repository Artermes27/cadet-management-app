<a href="profile.php">click here to go back to the profile page</a><br>
<?php 
session_start();
	include_once("includes/connection.php");
	include("includes/functions.php");
	$user_data = check_login($con);

$target_dir = "profile-photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    ?>your image is to large try croping it</br><?php
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    ?>your image was not one of the following alowed types: jpg, jpeg or png</br><?php
    die;
    $uploadOk = 0;
}

$target_file = $target_dir . $user_data["user_id"] . ".jpg";
if (file_exists($target_file) == true) {
    unlink($target_file);
}

$target_file = $target_dir . $user_data["user_id"] . ".jpeg";
if (file_exists($target_file) == true) {
    unlink($target_file);
}

$target_file = $target_dir . $user_data["user_id"] . ".png";
if (file_exists($target_file) == true) {
    unlink($target_file);
  }

$target_file = $target_dir . $user_data["user_id"] . "." . $imageFileType;


if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    header("Location: calendar.php");
    die;
  } else {
    echo "Sorry, there was an error uploading your file.";
    die;
  }
}
?>