
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

	<!-- datepicker -->
    <link rel="stylesheet" href="assets/lib/datepicker/datepicker.css" />
	<!-- datepicker -->
    <link rel="stylesheet" href="assets/lib/timepicker/css/bootstrap-timepicker.css" />
    <!-- tag handler -->
    <link rel="stylesheet" href="assets/lib/tag_handler/css/jquery.taghandler.css" />
    <!-- uniform -->
    <link rel="stylesheet" href="assets/lib/uniform/Aristo/uniform.aristo.css" />
	<!-- multiselect -->
    <link rel="stylesheet" href="assets/lib/multi-select/css/multi-select.css" />					
	<!-- enhanced select -->
	<link rel="stylesheet" href="assets/lib/chosen/chosen.css" />
	<!-- colorpicker -->
    <link rel="stylesheet" href="assets/lib/colorpicker/css/colorpicker.css" />
	<!-- switch buttons -->
   	<link rel="stylesheet" href="assets/lib/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" />
	<!-- main styles -->
	<link rel="stylesheet" href="assets/css/style.css" />
	<!-- theme color-->
	<link rel="stylesheet" href="assets/css/blue.css" id="link_theme" />
	

	<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'/>

	<!-- favicon -->
	<link rel="shortcut icon" href="favicon.ico" />

	<link rel="stylesheet" href="assets/lib/sweetalert/sweetalert.css">
	<link rel="stylesheet" href="assets/lib/toast/jquery.toast.min.css">

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
		<div id="maincontainer" class="clearfix">

			<header>
			
			 <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-inner">
					<div class="container-fluid" >
						<a class="brand pull-left" href="mcli_all.php">Control de Personas</a>
					</div>
				</div>
			</nav>
				
			</header>
			<div id="contentwrapper">
				<div class="main_content" style="margin-left:0px !important">
					<div id="jCrumbs" class="breadCrumb module">
						<ul>
							<li>
								<a href="#"><i class="glyphicon glyphicon-home"></i></a>
							</li>
							<li>
								<a href="#">Usuarios</a>
							</li>
							<li class="hidden">
								Tipos de Almacenes
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<div id="internals" >
								<?php include 'src/design/views/mcli_asistance.php'; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include 'structure/footer.php'; ?>	
		<?php include 'assets/xcalling/mcli_driver.php'; ?>
		<?php include 'assets/xcalling/mcli_asistance.php'; ?>
		
	</body>
</html>
