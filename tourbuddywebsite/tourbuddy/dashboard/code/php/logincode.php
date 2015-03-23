<?php


if(empty($_POST['email']))
{
	//die("Please enter your email");
	header("Location:../login.php");
	return false;
}

if(empty($_POST['password']))
{
	//die("Please enter your password");
	header("Location:../login.php");
	return false;
}

$email = clean_input($_POST['email']);
$password = clean_input($_POST['password']);

$firstname;
$lastname;

if(!checkLoginInfo($email, $password))
{
	header("Location:../login.php");
	return false;
}
	session_start();
	$logged = false;
	$username = strtok($email, '@');

	$_SESSION['username'] = $username;
	$_SESSION['email'] = $email;
	$_SESSION['logged'] = true;
	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	header("Location:../dashboard.php");

	//return true;

function clean_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function checkLoginInfo($email, $userPassword)
{
	
	$servername = "localhost";
	$username = "SlamminJammins";
	$dbPassword="xaBre3ta";
	$dbname="SlamminJammins";
	
	
	global $firstname, $lastname;
	//Create Connection
	$conn = new mysqli($servername, $username, $dbPassword, $dbname);
	
	//Check connection
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT firstname, lastname, email, password FROM users where email='$email' and password='$userPassword' ";
	
	$result = mysqli_query($conn, $sql);

	if (!$result || mysqli_num_rows($result) <= 0) {
		//die("Error logging in.  The username or password does not match");
		header("Location:../login.php");
		return false;
		}
	 else {
	 $row = mysqli_fetch_assoc($result);
	 $firstname = $row['firstname'];
	 $lastname = $row['lastname'];
		
		
	}

	$conn->close();
	return true;

}

?>