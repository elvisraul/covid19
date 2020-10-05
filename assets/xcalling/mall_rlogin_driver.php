<script type="text/javascript">
	$(document).ready(function() {
		
		
		var form_wrapper = $('.login_box');
		function boxHeight()
		{
			form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);
		};
		form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });




		$('#resetoption').click(function() {

			var data = {'resetdate':$('#resetdate').val(),'username':$('#username').val(),'password':btoa($('#password').val())};
			upassword=$('#password').val();
			ucpassword=$('#cpassword').val();
			console.log(data);

			if (upassword.length<6 || ucpassword.length<6) {
				$.toast({
					text: ' La contraseña debe contener un <b>mínimo de 6 caracteres</b> !',
					showHideTransition: 'slide',
					hideAfter: 2500,
					position: 'mid-center',
					icon: 'error'
				});
			}else{
				if (upassword.length==ucpassword.length) {
					if(upassword===ucpassword){
						$.ajax({
							type: "POST",
							url: "src/design/controllers/mall_rlogin_controller.php",
							data: {'action':"resetpassword",'data':JSON.stringify(data)},
							dataType: 'json',
							success: function(data) {
								if (data.update === 'si') {
									$.toast({
										text: ' Contraseña actualizada <b>correctamente</b> !',
										showHideTransition: 'slide',
										hideAfter: 2500,
										position: 'mid-center',
										icon: 'success'
									});	
								} else {
									$.toast({
										text: ' Orden de actualización <b> no válida</b> !',
										showHideTransition: 'slide',
										hideAfter: 2500,
										position: 'mid-center',
										icon: 'error'
									});
								}
								$('#password').prop('disabled',true);
								$('#password').val('')
								$('#cpassword').prop('disabled',true);
								$('#cpassword').val('')
								$('#resetoption').prop('disabled',true);

							}
						});
					}else{
						$.toast({
							text: ' Las contraseñas <b>no coinciden</b> !',
							showHideTransition: 'slide',
							hideAfter: 2500,
							position: 'mid-center',
							icon: 'error'
						});	
					}
				}else{
					$.toast({
						text: ' Las contraseñas <b>no coinciden</b> !',
						showHideTransition: 'slide',
						hideAfter: 2500,
						position: 'mid-center',
						icon: 'error'
					});	
				}
			}
			/*if (uname.length>0 && upassword.length>0 && captcha.length>0) {

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
								/*text: returnedValue.msg,
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
			}*/

		});		
		
		
	});
	
	
		
</script>
