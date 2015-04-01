<?PHP

	session_start();
	if(!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
	{
		header("Location:../login.php");
	}
	
	var_dump($_POST);
	include("databaseconnection.php");

	$id = clean_input($_POST['id1']);
	$buildingName = clean_input($_POST['name1']);
	$description = clean_input($_POST['description1']);
	
	$sql = "UPDATE buildings SET name='$buildingName', 
			description='$description' WHERE id='$id'";
	
	
	$result = mysqli_query($conn, $sql);
	
	if($result === TRUE)
	{
		updateVersionNumber($conn);
		header("Location:../buildings.php");
	}
	echo("ok");
	mysqli_close($conn);
	
	function clean_input($data)
	{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}
	
	function updateVersionNumber($conn){
		$sql = "UPDATE version_number SET version = version + 1";
		$result = mysqli_query($conn, $sql);
	}

?>