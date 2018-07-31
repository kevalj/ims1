<!DOCTYPE HTML>

<html>
    <head>
        <title>Welcome To Inventory Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />


        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>



        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>css/bootstrap.css" rel='stylesheet' type='text/css' media="all"/>

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>css/style.css" rel='stylesheet' type='text/css' media="all" />

        <!-- font-awesome icons CSS -->
        <link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet" media="all"> 
        <!-- //font-awesome icons CSS-->

        <!-- side nav css file -->
        <link href='<?php echo base_url(); ?>css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' media="all"/>
        <!-- //side nav css file -->

        <!-- js-->
        <script src="<?php echo base_url(); ?>js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>js/modernizr.custom.js"></script>

        <!--webfonts-->
        <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <!--//webfonts--> 

        <!-- chart -->
        <script src="<?php echo base_url(); ?>js/Chart.js"></script>
        <!-- //chart -->

        <!-- Metis Menu -->
        <script src="<?php echo base_url(); ?>js/metisMenu.min.js"></script>
        <script src="<?php echo base_url(); ?>js/custom.js"></script>
        <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet" media="all">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" media="all">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--//Metis Menu -->
        <style>
            #chartdiv {
                width: 100%;
                height: 295px;
            }
        </style>
        <!--pie-chart --><!-- index page sales reviews visitors pie chart -->
        <script src="<?php echo base_url(); ?>js/pie-chart.js" type="text/javascript"></script>
        <script type="text/javascript">

            $(document).ready(function() {
                $('#demo-pie-1').pieChart({
                    barColor: '#2dde98',
                    trackColor: '#eee',
                    lineCap: 'round',
                    lineWidth: 8,
                    onStep: function(from, to, percent) {
                        $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                    }
                });

                $('#demo-pie-2').pieChart({
                    barColor: '#8e43e7',
                    trackColor: '#eee',
                    lineCap: 'butt',
                    lineWidth: 8,
                    onStep: function(from, to, percent) {
                        $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                    }
                });

                $('#demo-pie-3').pieChart({
                    barColor: '#ffc168',
                    trackColor: '#eee',
                    lineCap: 'square',
                    lineWidth: 8,
                    onStep: function(from, to, percent) {
                        $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                    }
                });


            });

        </script>
        <!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

        <!-- requried-jsfiles-for owl -->
        <link href="<?php echo base_url(); ?>css/owl.carousel.css" rel="stylesheet" media="all">
        <script src="<?php echo base_url(); ?>js/owl.carousel.js"></script>
        <script>
$(document).ready(function() {
$("#owl-demo").owlCarousel({
items: 3,
lazyLoad: true,
autoPlay: true,
pagination: true,
nav: true,
});
});
        </script>
        <!-- //requried-jsfiles-for owl -->
    </head> 
    <body class="cbp-spmenu-push">
        <div class="main-content">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!--left-fixed -navigation-->
                <aside class="sidebar-left">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <h1><a class="navbar-brand" href="<?php echo base_url(); ?>index.php/home/home_dashboard"><span class="fa fa-area-chart"></span> Inventory<span class="dashboard_text">Management</span></a></h1>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="sidebar-menu">
                                <li class="header">MAIN NAVIGATION</li>
								
								<?php foreach ($_SESSION['logged_in']['parent'] as $data1): ?>
								
                                <li class="treeview">
                                    <a href="<?php echo base_url(); ?><?php echo $data1['link'] ?>">
                                        <i class="fa fa-dashboard"></i> <span><?php echo $data1['menu_name'] ?></span>
                                    </a>

									
									<?php foreach ($_SESSION['logged_in']['child'] as $data2): ?>
									<?php $i=0;?>
									<?php if($data1['menu_id']==$data2['parent_id']) {?>
									
									<ul class="treeview-menu">
									
									
                                        <li><a href="<?php echo base_url(); ?><?php echo $data2['link'] ?>"><i class="fa fa-angle-right"></i> <?php echo $data2['menu_name'] ?></a></li>
										 </ul>
										<?php } ?>
										
										
										 <?php $i++;?>
										
										 
									<?php endforeach; ?>
                                        
                                   
                                </li>

                                
							<?php endforeach; ?>

                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </aside>
            </div>
            <!--left-fixed -navigation-->

            <!-- header-starts -->
            <div class="sticky-header header-section ">
                <div class="header-left">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="profile_details_left"><!--notifications of menu start -->




                        <div class="clearfix"> </div>
                    </div>
                    <!--notification menu end -->
                    <div class="clearfix"> </div>
                </div>
                <div class="header-right">


                    <!--search-box-->
                    <!--<div class="search-box">
                            <form class="input">
                                    <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
                                    <label class="input__label" for="input-31">
                                            <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                                            </svg>
                                    </label>
                            </form>
                    </div>--><!--//end-search-box-->

                    <div class="profile_details">		
                        <ul>
                            <li class="dropdown profile_details_drop">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <div class="profile_img">	
                                        <span class="prfil-img"><img src="" alt=""> </span> 
                                        <div class="user-name">
                                            <p><?php if (isset($_SESSION['logged_in']['username'])) {
    echo $_SESSION['logged_in']['username'];
} ?></p>
                                            <?php
                                            if (isset($_SESSION['logged_in']['company_admin'])) {
                                                if ($_SESSION['logged_in']['company_admin'] == 'Y') {
                                                    ?>
                                                    <span>Administrator</span>
                                                    <?php } else {
                                                    ?>
                                                    <span>User</span>
    <?php }
}
?>
                                        </div>
                                        <i class="fa fa-angle-down lnr"></i>
                                        <i class="fa fa-angle-up lnr"></i>
                                        <div class="clearfix"></div>	
                                    </div>	
                                </a>
                                <ul class="dropdown-menu drp-mnu">
                                    <li> <a href="<?php echo base_url(); ?>index.php/home/setting"><i class="fa fa-cog"></i> Settings</a> </li> 
                                    <?php
                                    if (isset($_SESSION['logged_in']['company_admin'])) {
                                        if ($_SESSION['logged_in']['company_admin'] == 'Y') {
                                            ?>
                                            <li> <a href="<?php echo base_url(); ?>index.php/home/myaccount"><i class="fa fa-user"></i> My Account</a> </li> 
        <?php
    }
}
?>
                                   <!-- <li> <a href="<?php echo base_url(); ?>index.php/home/profile"><i class="fa fa-suitcase"></i> Profile</a> </li> -->
                                    <li> <a href="<?php echo base_url(); ?>index.php/home/logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>				
                </div>
                <div class="clearfix"> </div>	
            </div>
            <link rel="stylesheet" href="<?php echo base_url(); ?>css/chosen.min.css" media="all">
            <script src="<?php echo base_url(); ?>js/chosen.jquery.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/datatables.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/datatables.min.css"/>
		<script src="<?php echo base_url(); ?>js/canvasjs.min.js"></script>
            <!-- //header-ends -->
