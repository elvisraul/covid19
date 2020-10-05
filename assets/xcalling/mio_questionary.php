<script type="text/javascript">
	
	var questionsselected=new Array();
	var reasonarray= new Array();

	var tablequestionaryup=null;

	$(".chzn_b").chosen();

	$('#parameterup').val(0);
  	$('#parameterup').trigger("liszt:updated");
  	$('#parameterup').chosen({
		allow_single_deselect: true,
		width:"400px"
	});
	
	table = $('#alldata').DataTable({
		"bDestroy": true,
		"bDeferRender": true,
		"aProcessing": true,
		"aServerSide": true,
		"ajax":{
			url: "src/design/controllers/mio_questionary_controller.php",
			type: "POST",
			dataSrc: "data",
			data: {"action": "list"}
		},
		"aoColumns": [
				{ 'mData': 'id',"visible":false },
				{ 'mData': 'code' },
				{ 'mData': 'qname' },
				{ 'mData': 'rnames' },
				{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><a class='btn toolbar-icon btn-default btn-xs pdata' ><i class='glyphicon glyphicon-th-list'><span class='label label-primary label-row'>0</span></i></a></div>" },				
				{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><div style='padding-left: 0px' class='col-sm-6 col-xs-6'><a class='btn toolbar-icon btn-success btn-xs edata' ><i class='glyphicon glyphicon-pencil'></i></a></div><div style='padding-left: 1px' class='col-sm-6 col-xs-6'><a class='btn toolbar-icon btn-danger btn-xs rdata'><i class='glyphicon glyphicon-trash'></i></a></div></div>","sClass": "center", "bSortable": false, "width": "100px"}
		],
		"order": [[ 1, "desc" ]],
		"sPaginationType": "bootstrap",
		language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		"bInfo": false,
		"bPaginate": true,
		"rowCallback": function( row, data ) {
			//$('.bs-switch').bootstrapSwitch('state', false);
			//$($(row).find("td input.bs-switch")).bootstrapSwitch('state', false);
			$($(row).find("div a i span.label-row")).html(data.questions);
			//$($(row).find("div span.label-row")).html(data.questions);

		}
	});


	$('#alldata tbody').on('click','a.pdata',function () {
		var row=table.row( $(this).parents("tr") ).data();
		$("#modal_form_question").modal("show");
		$('#title').html('Cargar Preguntas');
		$('#savedataquestion').html('Guardar');
		$('#idq').val(row.id);
		/*$('#reason').val(row.rid);
		$('#reason').trigger("liszt:updated");*/
		$('#code').val(row.code);
		$('#titleq').val(row.qname);
		$('#active').bootstrapSwitch('state', row.active); // Set the state as off

		reasonarray= new Array();
		$("#reason").val(reasonarray);
		$('#reason').trigger("liszt:updated");

		loaddatatablequestionary(row.id);
		loadreason(row.id);

		
	});




	$('#alldata tbody').on('click','a.edata',function () {
		var row=table.row( $(this).parents("tr") ).data();
		$("#modal_form_up").modal("show");
		$('#titleup').html('Modificar Cuestionario');
		$('#updata').html('Actualizar');
		$('#idup').val(row.id);
		/*$('#reason').prop('disabled',true);
		$('#reason').val(row.rid);
		$('#reason').trigger("liszt:updated");*/
		$('#codeup').val(row.code);
		$('#nameup').val(row.qname);
		$('#descriptionup').val(row.description);
		$('#activeup').bootstrapSwitch('state', row.active); // Set the state as off

		loadvaluesparameter($("#idup").val());
		
	});



	$('#alldata tbody').on('click','a.rdata',function () {
		var row=table.row( $(this).parents("tr") ).data();

		if(row.questions>0){
			$.toast({
				text: '. .. ... no es posible eliminar <b >contiene preguntas</b> ! ',
				showHideTransition: 'slide',
				hideAfter: 1600,
				position: 'mid-center',
				icon: 'warning'
			});
		}else if(row.orientations>0){
			$.toast({
				text: '. .. ... no es posible eliminar <b >contiene orientaciones</b> ! ',
				showHideTransition: 'slide',
				hideAfter: 1600,
				position: 'mid-center',
				icon: 'warning'
			});
		}else{
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
					url: "src/design/controllers/mio_questionary_controller.php",
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
		}
		
	});



	$('#newdata').click(function() {
		$("#modal_form").modal("show");
		$('#title').html('Nuevo Cuestionario');
		$('#savedata').html('Guardar');
		$('#id').val(0);
		$('#code').val('');
		$('#name').val('');
		$('#description').val('');
		$('#active').bootstrapSwitch('state', false); // Set the state as off
		$('#reason').prop('disabled',false);

		let request = $.ajax({
		    url: "src/design/controllers/mio_questionary_controller.php",
		    type: "POST",
		    dataType: 'json',
		    data: {"action": "return_code"}
		});

		request.success(function(output) {
			var coderegenerated=zfill(output.code.toString(),3);
			$('#code').val(coderegenerated);
		});	
		request.success(function(output) {
			setTimeout(function () {
				/*$('#reason').val(0); 
				$("#reason").trigger('liszt:open');
				$("#reason").trigger('liszt:activate');
				$('#reason').trigger("liszt:updated");*/
				$('#name').focus();

			}, 300);
		});	

	});

	function zfill( number, width ){
		return number.padStart(width, 0); // siempre devuelve tipo cadena
	}




	$("#reason").chosen().change(function() {
		//$('#code').val($('#reason').val());
		//console.log($('#reason').val());
		//console.log(JSON.stringify($('#reason').val()));
		let request = $.ajax({
		    url: "src/design/controllers/mio_questionary_controller.php",
		    type: "POST",
		    dataType: 'json',
		    data: {"action": "put_reason","idqh":$("#idq").val(), "reasonarray": $('#reason').val() }
		});

		/*request.success(function(output) {
			console.log(output);
			//$('#code').val(output.code);
			var coderegenerated=zfill(output.code.toString(),3);
			if($('#reason').val()==4){
				$('#code').val('I'+coderegenerated);
			}else{
				$('#code').val('E'+coderegenerated);	
			}
			
		});	*/

	});

	var tablequestionary=null;

	$("#question").chosen().change(function() {

		$.ajax({
		 	url: "src/design/controllers/mio_questionary_controller.php",
		    type: "POST",
		    dataType: 'json',
		    data: {"action": "put_question","idqh":$("#idq").val(),"idq":$("#question").val()},
			success: function(data) {
				//console.log(data);
			},
			complete: function(data) {
				
				if(data.responseJSON.duplicated=='yes'){
					$.toast({
						text: '. .. ... pregunta <b >ya agregada</b> ! ',
						showHideTransition: 'slide',
						hideAfter: 2000,
						position: 'mid-center',
						icon: 'warning'
					});
				}else{
					tablequestionary.ajax.reload( null, false );	
				}
				
/*				setTimeout(function () {
					$('#question').val(0); 
					$("#question").trigger('liszt:open');
					$("#question").trigger('liszt:activate');
					$('#question').trigger("liszt:updated");
				}, 300);*/
			}
		});		


	});


	function loaddatatablequestionary(){
		tablequestionary = $('#datatablequestionary').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_questionary_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "list_questionary","idqh":$('#idq').val()}
			},
			"aoColumns": [
					{ 'mData': 'id',"visible":false },
					{ 'mData': 'position',"sClass": "center" },
					{ 'mData': 'name' },
					{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><a class='btn toolbar-icon btn-danger btn-xs rdata'><i class='glyphicon glyphicon-trash'></i></a></div></div>","sClass": "center", "bSortable": false, "width": '100px !important'}
			],
			"order": [[ 1, "asc" ]],
			"sPaginationType": "bootstrap",
			language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
			"bInfo": false,
			"bPaginate": true,
			"searching": false,
			"paging": false
		});
	}


	

	function loadreason(idqh){

		let request = $.ajax({
		    url: "src/design/controllers/mio_questionary_controller.php",
		    type: "POST",
		    dataType: 'json',
		    data: {"action": "list_orientarion","idqh":$('#idq').val()}
		});

		request.success(function(output) {
			reasonarray= new Array();
			if(output){
				if(output.data){
					$.each(output.data, function(k, v){
						reasonarray.push(v.id);
				  	});
				}
			}
			$("#reason").val(reasonarray);
			$('#reason').trigger("liszt:updated");
			
		});
		
	}


	function loaddatatablequestionary(idqh){
		tablequestionary = $('#datatablequestionary').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_questionary_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "list_questionary","idqh":idqh}
			},
			"aoColumns": [
					{ 'mData': 'id',"visible":false },
					{ 'mData': 'position',"sClass": "center", },
					{ 'mData': 'name' },
					{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><a class='btn toolbar-icon btn-danger btn-xs rdata'><i class='glyphicon glyphicon-trash'></i></a></div></div>","sClass": "center", "bSortable": false, "width": '100px !important'}
			],
			"order": [[ 1, "asc" ]],
			"sPaginationType": "bootstrap",
			language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
			"bInfo": false,
			"lengthChange": false,
			"searching": true,
			"paging": true
		});


		$('#datatablequestionary tbody').on('click','a.rdata',function () {
			var row=tablequestionary.row( $(this).parents("tr") ).data();
			swal({
				title: ". .. esta seguro?",
				text: "no podra recuperar el registro!",
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
					url: "src/design/controllers/mio_questionary_controller.php",
					data: {"action": "delete_question","id":row.id},
					success: function(data) {
						tablequestionary.ajax.reload( null, false );
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

	}


	
	$('#addparameter').click(function() {
		//$('#code').val($('#reason').val());
		//console.log($('#reason').val());
		//console.log(JSON.stringify($('#reason').val()));

		
		//console.log($('#activeup').bootstrapSwitch('state'));
		

		let request = $.ajax({
		    url: "src/design/controllers/mio_questionary_controller.php",
		    type: "POST",
		    dataType: 'json',
		    data: {"action": "put_parameter","idqh":$("#idup").val(), "parameter": $('#parameterup').val(),"value": $('#vparameterup').val()}
		});

		/*request.success(function(output) {
			table.ajax.reload( null, false );
		});*/

		request.complete(function(output) {
			loadvaluesparameter($("#idup").val());
		});

		


	});


	function loadvaluesparameter(idqh){
		tablequestionaryup = $('#datatableparameterup').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_questionary_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "load_valueparameters","idqh":idqh}
			},
			"aoColumns": [
					{ 'mData': 'id',"visible":false },
					{ 'mData': 'name'/*,"sClass": "center"*/},
					{ 'mData': 'value' },
					{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><a class='btn toolbar-icon btn-danger btn-xs rdata'><i class='glyphicon glyphicon-trash'></i></a></div></div>","sClass": "center", "bSortable": false, "width": '100px !important'}
			],
			/*"order": [[ 1, "asc" ]],*/
			"sPaginationType": "bootstrap",
			language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
			"bInfo": false,
			"lengthChange": false,
			"searching": true,
			"paging": true
		});


		$('#datatableparameterup tbody').on('click','a.rdata',function () { //INICIO ELIMINAR
			var row=tablequestionaryup.row( $(this).parents("tr") ).data();
				
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
					url: "src/design/controllers/mio_questionary_controller.php",
					data: {"action": "delete_parameter","idp":row.id},
					success: function(data) {
						tablequestionaryup.ajax.reload( null, false );
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
			
		});//FIN ELIMINAR



	}



	$('#updata').click(function() {
		

		$.ajax({
			type: "POST",
			dataType: "json",
			url: "src/design/controllers/mio_questionary_controller.php",
			data: {"id":$("#idup").val(),"code":$("#codeup").val(),"active":$('#activeup').bootstrapSwitch('state'),"name":$("#nameup").val(),"description":$("#descriptionup").val()},
			success: function(data) {
				$.toast({
					text: '. .. ... actualizado <b >Correctamente</b> !',
					showHideTransition: 'slide',
					hideAfter: 1600,
					position: 'mid-center',
					icon: 'success'
				});
				
				
				
			},
			complete: function(data) {
				table.ajax.reload( null, false );
				$('#modal_form_up').modal('hide');
			}
		});

	});


	$('#savedata').click(function() {
		var datos=$('#formdata').serialize();
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mio_questionary_controller.php",
			data: datos,
			success: function(data) {
				//console.log(data);
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


	$('#savedataquestion').click(function() {
		$('#modal_form_question').modal('hide');
		table.ajax.reload( null, false );
	});


	$.ajax({
		url: 'src/design/controllers/mio_questionary_controller.php',
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


	$.ajax({
		url: 'src/design/controllers/mio_questionary_controller.php',
		dataType: 'json',
		type: 'POST',
		data: {"action": "reference_question"},
		success: function(response) {
			$.each(response.data, function(k, v){
				$('#question').append('<option value="'+v.id+'">'+v.precision+'</option>');
		  	});
		  	$('#question').trigger("liszt:updated");
		  	$('#question').chosen({
				allow_single_deselect: true,
				width:"400px"
			});
		},error: function(response) {

		}
	});

	$.ajax({
		url: 'src/design/controllers/mio_questionary_controller.php',
		dataType: 'json',
		type: 'POST',
		data: {"action": "reference_parameter"},
		success: function(response) {
			$.each(response.data, function(k, v){
				$('#parameterup').append('<option value="'+v.id+'">'+v.name+'</option>');
		  	});
		  	$('#parameterup').trigger("liszt:updated");
		  	$('#parameterup').chosen({
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