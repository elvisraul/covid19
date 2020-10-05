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
	
	<!-- multiselect -->
    <link rel="stylesheet" href="assets/lib/multi-select/css/multi-select.css" />					
	<!-- switch buttons -->
    <link rel="stylesheet" href="assets/lib/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" />
	<!-- main styles -->
	<link rel="stylesheet" href="assets/css/style.css" />
	<!-- theme color-->
	<link rel="stylesheet" href="assets/css/blue.css" id="link_theme" />
	<!-- enhanced select -->
	<link rel="stylesheet" href="assets/lib/chosen/chosen.css" />

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
			<div class="sepH_c">
				<p>Colors:</p>
				<div class="clearfix">
					<a href="javascript:void(0)" class="style_item jQclr blue_theme style_active" title="blue">blue</a>
					<a href="javascript:void(0)" class="style_item jQclr dark_theme" title="dark">dark</a>
					<a href="javascript:void(0)" class="style_item jQclr green_theme" title="green">green</a>
					<a href="javascript:void(0)" class="style_item jQclr brown_theme" title="brown">brown</a>
					<a href="javascript:void(0)" class="style_item jQclr eastern_blue_theme" title="eastern_blue">eastern blue</a>
					<a href="javascript:void(0)" class="style_item jQclr tamarillo_theme" title="tamarillo">tamarillo</a>
				</div>
			</div>
			<div class="sepH_c">
				<p>Backgrounds:</p>
				<div class="clearfix">
					<span class="style_item jQptrn style_active ptrn_def" title=""></span>
					<span class="ssw_ptrn_a style_item jQptrn" title="ptrn_a"></span>
					<span class="ssw_ptrn_b style_item jQptrn" title="ptrn_b"></span>
					<span class="ssw_ptrn_c style_item jQptrn" title="ptrn_c"></span>
					<span class="ssw_ptrn_d style_item jQptrn" title="ptrn_d"></span>
					<span class="ssw_ptrn_e style_item jQptrn" title="ptrn_e"></span>
				</div>
			</div>
			<div class="sepH_c">
				<p>Layout:</p>
				<div class="clearfix">
					<label class="radio-inline"><input name="ssw_layout" id="ssw_layout_fluid" value="" checked="" type="radio"> Fluid</label>
					<label class="radio-inline"><input name="ssw_layout" id="ssw_layout_fixed" value="gebo-fixed" type="radio"> Fixed</label>
				</div>
			</div>
			<div class="sepH_c">
				<p>Sidebar position:</p>
				<div class="clearfix">
					<label class="radio-inline"><input name="ssw_sidebar" id="ssw_sidebar_left" value="" checked="" type="radio"> Left</label>
					<label class="radio-inline"><input name="ssw_sidebar" id="ssw_sidebar_right" value="sidebar_right" type="radio"> Right</label>
				</div>
			</div>
			<div class="sepH_c">
				<p>Show top menu on:</p>
				<div class="clearfix">
					<label class="radio-inline"><input name="ssw_menu" id="ssw_menu_click" value="" checked="" type="radio"> Click</label>
					<label class="radio-inline"><input name="ssw_menu" id="ssw_menu_hover" value="menu_hover" type="radio"> Hover</label>
				</div>
			</div>

			<div class="gh_button-group">
				<a href="#" id="showCss" class="btn btn-primary btn-sm">Show CSS</a>
				<a href="#" id="resetDefault" class="btn btn-default btn-sm">Reset</a>
			</div>
			<div class="hide">
				<ul id="ssw_styles">
					<li class="small ssw_mbColor sepH_a" style="display:none">body {<span class="ssw_mColor sepH_a" style="display:none"> color: #<span></span>;</span> <span class="ssw_bColor" style="display:none">background-color: #<span></span> </span>}</li>
					<li class="small ssw_lColor sepH_a" style="display:none">a { color: #<span></span> }</li>
				</ul>
			</div>
		</div>-->
		<div id="maincontainer" class="clearfix">

			<header>
			
				<?php include 'structure/headering.php'; ?>
				
			</header>
			<div id="contentwrapper">
				<div class="main_content">
					<div id="jCrumbs" class="breadCrumb module">
						<ul>
							<li>
								<a href="#"><i class="glyphicon glyphicon-home"></i></a>
							</li>
							<li>
								<a href="#">Logística</a>
							</li>
							<li class="hidden">
								Tipos de Almacenes
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<div id="internals" class="formSep">
								<?php
									include 'src/design/views/mio_asistance.php' ; 
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<a href="javascript:void(0)" class="sidebar_switch on_switch bs_ttip" data-placement="auto right" data-viewport="body" title="Hide Sidebar">Sidebar switch</a>
		<div class="sidebar">
			<?php include 'structure/sidebar_mlogistics.php'; ?>
		</div>
		<?php include 'structure/footer.php'; ?>	
		<?php include 'assets/xcalling/mio_driver.php'; ?>
		<?php include 'assets/xcalling/mio_asistance.php'; ?>
		<!--<?php echo file_get_contents('assets/xcalling/mlogistics.js'); ?>-->
		
	</body>
</html>
