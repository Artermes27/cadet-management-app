<?php
session_start();

    include("connection.php");
    include("functions.php");
?>

<html>
<head>
<script src="js/search.js"></script>
</head>
<body>

<form>
<input type="text" size="30" id="search_first_name" value="" onkeyup="showResult(this.value, 'search_first_name')">
<div id="livesearch"></div>
</form>

</body>
</html>