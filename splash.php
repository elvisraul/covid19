


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
	<!-- enhanced select -->
	<link rel="stylesheet" href="assets/lib/chosen/chosen.css" />
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
		<!--<div class="style_switcher">
			<div class="gh_button-group">
				
				<button  id="resetDefault" class="btn btn-default btn-sm">manual de usuario </button>
			</div>
		</div>-->
		<div id="maincontainer" class="clearfix" >

			<header>
			 <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-inner">
					<div class="container-fluid" >
						<a class="brand pull-left" href="splash.php" >OLPESA</a>
						
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
								OPCIONES
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<ul class="dshb_icoNav clearfix">
								<li>
									
									<a id="configuration" href="javascript:void(0)" style="background-image: url(assets/img/gCons/configuration.png)">Gestion</a></li>

								<li>
									<a id="control" href="javascript:void(0)" style="background-image: url(assets/img/gCons/male-user.png)"><span class="label label-success">0</span>Control</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade " id="modal_conrol" data-backdrop="static" >
			<form id="formdata-heart" >
				<div class="modal-dialog" style="margin: 35px auto">
					<div class="modal-content" style="border: 3px solid rgba(0, 0, 0, 0.5)">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title text-info">PUNTO DE CONTROL</h3>
						</div>
						<div class="modal-body">
							<div class="panel-body">
								<div class="form-group col-sm-12 col-md-12">
									<select id="controlpoint" name="controlpoint"  data-placeholder=" " style="width: 500px;" class="chzn_a form-control" >
										<option value="0"></option>
									</select>
								</div>
					        </div>
						</div>
						<div class="modal-footer">
							<!--<button id="cancelData" type="button" class="btn btn-default btn-sm">Cerrar</button>-->
							<button id="inputcontrol" type="button" class="btn btn-primary btn-sm">Ingresar</button>
						</div>
					</div>
				</div>
			</form>
		</div>

		<!--<a  href="javascript:void(0)" class="sidebar_switch on_switch bs_ttip hidden " data-placement="auto right" data-viewport="body" title="Hide Sidebar">Sidebar switch</a>-->
		<?php include 'structure/footer.php'; ?>
		<?php include 'assets/xcalling/splash_driver.php'; ?>
	</body>
</html>
