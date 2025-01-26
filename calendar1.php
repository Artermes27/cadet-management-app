<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
  if(isset($_GET["current_date"]) and $_GET["current_date"] != "null") {
    $current_date = $_GET["current_date"];
  } else {
    $current_date = "2025-01-24";
  }
  $temp = get_parade_date_range($con, $current_date);
  $parade_dates = $temp[0];
  $end_date = $temp[1];
  //defining the variables for the skip forwards and back in the calendar
  $min_add = date_skip_method($con, $current_date, "+1");
  $min_subtract = date_skip_method($con, $current_date, "-1");
  if($user_data["admin"] == 0) {
    $max_add = date_skip_method($con, $current_date, "+5");
    $max_subtract = date_skip_method($con, $current_date, "-5");
  } else {
    $max_add = date_skip_method($con, $current_date, "+4");
    $max_subtract = date_skip_method($con, $current_date, "-4");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>my Dashbord</title>
  <link rel="stylesheet" href="css/calendar-style1.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
  <script src="js/calendar.js"></script>
</head>
<body>
  <?php include("includes/nav.php");?>
  <div calss="container">
    <div class="banner">
      <input hidden value=<?php echo($current_date);?> type="date" name="current-date" id="current-date">
      <div class="prev">
        <button onclick="window.location.href='calendar1.php?current_date=<?php echo($max_subtract)?>';"><<<</button>
        <button onclick="window.location.href='calendar1.php?current_date=<?php echo($min_subtract)?>';"><</button>
      </div>
      <div class="display-dates-overview">
        <a id="display-dates-overview"><?php echo($current_date . " till " . $end_date);?></a>
      </div>
      <div class="next">
        <button onclick="window.location.href='calendar1.php?current_date=<?php echo($min_add)?>';">></button>
        <button onclick="window.location.href='calendar1.php?current_date=<?php echo($max_add)?>';">>>></button>
      </div>
    </div>
    <div class="calendar">
      <div class="parade1">
        <input hidden value="" type="date" name="parade1_date" id="parade1_date">
        <h2><?php echo($parade_dates[0]["date"]);?></h2>
      </div>
      <div class="parade2">
        <h2><?php echo($parade_dates[1]["date"]);?></h2>
      </div>
      <div class="parade3">
        <h2><?php echo($parade_dates[2]["date"]);?></h2>
      </div>
      <div class="parade4">
        <h2><?php echo($parade_dates[3]["date"]);?></h2>
      </div>
      <div class="parade5">
        <h2><?php echo($parade_dates[4]["date"]);?></h2>
      </div>
    </div>
  </div>
</body>
</html>