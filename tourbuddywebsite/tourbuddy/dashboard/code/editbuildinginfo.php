<?PHP
	session_start();
	if(!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
	{
		header("Location:login.php");
	}
	
	$buildingid = $_POST['id'];

?>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Edit Info - TourBuddy Admin</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
    
    
    <link href="css/pages/plans.css" rel="stylesheet"> 

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

<body>
		<?php
			
			$conn = new mysqli("localhost", "SlamminJammins", "xaBre3ta", "SlamminJammins");
            
            $query = "SELECT * from buildings where id='".$buildingid."'";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_array($result);
			$conn->close();
			
			
			
        ?>

<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="dashboard.php">
				TourBuddy Admin				
			</a>		

			<div class="nav-collapse">
				<ul class="nav pull-right">
					
					<li class="dropdown">						
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i> 
							<?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>
							<b class="caret"></b>
						</a>
						
						<ul class="dropdown-menu">
							
							<li><a href="php/logout.php">Logout</a></li>
						</ul>						
					</li>
				</ul>
			
				
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->
    



    
<div class="subnavbar">

	<div class="subnavbar-inner">
	
		<div class="container">

			<ul class="mainnav">
			
				<li>
					<a href="dashboard.php">
						<i class="icon-dashboard"></i>
						<span>Dashboard</span>
					</a>	    				
				</li>
				
				
				
				<li>
					<a href="visitorstats.php">
						<i class="icon-list-alt"></i>
						<span>Visitor Statistics</span>
					</a>    				
				</li>
				
                
                <li>					
					<a href="notes.php">
						<i class="icon-bar-chart"></i>
						<span>Notes</span>
					</a>  									
				</li>
                
                
                <li>					
					<a href="buildings.php">
						<i class="icon-map-marker"></i>
						<span>Edit Building Information</span>
					</a>  									
				</li>
				
					<li>
					<a href="../../adminView.html">
						<i class="icon-list-alt"></i>
						<span>ISU Building Statistics</span> 
					</a> 
				</li>
				
				
			
			</ul>

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->

    
	
<div class="main">

	
	<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">
			
				<div class="widget">
						
					<div class="widget-header">
						<i class="icon-th-large"></i>
						<h3>View or Edit Building Information</h3>
					
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<!--<div class="span3">
								<div class="thumbnail">
									<img src="" alt="...">
									<div class="caption">
										<h3>Thumbnail</h3>
										
										<p><a href="#" class="btn btn-primary" role="button">Edit</a> </p>
									</div>
								</div>
						</div>-->
						
							<div class="span6">
								<div class="thumbnail">
									<img src="img/buildings/<?php echo $row['image_location']?>" alt="...">
									
								</div>
								<br>
							</div>
							
					
						
						<div class="span5">
							
						<form role="form" id="form" ><!--action="php/editbuildingdb.php" method="POST"--> 
							
							<div class="form-group">
								<label id="nameBuilding" style="display:none" for="name">Edit Building Name:</label>
								<button id="editButton" class="btn btn-danger icon-pencil" type="button" style="float:right">&nbsp;&nbsp;Edit</button>
								<h2><span id="buildingName" class="buildingName"><?php echo $_POST['name']?></span></h2>
								
							</div>
							<br>
							
							<!--age: <input type="textarea" value="<?php echo $row['description']?>"/> </br>-->
							<div class="form-group">
								<label id="editDiscription_tag" for="buildingDesciption" style="display:none" >Edit Description:</label>
								<!--<textarea class="form-control" rows="5" ><?php echo $_POST['description']?></textarea>-->
								<h4><span id="buildingDesciption" class="buildingDesciption"><?php echo $_POST['description']?></span></h4>
								<input type="text" style="display:none" class="building_id" id="building_id" value="<?php echo $_POST['id']?>"></input>
								
							</div>
							<br>
							<div class="form-group">
								<input type="button" value="Cancel" id="cancelChanges" class="btn btn-danger" style="display:none"></input>
								<input type="submit" value="Save Changes" id="saveChanges" class="btn btn-success" style="display:none"></input>
							</div>
							
						</form>
						
						
						</div>
						

						
					</div> <!-- /widget-content -->
					
					<div class="widget-content">
						<div class="span12">
							<form id="fileupload" action="//" method="POST" enctype="multipart/form-data">
							<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
							<div class="row fileupload-buttonbar">
							<div class="col-lg-7">
							<!-- The fileinput-button span is used to style the file input field as button -->
							<span class="btn btn-success fileinput-button">
								<i class="icon-plus"></i>
								<span>Add files...</span>
								<input style="height:0px;width:0px;" type="file" name="files[]" multiple >
							</span>
							<button type="submit" class="btn btn-primary start">
								<i class="icon-upload"></i>
								<span>Start upload</span>
							</button>
							<button type="reset" class="btn btn-warning cancel">
								<i class="icon-ban-circle"></i>
								<span>Cancel upload</span>
							</button>
							<button type="button" class="btn btn-danger delete">
								<i class="icon-trash"></i>
								<span>Delete</span>
							</button>
							<input type="checkbox" class="toggle">
							<!-- The global file processing state -->
							<span class="fileupload-process"></span>
						</div>
						<!-- The global progress state -->
						<div class="col-lg-5 fileupload-progress fade">
						<!-- The global progress bar -->
							<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
								<div class="progress-bar progress-bar-success" style="width:0%;"></div>
							</div>
						<!-- The extended global progress state -->
						<div class="progress-extended">&nbsp;</div>
						
						</div>
				</div>
					<!-- The table listing the files available for upload/download -->
					<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
				</form>
				</div>
			</div>
						
				</div> <!-- /widget -->					
				
		    </div> <!-- /span12 -->     	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    

	
    
</div> <!-- /main -->
    


<div class="extra">

	<div class="extra-inner">

		<div class="container">

			<div class="row">
                    <!-- /span3 -->
                    <div class="span3">
                        <h4>
                            Support</h4>
                        <ul>
                            <li><a href="javascript:;">Contact Us</a></li>
                        </ul>
                    </div>
                    <!-- /span3 -->

                    <!-- /span3 -->
                </div> <!-- /row -->

		</div> <!-- /container -->

	</div> <!-- /extra-inner -->

</div> <!-- /extra -->
    
<div class="footer">
	
	<div class="footer-inner">
		
		<div class="container">
			
			<div class="row">
				
    			<div class="span12">
    				&copy; 2015 Slammin' Jammins</a>.
    			</div> <!-- /span12 -->
    			
    		</div> <!-- /row -->
    		
		</div> <!-- /container -->
		
	</div> <!-- /footer-inner -->
	
</div> <!-- /footer -->


  

    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>
<script>

$(function () {
    $('#editButton').on('click', function () {
        var input = $('<input />', {'type': 'text', 'name':'buildingName', 'id': 'buildingName', 'value': $('#buildingName').html()});
        $('#buildingName').parent().append(input);
        $('#buildingName').remove();
        input.focus();
		
		var input2 = $('<textarea  />', {'rows': '6', 'id':'buildingDesciption', 'name': 'buildingDesciption', 'value': $('.buildingDesciption').html()});
        $('.buildingDesciption').parent().append(input2);
        $('.buildingDesciption').remove();
        input2.focus();
		
		$("#editDiscription_tag").show();
		$("#nameBuilding").show();
		$("#saveChanges").show();
		$("#cancelChanges").show();
		$("#editButton").hide();
    });
	
	
	 $('#cancelChanges').on('click', function () {
		var bName = $('#buildingName').val();
		
        $('#buildingName').parent().append($('<span />').text(bName));
        $('#buildingName').remove();    
		
		var bDescription = $('#buildingDesciption').val();
		
        $('#buildingDesciption').parent().append($('<span />').text(bDescription));
        $('#buildingDesciption').remove();
        
		$("#editDiscription_tag").hide();
		$("#nameBuilding").hide();
		$("#saveChanges").hide();
		$("#cancelChanges").hide();
		$("#editButton").show();
   });
   
   
	$("#saveChanges").click(function(e) {
	
	e.preventDefault();
	
	var name = $("#buildingName").val();
	var description = $("#buildingDesciption").val();
	var id = $("#building_id").val();

	if (name == '' || description == '') {
	alert("Name or Description Fields are Blank!");
	} else {
	// Returns successful data submission message when the entered information is stored in database.
	$.ajax({
		type: 'post',
		url: 'php/editbuildingdb.php',
		data: {
			name1: name,
			description1:description,
			id1:id
			},
		success: function() {
		
		var bName = $('#buildingName').val();
		
        $('#buildingName').parent().append($('<span />').text(bName));
        $('#buildingName').remove();    
		
		var bDescription = $('#buildingDesciption').val();
		
        $('#buildingDesciption').parent().append($('<span />').text(bDescription));
        $('#buildingDesciption').remove();
        
		$("#editDiscription_tag").hide();
		$("#nameBuilding").hide();
		$("#saveChanges").hide();
		$("#cancelChanges").hide();
		$("#editButton").show();
	
	//$('#form')[0].reset(); // To reset form fields
	}
	});
	}
	});
	
	
		


});


</script>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="icon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="icon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>



  </body>

</html>