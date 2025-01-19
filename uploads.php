<a href="profile.php">click here to go back to the profile page</a><br>
<?php 
session_start();
	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);

$target_dir = "profile-photos/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check submition was real
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    ?>your image is to large try croping it</br><?php
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    ?>your image was not one of the following alowed types: jpg, jpeg or png</br><?php
    die;
    $uploadOk = 0;
}

// Check if file already exists to avoid colisions jpg
$target_file = $target_dir . get_id($con) . ".jpg";
if (file_exists($target_file) == true) {
    unlink($target_file);
}
// Check if file already exists to avoid colisions jpeg
$target_file = $target_dir . get_id($con) . ".jpeg";
if (file_exists($target_file) == true) {
    unlink($target_file);
}
// Check if file already exists to avoid colisions png
$target_file = $target_dir . get_id($con) . ".png";
if (file_exists($target_file) == true) {
    unlink($target_file);
  }

//give file the correct path
$target_file = $target_dir . get_id($con) . "." . $imageFileType;

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    //rerout back to profile page
    header("Location: profile.php");
    die;
  } else {
    echo "Sorry, there was an error uploading your file.";
    die;
  }
}
?>