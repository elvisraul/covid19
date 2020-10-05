<script type="text/javascript">



	$("#configuration").click('',function() {
		window.location.href = 'mall_login.php';
	});
	//$("#control").click('',function() {
	$('#control').click(function() {
			//$('#modal_conrol').modal({backdrop: 'static', keyboard: false});
		$('#controlpoint').empty();
		$('#controlpoint').trigger("liszt:updated");
		
		loadModal();
			
		//window.location.href = 'mrole_all.php';
	});
	$("#process").click('',function() {
		window.location.href = 'mprocess_all.php';
	});
	$("#role").click('',function() {
		window.location.href = 'mrole_all.php';
	});


	/*$('#resetDefault').click(function() {
		window.open('guideall.pdf', '_blank');
	});*/


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
	
	

	function loadModal(){
		$.ajax({
			url: 'src/design/controllers/utils/global.php',
			dataType: 'json',
			type: 'POST',
			data: {"action": "reference_controlpoint"},
			success: function(response) {
				
				$.each(response.data, function(k, v){
					$('#controlpoint').append('<option value="'+v.id+'">'+v.name+'</option>');
			  	});
			  	$('#controlpoint').trigger("liszt:updated");
			  	$('#controlpoint').chosen({
					allow_single_deselect: true,
					width:"400px"
				});
			},complete: function(response) {
				$("#modal_conrol").modal("show");
			}
		});
	}

	$('#inputcontrol').click(function() {
		$.ajax({
			url: 'src/design/controllers/utils/global.php',
			dataType: 'json',
			type: 'POST',
			data: {"action": "select_controlpoint","controlpoint":$('#controlpoint').val()},
			success: function(response) {
				$("#modal_conrol").modal("hide");
				//console.log(response);
			},complete: function(response) {
				window.location.href = 'mcli_all.php';
			}
		});
		

	});

</script>