<?php 

session_start();
	include_once("connection.php");
	include("functions.php");
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];
		if(!empty($email) && !empty($password)){
			//read from database
			$query = "select * from users where email = '$email' limit 1";
			$result = mysqli_query($con, $query);
			if($result){
				if($result && mysqli_num_rows($result) > 0){
					echo "query sucess,";
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['password'] === hash("sha256", $password));{
						echo "password match";
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: calendar.php");
						die;
					}
				}
			}
			echo "wrong password!";
		}else{
			echo "wrong username!";
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
		</form>
    </div>
</body>