	
<?php
	
	if(empty($_GET['token'])){
		header('Location: index.php');
	}

	require "src/utils/Enigma.php"  ;

	use Util\Enigma as Enigma;

	$string_decode=Enigma::decrypt($_GET['token']);
	$parameters=explode("#", $string_decode);

?>



<!DOCTYPE html>
<html lang="en" class="login_page">
<head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Iniciar - OLPESOFT</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
        <!-- theme color-->
            <link rel="stylesheet" href="assets/css/blue.css" />
        <!-- tooltip -->    
			<link rel="stylesheet" href="assets/lib/qtip2/jquery.qtip.min.css" />
        <!-- main styles -->
            <link rel="stylesheet" href="assets/css/style.css" />

		<link rel="stylesheet" href="assets/lib/sweetalert/sweetalert.css">
		<link rel="stylesheet" href="assets/lib/toast/jquery.toast.min.css">
    
        <!-- favicon -->
            <link rel="shortcut icon" href="favicon.ico" />
    
        <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
    
        <!--[if lt IE 9]>
            <script src="js/ie/html5.js"></script>
			<script src="js/ie/respond.min.js"></script>
        <![endif]-->
		
    </head>
    <body>
		
		<div class="login_box">
			<form  id="login_form">
				<div class="top_b">RESETEAR CONTRASEÑA</div>    
				<div class="alert alert-info alert-login alert-login-in">
					Cree una contraseña nueva.
				</div>
				<div class="cnt_b">
					<div class="form-group" style="display: none;">
						<input class="form-control input-sm" readonly="true" type="text" id="resetdate" name="resetdate" placeholder="Usuario" value="<?php echo($parameters[1]); ?>" />
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-user"></i></span>
							<input class="form-control input-sm" readonly="true" type="text" id="username" name="username" placeholder="Usuario" value="<?php echo($parameters[0]); ?>" />
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control input-sm" type="password" id="password" name="password" placeholder="Nueva contraseña" />
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control input-sm" type="password" id="cpassword" name="cpassword" placeholder="Confirmar nueva contraseña" />
						</div>
					</div>
				</div>
				<div class="btm_b clearfix">
					<button id="resetoption" type="button" class="btn btn-default btn-sm pull-right" >Restablecer</button>
					<span class="link_reg"><a  href="http://192.168.0.33/olpesin/">Iniciar session</a></span>
				</div>  
			</form>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.actual.min.js"></script>
        <script src="assets/lib/validation/jquery.validate.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/lib/sweetalert/sweetalert.min.js" ></script>
		
		<script src="assets/lib/sweetalert/sweetalert.min.js" ></script>
		<script src="assets/lib/toast/jquery.toast.min.js" ></script>
		
		<?php include 'assets/xcalling/mall_rlogin_driver.php'; ?>
		
		
    </body>
</html>
