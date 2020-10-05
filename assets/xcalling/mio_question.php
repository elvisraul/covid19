<script type="text/javascript">
	table = $('#alldata').DataTable({
		"bDestroy": true,
		"bDeferRender": true,
		"aProcessing": true,
		"aServerSide": true,
		"ajax":{
			url: "src/design/controllers/mio_question_controller.php",
			type: "POST",
			dataSrc: "data",
			data: {"action": "list"}
		},
		"aoColumns": [
				{ 'mData': 'id',"visible":false },
				{ 'mData': 'code' },
				{ 'mData': 'name' },
				{ 'mData': 'optional' },
				{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><div style='padding-left: 0px' class='col-sm-6 col-xs-6'><a class='btn toolbar-icon btn-success btn-xs edata' ><i class='glyphicon glyphicon-pencil'></i></a></div><div style='padding-left: 1px' class='col-sm-6 col-xs-6'><a class='btn toolbar-icon btn-danger btn-xs rdata'><i class='glyphicon glyphicon-trash'></i></a></div></div>","sClass": "center", "bSortable": false, "width": "100px"}
		],
		"order": [[ 1, "desc" ]],
		"sPaginationType": "bootstrap",
		language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		"bInfo": false,
		"bPaginate": true
	});


	$('#alldata tbody').on('click','a.edata',function () {
		var row=table.row( $(this).parents("tr") ).data();
		$("#modal_form").modal("show");
		$('#title').html('Modificar Pregunta');
		$('#savedata').html('Actualizar');
		$('#id').val(row.id);
		$('#code').val(row.code);
		$('#precision').val(row.name);
		$('#optional').bootstrapSwitch('state', row.active); // Set the state as off
		
	});



	$('#alldata tbody').on('click','a.rdata',function () {
		var row=table.row( $(this).parents("tr") ).data();
		swal({
			title: ". .. esta seguro?",
			text: "no podra recuperar el dato eliminado!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Si, eliminar!",
			cancelButtonText: "cancelar",
			closeOnConfirm: true
		},
		function() {
			$.ajax({
				type: "POST",
				url: "src/design/controllers/mio_question_controller.php",
				data: {"action": "delete","id":row.id},
				success: function(data) {
					table.ajax.reload( null, false );
				},
				complete: function(data) {
					$.toast({
						text: '. .. ... eliminado <b >Correctamente</b> ! ',
						showHideTransition: 'slide',
						hideAfter: 1000,
						position: 'mid-center',
						icon: 'success'
					});
				}
			});
		});
	});



	$('#newdata').click(function() {
		$("#modal_form").modal("show");
		$('#title').html('Nueva Pregunta');
		$('#savedata').html('Guardar');
		$('#id').val(0);
		$('#code').val('');
		$('#precision').val('');
		$('#optional').bootstrapSwitch('state', true); // Set the state as off

		let requestCode = $.ajax({
		    url: "src/design/controllers/mio_question_controller.php",
		    type: "POST",
		    dataType: 'json',
		    data: {"action": "return_code" }
		});

		requestCode.success(function(output) {
			var coderegenerated=zfill(output.code.toString(),4);
			$('#code').val(coderegenerated);
			
		});	

	});

	function zfill( number, width ){
		return number.padStart(width, 0); // siempre devuelve tipo cadena
	}

	$("#reason").chosen().change(function() {
		//$('#code').val($('#reason').val());
		let request = $.ajax({
		    url: "src/design/controllers/mio_question_controller.php",
		    type: "POST",
		    dataType: 'json',
		    data: {"action": "return_code", "reasonid": $('#reason').val() }
		});

		request.success(function(output) {
			console.log(output);
			//$('#code').val(output.code);
			var coderegenerated=zfill(output.code.toString(),3);
			if($('#reason').val()==4){
				$('#code').val('I'+coderegenerated);
			}else{
				$('#code').val('E'+coderegenerated);	
			}
			
		});	

	});



	$('#savedata').click(function() {
		var datos=$('#formdata').serialize();
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mio_question_controller.php",
			data: datos,
			success: function(data) {
				console.log(data);
				$('#modal_form').modal('hide');
				table.ajax.reload( null, false );
			},
			complete: function(data) {
				$.toast({
					text: '. .. ... '+(($('#id').val()==0)?'guardado':'actualizado')+' <b >Correctamente</b> !',
					showHideTransition: 'slide',
					hideAfter: 1600,
					position: 'mid-center',
					icon: 'success'
				});
			}
		});

	});


	$.ajax({
		url: 'src/design/controllers/mio_question_controller.php',
		dataType: 'json',
		type: 'POST',
		data: {"action": "reference_reason"},
		success: function(response) {
			$.each(response.data, function(k, v){
				$('#reason').append('<option value="'+v.id+'">'+v.name+'</option>');
		  	});
		  	$('#reason').trigger("liszt:updated");
		  	$('#reason').chosen({
				allow_single_deselect: true,
				width:"400px"
			});
		},error: function(response) {

		}
	});


	$('#canceldata').click(function() {
		$('#modal_form').modal('hide');
	}); 
</script>