<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$input = file_get_contents('php://input');
logInputs($input);
$json = json_decode($input, true);
$req_type = $json["type"];

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
//updateVisits(1);
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
	$conn->close();*/
	
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	
	$query = "CALL updateVisitors('".$deviceID . "','" . $buildingID . "');";
	$result = mysqli_query($conn, $query);
	$conn->close();
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

?>