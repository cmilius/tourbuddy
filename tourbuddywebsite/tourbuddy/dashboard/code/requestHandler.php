<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$input = file_get_contents('php://input');
logInputs($input);
$json = json_decode($input, true);
$req_type = $json["type"];
$buildingID = $json["building_id"];
$deviceID = $json["device_id"];

$buildingID = $json["building_id"];

	
		$deviceID = $json["device_id"];
		$query = "INSERT INTO visitors (deviceID, buildingsVisited) VALUES ('" . $deviceID . "','" . $buildingID . "');";
		echo($query);
		updateVisits($buildingID, $deviceID);


switch($req_type){
	case "getVersion":
		echo getAppVersion();
		break;
	case "getUpdate":
		echo sendUpdate();
		break;
	case "visit":
		$buildingID = $json["building_id"];
		$deviceID = $json["device_id"];
		updateVisits($buildingID, $deviceID);
		break;
}

/*if($req_type == "update"){
	$app_version = $json["version"];
	$version = getAppVersion();
	if($app_version < $version){
		$buildingID = $json["building_id"];
		sendUpdate($buildingID);
	}
}
else if($req_type == "visit"){
	$buildingID = $json["building_id"];
	updateVisits($buildingID);
}*/

//FOR DEBUGGING
//updateVisits($json["building_id"], $json["device_id"]);
//sendUpdate(1);
//$test = getAppVersion();
//echo $test;

function getAppVersion(){
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	
	$query = "SELECT * FROM version_number";
	//$result = mysqli_query($conn, $query);
	//$var = (int)$result['version'];
	$result = $conn->query($query);

	$row = $result->fetch_assoc();
	$conn->close();
	return $row["version"];
}

function updateVisits($buildingID, $deviceID) {
	
	/*$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	
	$query = "UPDATE visits SET visits = visits + 1, WHERE id ='".$buildingID."'";
	$query .= 'CALL updateVisitors($deviceID, $buildingID)';
	$result = mysqli_multi_query($conn, $query);
	$conn->close();
	
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	
	$query = "CALL updateVisitors('".$deviceID . "','" . $buildingID . "');";
	$result = mysqli_query($conn, $query);
	$conn->close();*/
	
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	
	$query = "SELECT * FROM visitors WHERE deviceID='" . $deviceID . "'";
	$result = mysqli_query($conn, $query);
	$rowCount = mysqli_num_rows($result);
	$row = mysqli_fetch_assoc($result);
	$conn->close();
	$id;
	
	if($rowCount >= 1)
	{
		$id = $row['id'];
		addVisitor($buildingID, $deviceID, $id);
		updateVisitsTbl($buildingID, $deviceID);
	}
	else
	{
		newVisitor($buildingID, $deviceID);
		updateVisitsTbl($buildingID, $deviceID);
	}
	//updateVisitsTbl($buildingID, $deviceID);
}

//may need to change return technique depending on what we decide to do with the images
function sendUpdate(){
	
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
		
	$query = "SELECT * from buildings";
	$result = mysqli_query($conn, $query);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)){
		$rows[] = $r;
	}
	$json = json_encode($rows, true);
	$conn->close();
	return $json;
	
}

function logInputs($input){
	//file_put_contents('log.txt', $input);
	$date = date('m/d/Y h:i:s a', time());
	$myFile = "log.txt";
	$fh = fopen($myFile, 'a');
	fwrite($fh, $date);
	fwrite($fh, " : ");
	fwrite($fh, $input);
	fwrite($fh, "\n");
	fclose($fh);
}

function addVisitor($buildingID, $deviceID, $id)
{		
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	$query = "UPDATE visitors SET buildingsVisited=CONCAT(buildingsVisited,'" . $buildingID . "',';') WHERE id='" . $id . "';";
	$result = mysqli_query($conn, $query);
	$conn->close();
}

function newVisitor($buildingID, $deviceID)
{	
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	$query = "INSERT INTO visitors (deviceID, buildingsVisited) VALUES ('" . $deviceID . "','" . $buildingID . "';');";
	
	$result = mysqli_query($conn, $query);
	$conn->close();
}

function updateVisitsTbl($buildingID, $deviceID)
{
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	$query = "UPDATE visits SET visits = visits+1, deviceID=CONCAT(deviceID,'" . $deviceID . "', ';') WHERE id='" . $buildingID . "';";
	$result = mysqli_query($conn, $query);
	$conn->close();
	
}


?>