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
				
                
               <!-- <li>					
					<a href="notes.php">
						<i class="icon-bar-chart"></i>
						<span>Notes</span>
					</a>  									
				</li> -->
                
                
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
						<h3>Select a Building To Edit</h3>
					
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
					<div class="span12">
						<a href="addbuilding.php"><button type="submit" class="btn btn-primary">Add a New Building</button></a>
						<br>
						<br>
					</div>
					
						<!--<div class="span3">
								<div class="thumbnail">
									<img src="" alt="...">
									<div class="caption">
										<h3>Thumbnail</h3>
										
										<p><a href="#" class="btn btn-primary" role="button">Edit</a> </p>
									</div>
								</div>
						</div>-->
					
						<?PHP
							//Code to fetch building information from database and 
							//display all buildings in database
							while($row = mysqli_fetch_assoc($result))
							{
								$description = substr($row['description'],0,60);
								$string = $row['image_location'];
								
								$images = explode(";" , $string);
								//echo 'print-r('.$images.')';
								
								echo '<div class="span3">';
								
								echo '<div class="thumbnail">';
								echo '<img src="img/buildings/'.$images[0].'">';
								echo '<div class="caption">';
								echo '<h3><center>'.$row['name'].'</center></h3>';
								echo '<p><center>'.$description.'...</center></p>';
								//echo '<p><center><input type = "submit" action="editbuildinginfo.php" value="Edit" method="GET" class="btn btn-primary"></input></center></p>';
								echo '<form action="editbuildinginfo.php" method="post">';
								echo '<input type="hidden" id="id" name="id" value="'.$row['id'].'">';
								echo '<input type="hidden" id="name" name="name" value="'.$row['name'].'">';
								echo '<input type="hidden" id="description" name="description" value="'.$row['description'].'">';
								echo '<input type="hidden" id="image_location" name="image_location" value="'.$row['image_location'].'">';
								echo '<p><center><input type="submit" value="View/Edit" 
									name="Edit" id="frm1_edit" class="btn btn-primary" </center></p>';
								echo '</form>';
								echo '</div>';
								echo '</div>';
								echo '</div>';
								
							
							}
						?>
						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->					
				
		    </div> <!-- /span12 -->     	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
	    
	</div> <!-- /main-inner -->
    

	
	<!--<div class="main-inner">

	    <div class="container">
	
	      <div class="row">
	      	
	      	<div class="span12">
	      		
	      		<div class="widget">
						
					<div class="widget-header">
						<i class="icon-th-large"></i>
						<h3>Edit Building Information</h3>
					</div> <!-- /widget-header 
					
					<div class="widget-content">
						
						<div class="pricing-plans plans-3">
							
						<div class="plan-container">
					        <div class="plan">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		First Agent	        		
					        		</div> <!-- /plan-title 
					                
						            <div class="plan-price">
					                	$0<span class="term">For Life</span>
									</div> <!-- /plan-price -->
									
						        </div> <!-- /plan-header 	        
						        
						        <div class="plan-features">
									<ul>
										<li><strong>Perfect</strong> for a small company looking to tackle  customer service across email.</li>
										<li>Easy to upgrade anytime</li>
										<li>Pay only what you need</li>
										<li>Chat support</li>
									</ul>
								</div> <!-- /plan-features 
								
								<div class="plan-actions">				
									<a href="javascript:;" class="btn">Signup Now</a>				
								</div> <!-- /plan-actions -->
					
							</div> <!-- /plan -->
					    </div> <!-- /plan-container -->
					    
					    
					    
					    <!--<div class="plan-container">
					        <div class="plan green">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		Flex Package	        		
					        		</div> <!-- /plan-title
					                
						            <div class="plan-price">
					                	$5<span class="term">Per Agent</span>
									</div> <!-- /plan-price -->
									
						        </div> <!-- /plan-header 	          
						        
						        <div class="plan-features">
									<ul>					
										<li><strong>Perfect</strong> for mid size companies with round the clock support </li>
										<li>Flexible package</li>
										<li>Email & Chat support</li>
										<li>Multimedia support</li>
									</ul>
								</div> <!-- /plan-features 
								
								<div class="plan-actions">				
									<a href="javascript:;" class="btn">Signup Now</a>				
								</div> <!-- /plan-actions -->
					
							</div> <!-- /plan -->
					    </div> <!-- /plan-container 
					    
					    <div class="plan-container">
					        <div class="plan">
						        <div class="plan-header">
					                
						        	<div class="plan-title">
						        		Virtual Agent	        		
					        		</div> <!-- /plan-title 
					                
						            <div class="plan-price">
					                	$30<span class="term">Per Month</span>
									</div> <!-- /plan-price -->
									
						        </div> <!-- /plan-header 	       
						        
						        <div class="plan-features">
									<ul>
										<li><strong>Perfect</strong> for big companies with round the clock support and knwledge base.</li>
										<li>Easy to setup and use</li>
										<li>Mobile agent and multimedia support</li>
										<li>Universal inbox and cases</li>
									</ul>
								</div> <!-- /plan-features 
								
								<div class="plan-actions">				
									<a href="javascript:;" class="btn">Signup Now</a>				
								</div> <!-- /plan-actions 
					
							</div> <!-- /plan 
							
					    </div> <!-- /plan-container 
				
				
					</div> <!-- /pricing-plans 
						
					</div> <!-- /widget-content 
						
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

  </body>

</html>