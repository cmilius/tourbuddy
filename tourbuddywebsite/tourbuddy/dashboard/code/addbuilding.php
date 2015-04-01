<?PHP
	session_start();
	if(!isset($_SESSION['logged']) || $_SESSION['logged'] != true)
	{
		header("Location:login.php");
	}
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
            
            $query = "SELECT * from buildings";
			$result = mysqli_query($conn, $query);
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
				
                
                <!--<li>					
					<a href="notes.php">
						<i class="icon-bar-chart"></i>
						<span>Notes</span>
					</a>  									
				</li>-->
                
                
                <li>					
					<a href="buildings.php">
						<i class="icon-map-marker"></i>
						<span>Edit Building Information</span>
					</a>  									
				</li>
				
					<!--<li>
					<a href="../../adminView.html">
						<i class="icon-list-alt"></i>
						<span>ISU Building Statistics</span> 
					</a> 
				</li>-->
				
				
			
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
						<h3>Add A Building </h3>
					
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
					<div class="span4">
								<div class="thumbnail">
									<img id="blah" src="#" alt="Upload a Default Image" />
								</div>
								<br>
					</div>
					
					<div class="span4">
					
					
						<form role="form" action="php/addBuildingtoDB.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="buildingName">Building Name</label>
								<input type="text" class="form-control" name="buildingName" id="buildingName" placeholder="Enter the Building Name">
							</div>
  
							<div class="form-group">
								<label for="buildingDescription">Building Description</label>
								<textarea rows="4" class="form-control" name="buildingDescription" id="buildingDescription" placeholder="Enter a Description"></textarea>
							</div>
							
							<div class="form-group">
								<label for="fileUpload">Picture Upload</label>
								<input type="file" name="fileToUpload" id="fileUpload">
								
								<p class="help-block">Upload A Default Picture for this building.  You will be able to add more pictures later.</p>
							</div>
					
							<button type="submit" class="btn btn-default">Submit</button>
					</form>
					
					</div>
					
						
						
						
					</div> <!-- /widget-content -->
						
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
 function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
			
        }

}

$("#fileUpload").change(function(){
    readURL(this);
	
});


</script>

  </body>

</html>