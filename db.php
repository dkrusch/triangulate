<?php

$configs = include("config.php");

//Create connection
$conn = new mysqli($configs["DB_HOST"], $configs["DB_USERNAME"], $configs["DB_PASSWORD"], $configs["DB_NAME"]);

//Check connection
if ($conn->connect_error) 
{
   die("Connection failed: " . $conn->connect_error);
}

function get_user_by_username($username)
{
	global $conn;
	$data = array();
	echo "In function username = $username <br>";
	if ($username) 
	{
		echo "if username <br>";
		if ($stmt = $conn->prepare("SELECT id, username FROM `user` WHERE username = ? ")) 
		{

		    /* bind parameters for markers */
		    echo "stmt: bind_param <br>";
		    $stmt->bind_param("s", $username);


		    /* execute query */
		    echo "stmt: execute <br>";
		    $result = $stmt->execute();
		    echo "result: $result";
		    // if (!$stmt->execute()) 
		    // {
      //   		trigger_error('Error executing MySQL query: ' . $stmt->error);
    		// }

		    /* bind result variables */
		    echo "stmt: bind_result <br>";

		    // $stmt->bind_result($id, $user);
		    $stmt->store_result();

		    /* fetch value */
		    echo "stmt: fetch $stmt->num_rows <br>";
		    $row = $result->fetch_assoc();
		    var_dump($row);
		    $data = $row;
        	// trigger_error('Error executing MySQL query: ' . $stmt->error);
    		// echo "after fetch: $id $user <br>";
    		// $data["id"] = $id;

		    /* close statement */
		    echo "$stmt: close <br>";
		    $stmt->close();
		}
	}
	echo "return data";
	return $data;
	
}

function create_user($username)
{
	global $conn;
	
	if ($username) 
	{
		if ($stmt = $conn->prepare("INSERT INTO `user` (username) VALUES (?)")) 
		{

		    /* bind parameters for markers */
		    $stmt->bind_param("s", $username);

		    /* execute query */
		    $stmt->execute();

		    /* close statement */
		    $stmt->close();
		}
	}
}
		

?>