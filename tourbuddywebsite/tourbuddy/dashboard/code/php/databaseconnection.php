<?php
$servername="gala.cs.iastate.edu";
$username="SlamminJammins";
$password="xaBre3ta";

//Create connection
$conn = new mysqli($servername, $username, $password);

//Check connection
if ($conn->connect_error)}
	die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully");

?>