<?php
$v_num = 0;

//Http POST body: {"type"={update, visit},"building_id"="xxxxx","version"=xxxxx"}
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

/*$input = file_get_contents('php://input');
logInputs($input);
$json = json_decode($input, true);
$req_type = $json["type"];

if($req_type == "update"){
	$version = $json["version"];
	if($version < 100){
		$buildingID = $json["building_id"];
		sendUpdate($buildingID);
	}
}
else if($req_type == "visit"){
	$buildingID = $json["building_id"];
	updateVisits($buildingID);
}*/

updateVisits(1);
sendUpdate(1);

function updateVisits($buildingID) {
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
	
	$query = "UPDATE visits SET visits = visits + 1 WHERE id ='".$buildingID."'";
	$result = mysqli_query($conn, $query);
	$conn->close();
}

//may need to change return technique depending on what we decide to do with the images
function sendUpdate($buildingID){
	
	$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
		
	$query = "SELECT * from buildings where id='".$buildingid."'";
	$result = mysqli_query($conn, $query);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)){
		$rows[] = $r;
	}
	$json = json_encode($rows);
	$conn->close();
	echo $json;
	
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