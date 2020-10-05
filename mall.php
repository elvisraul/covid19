<?php

	session_start();

	if(!isset($_SESSION["operatorid"])){
		header("Location: mall_login.php");
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>.:OLPESOFT:.</title>

	<!-- Bootstrap framework -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
	<!-- jQuery UI theme -->
	<link rel="stylesheet" href="assets/lib/jquery-ui/css/Aristo/Aristo.css" />
	<!-- breadcrumbs -->
	<link rel="stylesheet" href="assets/lib/jBreadcrumbs/css/BreadCrumb.css" />
	<!-- tooltips-->
	<link rel="stylesheet" href="assets/lib/qtip2/jquery.qtip.min.css" />
	<!-- colorbox -->
	<link rel="stylesheet" href="assets/lib/colorbox/colorbox.css" />
	<!-- code prettify -->
	<link rel="stylesheet" href="assets/lib/google-code-prettify/prettify.css" />
	<!-- sticky notifications -->
	<link rel="stylesheet" href="assets/lib/sticky/sticky.css" />
	<!-- aditional icons -->
	<link rel="stylesheet" href="assets/img/splashy/splashy.css" />
	<!-- flags -->
	<link rel="stylesheet" href="assets/img/flags/flags.css" />
	<!-- datatables -->
	<link rel="stylesheet" href="assets/lib/datatables/extras/TableTools/media/css/TableTools.css"/>

	<link rel="stylesheet" href="assets/lib/sweetalert/sweetalert.css">
	<link rel="stylesheet" href="assets/lib/toast/jquery.toast.min.css">

	<!-- main styles -->
	<link rel="stylesheet" href="assets/css/style.css" />
	<!-- theme color-->
	<link rel="stylesheet" href="assets/css/blue.css" id="link_theme" />

	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'/>

	<!-- favicon -->
	<link rel="shortcut icon" href="favicon.ico" />

        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
        <![endif]-->

        <!--[if lt IE 9]>
			<script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
			<script src="lib/flot/excanvas.min.js"></script>
		<![endif]-->    
	</head>
	<body class="full_width">
		<div class="style_switcher">
			<div class="gh_button-group">
				<!--<a href="#" id="showCss" class="btn btn-primary btn-sm">Manual</a>-->
				<button  id="resetDefault" class="btn btn-default btn-sm">manual de usuario </button>
			</div>
		</div>
		<div id="maincontainer" class="clearfix" >

			<header>
			
				<?php include 'structure/headering.php'; ?>
				
			</header>
			<div id="contentwrapper">
				<div class="main_content" style="margin-left:0px !important">
					<div id="jCrumbs" class="breadCrumb module">
						<ul>
							<li>
								<a href="#"><i class="glyphicon glyphicon-home"></i></a>
							</li>
							<li>
								MÓDULOS
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<ul class="dshb_icoNav clearfix">
								<li >
									<?php 
										$modules=$_SESSION['modules'];
										$keya = array_search('rrhh', array_column($modules, 'module'));
										if(is_numeric ($keya)) {
											echo '<a id="person" href="javascript:void(0)" style="background-image: url(assets/img/gCons/multi-agents.png)">RRHH</a>';
										}
									?>
									
								</li>
								<li >
									<?php 
										$modules=$_SESSION['modules'];
										$keyb = array_search('role', array_column($modules, 'module'));
										if(is_numeric ($keyb)) {
											echo '<a id="role"  href="javascript:void(0)" style="background-image: url(assets/img/gCons/male-user.png)">Roles</a>';
										}

									?>
								</li>
								<li >
									<a class="btn  disabled" href="javascript:void(0)" style="background-image: url(assets/img/gCons/calculator.png)">
										<span class="label label-info">+10</span> Contabilidad</a></li>
								<li >
									<a class="btn  disabled"  href="javascript:void(0)" style="background-image: url(assets/img/gCons/container.png)">Ventas</a></li>
								<li>
									<?php 
										$modules=$_SESSION['modules'];
										$keyc = array_search('logistic', array_column($modules, 'module'));
										if(is_numeric ($keyc)) {
											echo 	'<a id="logistics"  href="javascript:void(0)" style="background-image: url(assets/img/gCons/van.png)">Logística</a>';
										}
									?>
								</li>
								<li >
									<?php 
										$modules=$_SESSION['modules'];
										$keyd = array_search('process', array_column($modules, 'module'));
										if(is_numeric ($keyd)) {
											echo '<a id="process" href="javascript:void(0)" style="background-image: url(assets/img/gCons/tree.png)">Procesos</a>';
										}
									?>
								</li>
								<li  class="hidden">
									<a href="javascript:void(0)" style="background-image: url(assets/img/gCons/van.png)">
										<span class="label label-success">$2851</span> Delivery</a></li>
								<li  class="hidden">
									<a href="javascript:void(0)" style="background-image: url(assets/img/gCons/pie-chart.png)">Charts</a></li>
								<li  class="hidden">
									<a href="javascript:void(0)" style="background-image: url(assets/img/gCons/edit.png)">Add New Article</a></li>
								<li  class="hidden">
									<a href="javascript:void(0)" style="background-image: url(assets/img/gCons/add-item.png)"> Add New Page</a></li>
								<li  class="hidden">
									<a href="javascript:void(0)" style="background-image: url(assets/img/gCons/chat-.png)">
										<span class="label label-danger">26</span> Comments </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<a  href="javascript:void(0)" class="sidebar_switch on_switch bs_ttip hidden " data-placement="auto right" data-viewport="body" title="Hide Sidebar">Sidebar switch</a>
		<?php include 'structure/footer.php'; ?>
		<?php include 'assets/xcalling/mall_driver.php'; ?>
	</body>
</html>
