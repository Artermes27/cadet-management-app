<?php
include("connection.php");

$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60*30);
$query = "UPDATE cadett SET `reset_token_hash` = '$token_hash', `reset_token_espires` = '$expiry' WHERE `email` = '$email';";
echo $query;
$result = mysqli_query($con, $query);
//build in error catching for incorect emails
echo "sucess";

?>