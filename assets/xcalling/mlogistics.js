<script type='text/javascript'>
	$(document).ready(function() {
		table = $('#alldata').DataTable({
			"bDestroy": true,
			"bDeferRender": true,
			"aProcessing": true,
			"aServerSide": true,
			"ajax":{
				url: "src/design/controllers/mlogistics_warehousetype_controller.php",
				type: "POST",
				dataSrc: "data",
				data: {"action": "list"}
			},
			"aoColumns": [
				{ 'mData': 'id',"visible":false },
				{ 'mData': 'code',"visible":false },
				{ 'mData': 'shortname' },
				{ 'mData': 'fullname' },
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
			$('#newdata').click();
			$('#title').html('Modificar Tipo de Almacen');
			$('#savedata').html('Actualizar');
			$('#id').val(row.id);
			$('#code').val(row.code);
			$('#sname').val(row.shortname);
			$('#fname').val(row.fullname);
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
					url: "src/design/controllers/mlogistics_warehousetype_controller.php",
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
			$('#title').html('Nuevo Tipo de Almacen');
			$('#savedata').html('Guardar');
			$('#id').val(0);
			$('#code').val('');
			$('#sname').val('');
			$('#fname').val('');

			setTimeout(function () {
				$('#code').focus();
			}, 300);

		});



		$('#savedata').click(function() {
			var datos=$('#formdata').serialize();
			$.ajax({
				type: "POST",
				url: "src/design/controllers/mlogistics_warehousetype_controller.php",
				data: datos,
				success: function(data) {
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



		$('#canceldata').click(function() {
			$('#modal_form').modal('hide');
		});



	});


	var extensions = {
		"sFilter": "dataTables_filter col-md-6 col-sm-6 col-xs-12",
		"sLength": "dataTables_length col-md-6 col-sm-6 col-xs-12"
	}
	// Used when bJQueryUI is false
	$.extend($.fn.dataTableExt.oStdClasses, extensions);
	// Used when bJQueryUI is true
	$.extend($.fn.dataTableExt.oJUIClasses, extensions);
	$('#alldata').dataTable();


	$(document).on('keypress', 'input,select', function (e) {
		if (e.which == 13) {
			e.preventDefault();
			// Get all focusable elements on the page
			var $canfocus = $(':focusable');
			var index = $canfocus.index(this) + 1;
			if (index >= $canfocus.length)
				index = 0;
			$canfocus.eq(index).focus();
		}
	});
	
</script>