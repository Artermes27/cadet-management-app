<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "SELECT * FROM users Where user_id = '$id' limit 1;";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			if (isset($_GET["parade_id"]) and isset($_GET["event_id"])){
				$user_data["parade_id"] = $_GET["parade_id"];
				$user_data["event_id"] = $_GET["event_id"];
				return $user_data;
			}else{
				return $user_data;
			}
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function get_id()
{
	return $_SESSION['user_id'];
}

function get_rank($con, $id)
{
	$query = "SELECT * FROM users Where user_id = '$id' limit 1;";
	$result = mysqli_query($con, $query);
	
	if(mysqli_num_rows($result) > 0)
	{
		return mysqli_fetch_assoc($result)["rank"];
	}
}

function update_search($con)
{
	$query = "SELECT users.user_id, users.first_name, users.last_name, users.rank FROM users WHERE active = 1 ORDER BY first_name";
	$result = mysqli_query($con, $query);

	if(mysqli_num_rows($result) > 0)
	{
		$file_out = fopen("search.xml", "w") or die("Unable to open file!");
		fwrite($file_out, "<all_users>\n");
		while($cadet = mysqli_fetch_assoc($result)){
			$output = "<cadet>\n<user_id>" . $cadet["user_id"] . "</user_id>\n<first_name>" . $cadet["first_name"] . "</first_name>\n<last_name>" . $cadet["last_name"] . "</last_name>\n<rank>" . $cadet["rank"] . "</rank>\n</cadet>\n";
			fwrite($file_out, $output);
		}
		fwrite($file_out, "</all_users>\n");
		fclose($file_out);
	}
}

if(isset($_GET["search_first_name"]) != ""){
	echo("search for first name");
	$first_name = $_GET["search_first_name"];
	$query = "";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)	{
		//their are names symalar
		
		while($cadet = mysqli_fetch_assoc($result)){

		}
	}	else{
		//their are no symalar names
	}
}

if(isset($_GET["search_last_name"]) != ""){
	echo("search for last name");
}

if(isset($_GET["search_rank"]) != ""){
	echo("search for rank");
}

$xmlDoc=new DOMDocument();
$xmlDoc->load("search.xml");

$max_length=$xmlDoc->getElementsByTagName('name');

//get the name parameter from URL
$prompt=$_GET["search_first_name"];

//lookup all links from the xml file if length of q>0
// Check if the prompt is provided
if (strlen($prompt) > 0) {
    $search_result = "";

    // Loop through the XML nodes
    for ($count = 0; $count < $max_length->length; $count++) {
        // Get the first name, last name, and rank elements for the current node
        $first_name = $max_length->item($count)->getElementsByTagName("first_name");
        $last_name = $max_length->item($count)->getElementsByTagName("last_name");
        $rank = $max_length->item($count)->getElementsByTagName("rank");

        // Check if the first name element exists
        if ($first_name->item(0)->nodeType == 1) {
            // Check if the first name matches the search prompt
            if (stristr($first_name->item(0)->childNodes->item(0)->nodeValue, $prompt)) {
                // If no previous results, create the first result
                if ($search_result == "") {
                    $search_result = "<a href='" . $last_name->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'>" .
                    $first_name->item(0)->childNodes->item(0)->nodeValue . "</a>";
                } else {
                    // Otherwise, append the new result with a line break
                    $search_result .= "<br /><a href='" . $last_name->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'>" .
                    $first_name->item(0)->childNodes->item(0)->nodeValue . "</a>";
                }
            }
        }
    }

    // Output the search result
    echo $search_result;
}


// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($search_result=="") {
  $response="no suggestion";
} else {
  $response=$search_result;
}

//output the response
echo $response;

