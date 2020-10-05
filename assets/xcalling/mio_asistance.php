<script type="text/javascript">
	
	tableissuegeneral=null;
	tabledatahistorialtemperature=null;
	reasonselected=null;
	var questionaries=0;
	var questionaryfill=new Array();
	$('#sex').trigger("liszt:updated");
  	$('#sex').chosen({
		allow_single_deselect: true,
		width:"400px"
	});

	table = $('#alldata').DataTable({
		"bDestroy": true,
		"bDeferRender": true,
		"aProcessing": true,
		"aServerSide": true,
		"ajax":{
			url: "src/design/controllers/mio_asistance_controller.php",
			type: "POST",
			dataSrc: "data",
			data: {"action": "list"}
		},
		"aoColumns": [
				{ 'mData': 'id',"visible":false },
				{ 'mData': 'registration', "width": "180px"},
				{ 'mData': 'action', "width": "100px"},
				{ 'mData': 'code' },
				{ 'mData': 'complete' },
                { 'mData': 'phone' },
				{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><div style='padding-left: 0px' class='col-sm-6 col-xs-6'><a class='btn toolbar-icon btn-default btn-xs edata' ><i class='glyphicon glyphicon-th-list'></i></a></div><div style='padding-left: 1px' class='col-sm-6 col-xs-6'><a class=' btn toolbar-icon btn-default btn-xs rdata' title='Questionarios'><i class='glyphicon glyphicon-heart-empty'><span class='label label-primary label-row'>0</span></i></a></div></div>","sClass": "center", "bSortable": false, "width": "100px"}
		],
		"order": [[ 1, "desc" ]],
		"sPaginationType": "bootstrap",
		language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
		"bInfo": false,
		"bPaginate": true,
		"rowCallback": function( row, data ) {
			//$('.bs-switch').bootstrapSwitch('state', false);
			//$($(row).find("td input.bs-switch")).bootstrapSwitch('state', false);
			$($(row).find("div div a i span.label-row")).html(data.quantity);
			if(data.temperature !== null){
				$($(row).find("div div a.rdata")).removeClass("btn-default");
				$($(row).find("div div a.rdata")).addClass('btn-info');
			}
			if(data.fill == 'SI'){
				$($(row).find("div div a.edata")).removeClass("btn-default");
				$($(row).find("div div a.edata")).addClass('btn-info');
			}


		}
	});


	$('#alldata tbody').on('click','a.edata',function () {
		var row=table.row( $(this).parents("tr") ).data();

		$("#modal_form").modal("show");
		$('#title').html('CUESTIONARIOS');
		
		$('#savedata').html('Guardar');
		$('#savetemloadissue').html('Guardar Temperatura y Abrir Cuestionario');
		$('#reason').prop('disabled', false);

		$("#accordion2" ).html("");

		loadreason(row.worker,row.idreason);
		$("#temperature").val(row.temperature);
		$("#idtemperature").val(row.idtemperature);
		$("#idquiz").val(row.idquiz);
		$("#answered").val(row.fill);
		$("#idreason").val(row.idreason);
		//if(row.fill=='SI'){
		/*if($("#answered").val()=='SI'){
			$('#savedata').html('Cerrar');
			$('#savetemloadissue').html('Guardar Temperatura');
			$('#reason').prop('disabled', true);
		}else{

		}
		if(row.oldtemperature>0){
			$('#reason').prop('disabled', true);
		}*/



		if($("#answered").val()=='SI'){
			let requestquestionary = $.ajax({
			    url: "src/design/controllers/mio_asistance_controller.php",
				type: "POST",
				dataType: 'json',
				data: {"action": "load_questionary","idrecurrence":$("#idquiz").val(),"idreason":$("#idreason").val()}
			});
		

			requestquestionary.success(function(response) {
				//console.log(response);
				var htmlaccordion="";
				var quantity=1;
				$.each(response.data, function(k, v){
					//$('#chosen_l').append('<option value="'+v.id+'">'+v.fullname+'</option>');
					//console.log(k);
					//console.log(k+'-'+v.numeration);
					var htmlaccordionquestion="";
					$.each(v.questions, function(kk, vv){
							htmlaccordionquestion=htmlaccordionquestion.concat(	"<tr>"+
                                "<td style='display:none'>"+vv.id+"</td>"+
                                "<td>"+vv.position+"</td>"+
                                "<td>"+vv.precision+"</td>"+
                                "<td><input type='checkbox' class='bs-switch chzn_b flag flags"+vv.id+"' data-size='mini' data-on-text='SI' data-off-text='NO'/></td>"+
                                "<td><input type='text' readonly='true' class='form-control input-note' value='"+(vv.note==null?"":vv.note)+"'/></td>"+
                            	"</tr>");
							});

					htmlaccordion=htmlaccordion.concat("<div class='panel panel-default'>"+
									"<div class='panel-heading'>"+
										"<a href='#collapseOne"+v.numeration+"' data-parent='#accordion2' data-toggle='collapse' class='accordion-toggle collapsed'>"+v.name+"</a>"+
									"</div>"+
									"<div class='panel-collapse "+(quantity==1?"in":"collapse")+"' id='collapseOne"+v.numeration+"'>"+
										"<div class='panel-body'>"+v.description+"</div>"+
										"<div class='panel-body'>"+
											"<table id='tableissue"+v.numeration+"' class='table table-striped'>"+
											htmlaccordionquestion+
											"</table>"+
										"</div>"+
									"</div>"+
								"</div>");
					questionaries=quantity;
					quantity++;

			  	});

			  	$("#accordion2" ).html(htmlaccordion);

			});

			requestquestionary.complete(function(response) {
				$.each(response.responseJSON.data, function(k, v){
					$.each(v.questions, function(kk, vv){
						//console.log(v.numeration);
						$('.flags'+vv.id).bootstrapSwitch('state', vv.value);
						$('.flags'+vv.id).bootstrapSwitch('disabled', true);
						
					});
				});
			});

		}




	});



	function loadreason(isworker,idreason){
		$.ajax({
			url: 'src/design/controllers/mio_asistance_controller.php',
			dataType: 'json',
			type: 'POST',
			data: {"action": "load_reason"},
			success: function(response) {
				$('#reason').empty();	
				$.each(response.data, function(k, v){
					if(isworker=='SI'){
						if(v.id==4){
							$('#reason').append('<option value="'+v.id+'">'+v.name+'</option>');
						}
					}else{
						if(v.id!=4){
							$('#reason').append('<option value="'+v.id+'">'+v.name+'</option>');
						}
					}
			  	});
			  	if(isworker=='NO'){
			  		//$('#reason').val(3);
			  		$('#reason').val(idreason);
			  	}

			  	$('#reason').trigger("liszt:updated");
			  	$('#reason').chosen({
					allow_single_deselect: true,
					width:"400px"
				});
			},error: function(response) {

			}
		});

	}

	$('#savetemloadissue').click(function() {
		var tempvalue=$("#temperature").val();
		if(tempvalue.length>1){
			if (tempvalue>30 && tempvalue<45 ) {

				let requesttemp = $.ajax({
				    url: "src/design/controllers/mio_asistance_controller.php",
					type: "POST",
					dataType: 'json',
					data: {"action": "put_temperature","idtemperature":$("#idtemperature").val(),"temperature":$("#temperature").val(),"idreason":$("#reason").val()}
				});

				requesttemp.success(function(output) {
					table.ajax.reload( null, false );
				});

				if($("#answered").val()!='SI'){
					let requestquestionary = $.ajax({
					    url: "src/design/controllers/mio_asistance_controller.php",
						type: "POST",
						dataType: 'json',
						data: {"action": "load_questionary","idrecurrence":$("#idquiz").val(),"idreason":$("#reason").val()}
					});
				

					requestquestionary.success(function(response) {
						//console.log(response);
						var htmlaccordion="";
						var quantity=1;
						$.each(response.data, function(k, v){
							//$('#chosen_l').append('<option value="'+v.id+'">'+v.fullname+'</option>');
							//console.log(k);
							//console.log(k+'-'+v.numeration);
							var htmlaccordionquestion="";
							$.each(v.questions, function(kk, vv){
									htmlaccordionquestion=htmlaccordionquestion.concat(	"<tr>"+
		                                "<td style='display:none'>"+vv.id+"</td>"+
		                                "<td>"+vv.position+"</td>"+
		                                "<td>"+vv.precision+"</td>"+
		                                "<td><input type='checkbox' class='bs-switch chzn_b flag flags"+vv.id+"' data-size='mini' data-on-text='SI' data-off-text='NO'/></td>"+
		                                "<td><input type='text' class='form-control input-note' value='"+(vv.note==null?"":vv.note)+"'/></td>"+
		                            	"</tr>");
									});

							htmlaccordion=htmlaccordion.concat("<div class='panel panel-default'>"+
											"<div class='panel-heading'>"+
												"<a href='#collapseOne"+v.numeration+"' data-parent='#accordion2' data-toggle='collapse' class='accordion-toggle collapsed'>"+v.name+"</a>"+
											"</div>"+
											"<div class='panel-collapse "+(quantity==1?"in":"collapse")+"' id='collapseOne"+v.numeration+"'>"+
												"<div class='panel-body'>"+v.description+"</div>"+
												"<div class='panel-body'>"+
													"<table id='tableissue"+v.numeration+"' class='table table-striped'>"+
													htmlaccordionquestion+
													"</table>"+
												"</div>"+
											"</div>"+
										"</div>");
							questionaries=quantity;
							quantity++;

					  	});

					  	$("#accordion2" ).html(htmlaccordion);

					});

					requestquestionary.complete(function(response) {
						//console.log(response.responseJSON);
						$.each(response.responseJSON.data, function(k, v){
							$.each(v.questions, function(kk, vv){
								//console.log(v.numeration);
								$('.flags'+vv.id).bootstrapSwitch('state', vv.value);
							});
						});
					});

				}

			}
		}else{
			$.toast({
				text: '. .. ... temperatura <b>No válido</b> ! ',
				showHideTransition: 'slide',
				hideAfter: 1500,
				position: 'mid-center',
				icon: 'warning'
			});
		}


	});


	function loadissues(idquiz){
		tableissuegeneral = $('#tableissuegeneral').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_asistance_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "load_issuesgeneral"}
			},
			"aoColumns": [
					{ 'mData': 'id',"visible":false },
					{ 'mData': 'position',"width": "10%px "},
					{ 'mData': 'nameq',"width": "100% " },
					{ 'defaultContent': "<input name='restricted' type='checkbox'  data-on-text='SI' data-off-text='NO' class='bs-switch' data-size='mini' />" },
					{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><input class='form-control input-xs' style='height: 23px' type='text' /></div>","sClass": "center", "bSortable": false, "width": "10%"}
			],
			"sPaginationType": "bootstrap",
			language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
			"bInfo": false,
			"searching": false,
			"paging": false,
			"ordering":  false,
			"autoWidth": false,
			"rowCallback": function( row, data ) {
				$(row).find("input.bs-switch").bootstrapSwitch('state', false);
			
			}
		});
	}


	function loadissues(){
		tableissuegeneral = $('#tableissuegeneral').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_asistance_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "load_issuesgeneral"}
			},
			"aoColumns": [
					{ 'mData': 'id',"visible":false },
					{ 'mData': 'position',"width": "10%px "},
					{ 'mData': 'nameq',"width": "100% " },
					{ 'defaultContent': "<input name='restricted' type='checkbox'  data-on-text='SI' data-off-text='NO' class='bs-switch' data-size='mini' />" },
					{ 'defaultContent': "<div class='col-sm-12 col-xs-12'><input class='form-control input-xs' style='height: 23px' type='text' /></div>","sClass": "center", "bSortable": false, "width": "10%"}
			],
			"sPaginationType": "bootstrap",
			language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
			"bInfo": false,
			"searching": false,
			"paging": false,
			"ordering":  false,
			"autoWidth": false,
			"rowCallback": function( row, data ) {
				$(row).find("input.bs-switch").bootstrapSwitch('state', false);
			
			}
		});
	}


	function loadhistorialtemperature(idvisit){
		tabledatahistorialtemperature = $('#datahistorialtemperature').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_asistance_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "load_historialtemperature","idvisit":idvisit}
			},
			"aoColumns": [
					{ 'mData': 'turn'},
					{ 'mData': 'action'},
					{ 'mData': 'registration',"width": "70%px "},
					{ 'mData': 'temperature',"width": "20% " }
			],
			"sPaginationType": "bootstrap",
			language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
			"bInfo": false,
			"searching": false,
			"paging": false,
			"ordering":  false,
			"autoWidth": false
		});
	}




	function loaduserolpesoft(bid){
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mio_asistance_controller.php",
			data: {"action": "load_userolpesoft","id":bid},
			dataType: 'json',
			success: function(data) {
				if (data.exist=='yes') {
					$('#lxcode').val(data.code);
					$('#lxalias').val(data.alias);
					$('#lxusername').val(data.username);
					$('#usergenerate').prop('disabled',true);
				}else{
					$('#lxcode').val('');
					$('#lxalias').val('');
					$('#lxusername').val('');
				}
			}
		});
	}


	$('#alldata tbody').on('click','a.rdata',function () {
		var row=table.row( $(this).parents("tr") ).data();

		$("#modal_formheart").modal("show");
		$('#titleheart').html('HISTORIAL DE TEMPERATURA CORPORAL');
		
		loadhistorialtemperature(row.idvisit);

	});



	$('#usergenerate').click(function() {
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mio_asistance_controller.php",
			data: {"action": "generate_user","dni":$('#lcode').val(),"pp":btoa($('#lcode').val())},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				if (data.success=='true') {
					$('#lxcode').val(data.code);
					$('#lxalias').val(data.alias);
					$('#lxusername').val(data.username);
					$('#usergenerate').prop('disabled',true);
				}else{
					$('#lxcode').val('');
					$('#lxalias').val('');
					$('#lxusername').val('');
				}
				
			}
		});
	});

	$('#newdata').click(function() {
		$("#modal_form").modal("show");
		$('#title').html('Nuevo Almacen');
		$('#savedata').html('Guardar');
		$('#id').val(0);
		$('#code').val('');
		$('#name').val('');
		$('#description').val('');
        $('#address').val('');
        $('#chosen_a').val(0);
        $('#chosen_a').trigger("liszt:updated");
        $('#chosen_l').val(0);
        $('#chosen_l').trigger("liszt:updated");
		setTimeout(function () {
			$('#code').focus();
		}, 300);
	});



	$('#modalexit').click(function() {
		$('#modal_form').modal('hide');
		
	});



	function miFunction(){
		var del=firts(one,two,tree,four,five,six,seven);
	}

</script>



