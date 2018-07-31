<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Inventory Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- side nav css file -->
 <!--<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>-->
 <!-- side nav css file -->
 
 <!-- js-->
<script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->
 
<!-- Metis Menu -->
<script src="<?php echo base_url(); ?>js/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>js/custom.js"></script>
<link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
<style>


body {
  /* Location of the image */
  background-image: url(<?php echo base_url(); ?>images/v1.jpg);
  
  /* Background image is centered vertically and horizontally at all times */
  background-position: center center;
  
  /* Background image doesn't tile */
  background-repeat: no-repeat;
  
  /* Background image is fixed in the viewport so that it doesn't move when 
     the content's height is greater than the image's height */
  background-attachment: fixed;
  
  /* This is what makes the background image rescale based
     on the container's size */
  background-size: cover;
  
  /* Set a background color that will be displayed
     while the background image is loading */
  background-color: #464646;
}
$("#page-wrapper").css("background-color", "");
</style>
</head> 
<body class="" >
<div class="main-content">
	
		<!--left-fixed -navigation-->		
		<!-- header-starts -->
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper" style="background-color:''">
			<div class="main-page login-page bgimg" >
				<h2 class="title1">Login</h2>
				<div class="widget-shadow">
					<div class="login-body" >
						<form action="<?php echo base_url(); ?>index.php/home/dashboard" method="post">
						<?php if(isset($loginmsg)){ echo $loginmsg; } ?>
							<input type="text" class="user" name="userid" placeholder="Enter Your UserID" required="">
							<input type="password" name="password" class="lock" placeholder="Password" required="">
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="Sign In" value="Sign In">
							<!--<div class="registration">
								Don't have an account for Company ?
								<a class="" href="<?php echo base_url(); ?>index.php/home/signup">
									Create an account for your Company
								</a>
							</div>-->
						</form>
					</div>
				</div>
				
			</div>
		</div>
		<!--footer-->
		<div class="footer">
		   <p>&copy; 2018</p>		</div>
        <!--//footer-->
	</div>
	
	<!-- side nav js -->
	<script src='<?php echo base_url(); ?>js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="<?php echo base_url(); ?>js/jquery.nicescroll.js"></script>
	<script src="<?php echo base_url(); ?>js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="<?php echo base_url(); ?>js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
   
</body>
</html>