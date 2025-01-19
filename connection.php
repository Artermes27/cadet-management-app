<?php

$dbhost = "localhost";
$dbuser = "artermes27";
$dbpass = "blackarch";
$dbname = "main_v2";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}