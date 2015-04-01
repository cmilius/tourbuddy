<?PHP
	session_start();
	if(!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
	{
		header("Location:login.php");
	}
	include("databaseconnection.php");
	
	//var_dump($_POST);

	$buildingID = clean_input($_POST['buildingID']);
	$buildingName = clean_input($_POST['buildingName']);
	$count = clean_input($_POST['count']);
	
	//$buildingDescription = clean_input($_POST['buildingDescription']);
	
	
	$fileName = uploadFile();
	//$fileName = $fileName.";";
	echo($buildingName);
	
	$sql = "UPDATE buildings SET image_location=CONCAT(image_location, '$fileName') 
			WHERE id='$buildingID'";
	
	
	$result = mysqli_query($conn, $sql);
	
	if($result === TRUE)
	{
		updateVersionNumber($conn);
		header("Location:../../buildings.php");
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
	
	function uploadFile()
	{
			
			global $buildingName;
			global $count;
			$buildingString = '';
			$tempBuildingName = preg_replace('/\s+/', '_', $buildingName);
			chdir("../");
			$target_dir = "img/buildings/".$tempBuildingName."/";
			$folder = $tempBuildingName."/";
			//if(!is_dir($target_dir))
			//{
				//mkdir($target_dir);
			//}
			echo($target_dir);
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			//echo("Image File Type:". $imageFileType);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					$imageName = $tempBuildingName."_".$count.".".$imageFileType;
					$target_file = $target_dir . $imageName;//basename($_FILES["fileToUpload"]["name"]);
					//$buildingString = $buildingString . $folder . $imageName . ";";
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}
			return $folder . $imageName. ";";
	}
	
	
	function updateVersionNumber($conn){
		$sql = "UPDATE version_number SET version = version + 1";
		$result = mysqli_query($conn, $sql);
	}

?>