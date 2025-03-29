<a href="calendar.php">click here to go back to the calendar page</a><br>
<?php 
session_start();
	include_once("includes/connection.php");
	include("includes/functions.php");
	$user_data = check_login($con);

$target_dir = "profile-photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$error_msg = "";

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    $error_msg .= "<a>your image is to large try croping it</a><br>";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $error_msg = "<a>your image was not one of the following alowed types: jpg, jpeg or png</a><br>";
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
  echo "<a>Sorry, your file was not uploaded.</a><br>";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    header("Location: calendar.php");
    die;
  } else {
    echo $error_msg;
    die;
  }
}
?>