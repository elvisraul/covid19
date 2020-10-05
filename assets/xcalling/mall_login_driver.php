<script type="text/javascript">
	$(document).ready(function() {
		
		
		var form_wrapper = $('.login_box');
		function boxHeight()
		{
			form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);
		};
		form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });

		$('.linkform a,.link_reg a').on('click',function(e) {
			var target	= $(this).attr('href'),
			target_height = $(target).actual('height');
			$(form_wrapper).css({
				'height'		: form_wrapper.height()
			});
			$(form_wrapper.find('form:visible')).fadeOut(400,function() {
				form_wrapper.stop().animate({
					height	 : target_height,
					marginTop: ( - (target_height/2) - 24)
				},500,function() {
					$(target).fadeIn(400);
					$('.links_btm .linkform').toggle();
					$(form_wrapper).css({
						'height'		: ''
					});
				});
			});
/*e.preventDefault();*/
		});


		var validation=function() {
			$('#login_form').validate({
				onkeyup: false,
				errorClass: 'error',
				validClass: 'valid',
				rules: {
					username: { required: true, minlength: 3 },
					password: { required: true, minlength: 3 }
				},
				highlight: function(element) {
					$(element).closest('.form-group').addClass("f_error");
					setTimeout(function() {
						boxHeight()
					}, 200)
				},
				unhighlight: function(element) {
					$(element).closest('.form-group').removeClass("f_error");
					setTimeout(function() {
						boxHeight()
					}, 200)
				},
				errorPlacement: function(error, element) {
					$(element).closest('.form-group').append(error);
				}
			});
		}

		$('#up_button').click(function() {
			$.ajax({
				type: "POST",
				url: "src/design/controllers/mall_login_controller.php",
				data: {"action":'registerup',"dni":$('#up_dni').val(),"pa":$('#r_username').val(),"pp":btoa($('#r_password').val())},
				dataType: 'json',
				success: function(data) {
					console.log(data);
					$.toast({
						text: '. .. ... usuario registrado <b >Correctamente</b> ! ',
						showHideTransition: 'slide',
						hideAfter: 2000,
						position: 'mid-center',
						icon: 'success'
					});
				},complete: function(data) {
					$('#up_button').prop('disabled', true);
					$('#r_password').prop( 'readonly', true);
					$('#r_username').prop( 'readonly', true );
					$('#r_email').prop( 'readonly', true );
					$('#r_password').val('');
					$('#r_username').val('');
					$('#r_email').val('');
					$('#up_dni').val('');
					$('#checkregister').prop('disabled', false);
				}
			});
			

		});

		$('.link_reg').click(function() {
			$('#up_button').prop('disabled', true);
			$('#r_password').prop( 'readonly', true);
			$('#r_username').prop( 'readonly', true );
			$('#r_email').prop( 'readonly', true );
			$('#r_password').val('');
			$('#r_username').val('');
			$('#r_email').val('');
		});

		


		$('#checkregister').click(function() {
			$('#r_password').prop( 'readonly', true);
			$('#r_username').prop( 'readonly', true );
			$('#r_email').prop( 'readonly', true );
			$('#r_password').val('');
			$('#r_username').val('');
			$('#r_email').val('');
			$('#divmail').removeClass('f_error');
			$('#up_button').prop('disabled', true);
			$('#up_msg').text("La dirección de correo electrónico se utilizará para recuperar su credencial por lo que debe ser una cuenta de correo corporativa de Oleaginosas del Perú S.A.");

			$.ajax({
				type: "POST",
				url: "src/design/controllers/mall_login_controller.php",
				data: {"action":'activate',"dni":$('#up_dni').val()},
				dataType: 'json',
				success: function(data) {
					console.log(data);
					if (data.verified === 'true') {
						if (data.completed === 'false') {
							if (data.mailx === 'true') {
								$('#r_password').prop( 'readonly', false);
								$('#r_username').prop( 'readonly', true );
								$('#r_email').prop( 'readonly', true );
								$('#r_username').val(data.alias);
								$('#r_email').val(data.mail);
								$('#r_password').focus();
								$('#up_msg').text("Digite una contraseña para su cuenta, se sugiere que la contraseña que digite sea diferente a la contraseña de su correo");
								$('#up_button').prop('disabled', false);
							}else{
								$('#r_username').val(data.alias);
								$('#r_email').val(data.mail);
								$('#divmail').addClass('f_error');
								$('#up_msg').text("Para continuar, antes debe solicitar su cuenta de correo corporativo.");
							}
						}else{
							$('#checkregister').prop('disabled', true);
							$('#up_button').prop('disabled', true);
							$('#up_msg').text("Ud. cuenta con registro correcto");
						}
					}else{
						$('#up_msg').text("El uso del sistema está solo permitido al personal acreditado, por lo que, solo el intento de vulnerarlo otorga recursos y motivos a Oleaginosas del Peru S.A. de proceder según corresponda en las instancias pertinentes.");
						$('#checkregister').prop('disabled', true);
					}
						
						
						//$('.alert-login-in').html('Valide su credencial una ves más...');
					
				}
			});
		});

		$('#in_button').click(function() {

			var criterio = $("#login_form").serialize();
			var uname=$('#username').val();
			var upassword=$('#password').val();
			var captcha=$('#captcha').val();


			console.log(uname);
			console.log(criterio);
			if (uname.length>0 && upassword.length>0 && captcha.length>0) {

				var prepare=[{'username':uname,'password':btoa(upassword),'captcha':captcha}];
				var info={"data":prepare};

				$.ajax({
					type: "POST",
					url: "src/design/controllers/mall_login_controller.php",
					data: {'json':JSON.stringify(info)},
					dataType: 'json',
					success: function(data) {
						if (data.login === 'true') {
							window.location.href = data.url;
						} else {
							$('.alert-login-in').removeClass('alert-danger').addClass('alert-info');
							$('.alert-login-in').html('Valide su credencial una ves más...');
						}
					},
					complete: function(data) {
						var returnedValue=data.responseJSON;
						if (returnedValue.login === 'false') {
							$.toast({
								text: ' credencial <b>incorrecta</b> !',
								showHideTransition: 'slide',
								hideAfter: 1600,
								position: 'mid-center',
								icon: 'error'
							});
							$('#username').val('');
							$('#password').val('');
							$('#captcha').val('');
							refreshCaptcha();
							setTimeout(function () {
								$('#username').focus();
							}, 300);
						} else if (returnedValue.login === 'error') {
							$.toast({
/*text: ' no podemos '+returnedValue.msg+' atenderlo !',*/
								text: returnedValue.msg,
								showHideTransition: 'slide',
								hideAfter: 1600,
								position: 'mid-center',
								icon: 'error'
							});
							$('#username').val('');
							$('#password').val('');
							$('#captcha').val('');
							refreshCaptcha();
							setTimeout(function () {
								$('#password').focus();
							}, 300);

						} else if (returnedValue.login === 'robot') {
							$.toast({
								text: ' codigo de verificación <b>incorrecto</b> !',
								showHideTransition: 'slide',
								hideAfter: 1600,
								position: 'mid-center',
								icon: 'error'
							});
							$('#captcha').val('');
							refreshCaptcha();
							setTimeout(function () {
								$('#captcha').focus();
							}, 300);

						}


					}
				});


			} else {
				$('.alert-login-in').removeClass('alert-info').addClass('alert-danger');
				var empty='';
				if (uname.length == 0) {
					empty='El <b>nombre de usuario</b>';
				}
				if (upassword.length == 0) {
					if (empty.length==0) {
						empty='La <b>contraseña</b> ';
					} else {
						empty+=' y <b>contraseña</b>';
					}
				}
				if (captcha.length==0) {
					if (empty.length==0) {
						empty='El <b>código de verificación</b> ';
					} else {
						if (empty.length>30) {
							empty= empty.replace('y',',');
							empty+=' y <b>código de verificación</b>';
						} else {
							empty+=' y <b>código de verificación</b>';
						}
					}
				}

				$('.alert-login-in').html(empty+' es requerido');
			}

		});


		$('#reset_button').click(function() {

			var umail=$('#mail').val();
			console.log(umail);
			if (umail.length>0) {
				if (validMail(umail)) {
					$.ajax({
						type: "POST",
						url: "src/design/controllers/mall_login_controller.php",
						data: {"mail":umail,"action":"check"},
						dataType: 'json',
						success: function(data) {
							console.log(data);
							if (data.send === 'true') {
								$('.alert-login-reset').removeClass('alert-danger').addClass('alert-info');
								$('.alert-login-reset').html('Se ha enviado un enlace a su correo mediante el cual podrá restablecer su contraseña ');
							} else {
								$('.alert-login-reset').removeClass('alert-info').addClass('alert-danger');
								$('.alert-login-reset').html('Ingrese un correo coporativo que corresponda ha Oleaginosas del Perú S.A.');
							}
						},
						complete: function(data) {
							console.log(data);
							var returnedValue=data.responseJSON;
							console.log(returnedValue);
							if (returnedValue.send === 'true') {
								$('.alert-login-reset').removeClass('alert-danger').addClass('alert-info');
								$('.alert-login-reset').html('Se ha enviado un enlace a su correo mediante el cual podrá restablecer su contraseña ');
							}
						}
					});
				} else {
					$('.alert-login-reset').removeClass('alert-info').addClass('alert-danger');
					$('.alert-login-reset').html('El correo ingresado no es válido');
				}
			}else{
				$('.alert-login-reset').removeClass('alert-info').addClass('alert-danger');
				$('.alert-login-reset').html('El correo es requerido');
			}
		});
		
		
		
	});
		
		
	function validMail(valor){
		if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(valor)) {
			return(true);
		} else {
			return(false);
		}
	}
	
		
</script>
