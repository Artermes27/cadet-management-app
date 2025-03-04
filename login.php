<?php 

session_start();
	include_once("includes/connection.php");
	include("includes/functions.php");
	$error_msg = "";
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		include_once("requests/post_request_scanning.php");
		$email = post_request("email");
		$password = post_request("password");
		if(!empty($email) && !empty($password)){
			$query = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1;";
			$result = mysqli_query($con, $query);
			if($result && mysqli_num_rows($result) > 0){
				$user_data = mysqli_fetch_assoc($result);
				if($user_data["password"] == hash("sha256", $password)){
					if($user_data["active"] == 1){
						$_SESSION["user_id"] = $user_data["user_id"];
						$_SESSION["password"] = $user_data["password"];
						header("Location: calendar.php");
						die;
					}else{
						$error_msg .= "Your account is inactive.</a><br><a style=\"text-align: center;\"> Speak to the system admin if this is an
						error";
					}
				}else{
					$error_msg .= "wrong password!";
				}
			}else{
				$error_msg .= "wrong email!";
			}
		}else{
			$error_msg .= "Please fill in all the fields";
		}
	}

?>
<!DOCTYPE html>
<head>
    <title>login</title>
    <link rel="stylesheet" href="css/login-style.css">
</head>
<body>
    <div class="container">
		<div class="title">
			<H1>login</H1>
		</div>
		<form class="form" method="post">
			<div>
				<label class="input-heading" for="username">SCC email</label><br>
				<input style="width: 450px; height: 50px;" type="text" placeholder="your-email@stcolumbascollege.org" id="username" name="email">
			</div>
			<div>
				<label class="input-heading" for="password">password</label><br>
				<input style="width: 450px; height: 50px;" type="password" placeholder="your password" id="password" name="password">
			</div>
			<div class="minor-container">
				<div class="remember-me">
					<input class="checkbox" type="checkbox" checked="checked"/>
					<label class="remember-me-tag">remember me</label>
				</div>
				<a href="forgot-password.php" class="forgot-password">forgot password</a>
			</div>
			<input type="submit" value="Log in" class="login-button">
			<?php echo "<a style=\"text-align: center;\">$error_msg</a>";?>
		</form>
    </div>
</body>