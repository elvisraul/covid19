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
				<div class="top_b">Ingrese a OLPESOFT</div>    
				<div class="alert alert-info alert-login alert-login-in">
					Valide su credencial, digite usuario y contraseña .
				</div>
				<div class="cnt_b">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-user"></i></span>
							<input class="form-control input-sm" type="text" id="username" name="username" placeholder="Usuario" />
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control input-sm" type="password" id="password" name="password" placeholder="Contraseña" />
						</div>
					</div>
					<div class="form-group">
						<div class="input-group form-control text-center">
							<img id='captcha_image' class="text-center" src="src/services/captcha/captcha.php?rand=<?php echo rand(); ?>" title="Codigo de Verificacion">
							
						</div>
						<small>
							<a id="captcha_refresh" href='javascript: refreshCaptcha();'>actualizar Captcha</a></small>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-flash"></i></span>
							<input class="form-control input-sm" type="text" id="captcha" name="captcha" autocomplete="off" placeholder="Código verificación" />
						</div>
					</div>
				</div>
				<div class="btm_b clearfix">
					<button id="in_button" type="button" class="btn btn-default btn-sm pull-right" >Ingrese</button>
					<span class="link_reg"><a  href="#reg_form">No esta registrado? darse de alta aqui</a></span>
				</div>  
			</form>
			
			<form method="post" id="pass_form" style="display:none">
				<div class="top_b">Solicitud de Reinicio de Contraseña</div>    
					<div class="alert alert-info alert-login alert-login-reset">
					Ingrese su correo electrónico.
				</div>
				<div class="cnt_b">
					<div class="formRow clearfix">
						<div class="input-group">
							<span class="input-group-addon input-sm">@</span>
							<input id="mail" name="mail" type="text" placeholder="Tu correo electrónico" class="form-control input-sm" />
						</div>
					</div>
				</div>
				<div class="btm_b tac">
					<button id="reset_button" class="btn btn-default" type="button">enviar correo</button>
				</div>  
			</form>
			
			<form method="post" id="reg_form" style="display:none">
				<div class="top_b">Alta en OLPESOFT</div>
				<div class="alert alert-warning alert-login">
					Al completar el siguiente formulario y hacer clic en el botón "Registrarse", acepta y esta de acuerdo con los <a data-toggle="modal" href="#terms">Términos y Condiciones</a> de Oleaginosas del Perú.
				</div>
				<div id="terms" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h3 class="modal-title">TERMINOS Y CONDICIONES</h3>
							</div>
							<div class="modal-body">
								<p>
									Trabajamos incesantemente en la protección de nuestra información, por lo que en esta oportunidad  hacemos de su conocimiento los términos y condiciones que debe tener en cuenta al momento de utilizar este Sistema Informático: La información existente en el presente Sistema Informático es parte de los activos intangibles de Oleaginosas del Perú S.A. - OLPESA, por lo que exclusivamente debe ser utilizado para los fines y objetivos que persigue OLPESA, asimismo, el diseño y demás componentes del presente Sistema Informático son tambien de nuestra propiedad por lo que cualquier intento de replicación, intrusión y/o acción que tenga como objetivo limitar parcial o totalmente el funcionamiento de este Sistema Informático se someterá a las acciones legales que OLPESA emprenda. 
								</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
				<div class="cnt_b">
					<div class="form-group">
						<div class="input-group input-group-sm">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-th"></i></span>
							<input id="up_dni" name="up_dni" class="form-control" type="text" placeholder="Dni" >
							<div class="input-group-btn"><button id="checkregister" type="button" class="btn btn-default">consultar</button></div>
						</div> 
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-user"></i></span>
							<input class="form-control input-sm" type="text" id="r_username" name="r_username" placeholder="Usuario" value="">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control input-sm" type="password" id="r_password" name="r_password" placeholder="Contraseña" value="">
						</div>
					</div>
					<div id="divmail" class="form-group">
						<div class="input-group">
							<span class="input-group-addon input-sm">@</span>
							<input class="form-control input-sm" type="text" id="r_email" name="r_email" placeholder="Correo electrónico" value="">
						</div>
						<span id="up_msg" class="help-block">La dirección de correo electrónico se utilizará para recuperar su credencial por lo que debe ser una cuenta de correo corporativa de Oleaginosas del Perú S.A.</span>
					</div>
				</div>
				<div class="btm_b tac">
					<button id="up_button" type="button" class="btn btn-default" >Darse de Alta</button>
				</div>  
			</form>
			
			<div class="links_b links_btm clearfix">
				<span class="linkform"><a href="#pass_form">Se olvidó su contraseña?</a></span>
				<span class="linkform" style="display:none">Intentalo nuevamente, <a href="#login_form">ir a la pantalla de Inicio de Sesion</a></span>
				<!--<span class="linkform" style="display:none">Intentalo nuevamente, <a href="#login_form">ir a la pantalla de Inicio de Sesion</a></span>-->
			</div>
			
		</div>
		 
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.actual.min.js"></script>
        <script src="assets/lib/validation/jquery.validate.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/lib/sweetalert/sweetalert.min.js" ></script>
		
		<script src="assets/lib/sweetalert/sweetalert.min.js" ></script>
		<script src="assets/lib/toast/jquery.toast.min.js" ></script>
		
		<?php include 'assets/xcalling/mall_login_driver.php'; ?>
		
		<script>
		//Refresh Captcha
			function refreshCaptcha(){
				var img = document.images['captcha_image'];
				img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
			}
		</script>
		
    </body>
</html>
