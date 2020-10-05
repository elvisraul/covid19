<script>

	function itemshow(value){
		switch(value){
		case 'questionario' : itemshowcalling(value); break;
		case 'pregunta' : itemshowcalling(value); break;
		case 'almacen' : itemshowcalling(value); break;
		case 'producto' : itemshowcalling(value); break;
		case 'precio' : itemshowcalling(value); break;
		case 'produccion' : itemshowcalling(value); break;
		case 'ingreso' : itemshowcalling(value); break;
		case 'salida' : itemshowcalling(value); break;
		case 'compras' : itemshowcalling(value); break;
		case 'requerimiento' : itemshowcalling(value); break;
		case 'tipo_cambio' : itemshowcalling(value); break;
		case 'reporte_asistencia' : itemshowcalling(value); break;
		case 'asistencia' : itemshowcalling(value); break;
		case 'file' : fileGuide(); break;
		}
	}

	function itemshowcalling(value){
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mio_all_controller.php",
			data: {'internal':value},
			dataType :"json",
			success: function(data) {
			},complete:function(data) {
				var returnedValue=data.responseJSON;
				$("#internals").load(returnedValue.content, function() {
					$('#internals').append(returnedValue.foot);
				});
			}
		});
	}



	$('#resetDefault').click(function() {
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mprocess_all_controller.php",
			data: {"internal":"thisfile"},
			dataType :"json",
			success: function(data) {
				console.log(data);
				/*document.location = data.url;
				url = $(this).attr("href");*/
      			window.open(data.url, '_blank');
			}
		});
	});

	$('#logoutall').click(function() {
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mall_login_controller.php",
			data: {"action":"close_session"},
			success: function(data) {
      			window.location.href = 'mall_login.php';
			}
		});
	});	




</script>