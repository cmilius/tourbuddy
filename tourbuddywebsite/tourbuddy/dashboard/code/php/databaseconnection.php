<?PHP
	session_start();
	if(!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
	{
		header("Location:login.php");
	}


$servername="localhost";
$username="root";
//$password="xaBre3ta";
$password="";
$dbname="SlamminJammins";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


//Check connection
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
	}


?>