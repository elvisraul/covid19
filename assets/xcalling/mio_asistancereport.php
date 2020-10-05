<script type="text/javascript">
	
	tableissuegeneral=null;
	tabledatahistorialtemperature=null;
	reasonselected=null;
	var questionaries=0;
	var questionaryfill=new Array();

	var date = new Date();
	var strDate = date.getFullYear() + "-" + ((date.getMonth()+1)<10?"0"+(date.getMonth()+1):(date.getMonth()+1)) + "-" + (date.getDate()<10?"0"+date.getDate():date.getDate());

	$('#datesearch').val(strDate);


	$('#datesearch').datepicker({
		format: "yyyy-mm-dd",
		language: 'es'
	}).on('changeDate', function(){
		
		$('#reasons').val(0);
	  	$('#reasons').trigger("liszt:updated");
	  	$('#reasons').chosen({
			allow_single_deselect: true,
			width:"400px"
		});
		$('#datesearch').datepicker('hide');
		$('#search').focus();
		loadOrientation(0,0,$('#datesearch').val());

	});

	


  	loadtable(0,0,$('#datesearch').val());
  	loadOrientation(0,$('#datesearch').val());

	function loadtable(idsubject,idreason,dateselect){
		table = $('#alldata').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_asistancereport_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "list","idsubject":idsubject,"idreason":idreason,"dates":dateselect}
			},
			"aoColumns": [
					{ 'mData': 'id',"visible":false },
					{ 'mData': 'registration', "width": "180px"},
					{ 'mData': 'action', "width": "120px"},
					{ 'mData': 'code' },
					{ 'mData': 'complete',"width": "400px"},
	                { 'mData': 'phone', "width": "100px"},
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

			//loadreason(row.worker,row.idreason);
			$("#temperature").val(row.temperature);
			$("#idtemperature").val(row.idtemperature);
			$("#idquiz").val(row.idquiz);
			$("#answered").val(row.fill);
			$("#idreason").val(row.idreason);

			if($("#answered").val()=='SI'){
				let requestquestionary = $.ajax({
				    url: "src/design/controllers/mio_asistancereport_controller.php",
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
											"<div class='panel-footer'><a id='downloadquiz"+$("#idquiz").val()+"-"+v.questionary_head+"'  href='#' class='btn btn-primary downloadquiz' >Descargar</a></div>"+
										"</div>"+
									"</div>");
						questionaries=quantity;
						quantity++;

				  	});

				  	$("#accordion2" ).html(htmlaccordion);

			  		$('a.downloadquiz').click(function() {
						//console.log($(this).prop('id'));
						//console.log($(this).prop('id').substring(12));
						var r_qh=$(this).prop('id').substring(12);
						$.ajax({
							type: "POST",
							url: "src/design/controllers/mio_asistancereport_controller.php",
							data: {"action": "download_quiz","recurrence_qh":r_qh},
							dataType: 'json',
							success: function(data) {
								//console.log(data);
								//location.href=data.url;
								window.open(data.url, '_blank');
								//console.log(data);

							}
						});
					});

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


		$('#alldata tbody').on('click','a.rdata',function () {
			var row=table.row( $(this).parents("tr") ).data();

			$("#modal_formheart").modal("show");
			$('#titleheart').html('MOVIMIENTOS DEL PERSONAL');
			
			loadhistorialtemperature(row.idvisit,row.registration);

		});

  	}


	function loadreason(isworker){
		$.ajax({
			url: 'src/design/controllers/mio_asistancereport_controller.php',
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
			  		$('#reason').val(3);
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
				    url: "src/design/controllers/mio_asistancereport_controller.php",
					type: "POST",
					dataType: 'json',
					data: {"action": "put_temperature","idtemperature":$("#idtemperature").val(),"temperature":$("#temperature").val()}
				});

				requesttemp.success(function(output) {
					table.ajax.reload( null, false );
				});

				if($("#answered").val()!='SI'){
					let requestquestionary = $.ajax({
					    url: "src/design/controllers/mio_asistancereport_controller.php",
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
				url: "src/design/controllers/mio_asistancereport_controller.php",
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
				url: "src/design/controllers/mio_asistancereport_controller.php",
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


	function loadhistorialtemperature(idvisit,dateselect){
		tabledatahistorialtemperature = $('#datahistorialtemperature').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mio_asistancereport_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "load_historialtemperature","idvisit":idvisit,"dates":dateselect}
			},
			"aoColumns": [
					{ 'mData': 'turn',"width": "50px "},
					{ 'mData': 'action'},
					{ 'mData': 'registration'},
					{ 'mData': 'temperature',"sClass": "center"}
			],
			"bInfo": false,
			"searching": false,
			"paging": false,
			"ordering":  false,
			"autoWidth": false
		});
	}


	$('#search').click(function() {

		loadtable($('#subjects').val(),$('#reasons').val(),$('#datesearch').val());

	});


	$("#reasons").chosen().change(function() {
		/*$('#reasons').val($("#united").data("pre"));
		$('#reasons').trigger("liszt:updated");
		$("#reasons").data("pre",$("#united").val());*/
		loadOrientation($("#reasons").val(),$('#datesearch').val());

	});


	$('#download').click(function() {

		$.ajax({
			type: "POST",
			url: "src/design/controllers/mio_asistancereport_controller.php",
			data: {"action": "download_asistence","idsubject":$('#subjects').val(),"namesubject":$("#subjects option:selected").text(),"idreason":$('#reasons').val(),"dates":$('#datesearch').val()},
			dataType: 'json',
			success: function(data) {
				//console.log(data);
				location.href=data.url;
			}
		});

	});



	$('#canceldata').click(function() {
		$('#modal_form').modal('hide');
	});


	$('#modalexit').click(function() {
		$('#modal_form').modal('hide');
	});
	


	$.ajax({
		type: "POST",
		url: "src/design/controllers/mio_asistancereport_controller.php",
		data: {"action":"load_reason"},
		dataType: 'json',
		success: function(response) {
			$.each(response.data, function(k, v){
				$('#reasons').append('<option value="'+v.id+'">'+v.name+'</option>');
			
		  	});
		  	$('#reasons').trigger("liszt:updated");
		  	$('#reasons').chosen({
				allow_single_deselect: true,
				width:"200px"
			});
			
		}
	});


	function loadOrientation(idreason,dates){
		$("#subjects").empty(); 
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mio_asistancereport_controller.php",
			data: {"action":"load_worker","reason":idreason,"dates":dates},
			dataType: 'json',
			success: function(response) {
				$('#subjects').append('<option value=0>--Todos</option>');
				$.each(response.data, function(k, v){
					$('#subjects').append('<option value="'+v.id+'">'+v.complete+'</option>');
				
			  	});
			  	$('#subjects').val(0);
			  	$('#subjects').trigger("liszt:updated");
			  	$('#subjects').chosen({
					allow_single_deselect: true,
					width:"400px"
				});
				
			}
		});
	}


</script>					