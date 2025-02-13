<?php

$dbhost = "localhost";
$dbuser = "apache_user";
$dbpass = "Cadet2025";
$dbname = "main_v2";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
	die("failed to connect!");
}