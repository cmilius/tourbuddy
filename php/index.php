<?php
//Http POST body: {"type"={info, visit},"building_id"=xxxxx,"}
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$input = file_get_contents('php://input');
logInputs($input);
$json = json_decode($input, true);
$req_type = $json["type"];

if($req_type == "info"){
	$buildingID = $json["building_id"];
	$data = getInfo($buildingID);
	echo $data;
}
else if($req_type == "visit"){
	$buildingID = $json["building_id"];
	updateVisits($buildingID);
}


function getInfo($buildingID){
	$jsonString = file_get_contents('ISU_Buildings.json');
	$data = json_decode($jsonString, true);
	$info = "Something went wrong. We could not find the building you are requesting.";	
	
	foreach ($data as $key => $entry) {
		if ($entry["id"] == $buildingID) {
			$info = $data[$key]["description"];
		}
    }
	
	return $info;
}

function updateVisits($buildingID) {
	$jsonString = file_get_contents('ISU_Buildings.json');
	$data = json_decode($jsonString, true);
	
	foreach ($data as $key => $entry) {
		if ($entry["id"] == $buildingID) {
			$oldVal = $data[$key]["visits"];
			$newVal = intval($oldVal) + 1;
			$data[$key]["visits"] = (string) $newVal;
			echo $data[$key]["visits"];
		}
    }
	
	file_put_contents('ISU_Buildings.json', json_encode($data));
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