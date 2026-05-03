<?php

// Copy this file to connection.php and fill in your database credentials.
// connection.php is gitignored and must never be committed.

$dbhost = "localhost";
$dbuser = "your_db_username";
$dbpass = "your_db_password";
$dbname = "main_v2";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
	die("failed to connect!");
}
