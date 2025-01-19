<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title>my Dashbord</title>
	<link rel="stylesheet" href="css/dashbord-style.css">
</head>
<body>
    <?php include("includes/nav.php");?>
	<div class="main">
		<?php include("includes/left-nav.php")?>
	</div>
	<div>
		this is the right
	</div>
	<br>
	Hello, <?php echo $user_data['first_name']," ", $user_data['last_name']; ?>
</body>
<?php include("includes/footer.php");?>
</html>