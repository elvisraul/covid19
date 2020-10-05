
<script>
	$("#person").click('',function() {
		window.location.href = 'mrrhh_all.php';
	});
	$("#logistics").click('',function() {
		window.location.href = 'mlogistic_all.php';
	});
	$("#process").click('',function() {
		window.location.href = 'mprocess_all.php';
	});
	$("#role").click('',function() {
		window.location.href = 'mrole_all.php';
	});


	$('#resetDefault').click(function() {
		window.open('guideall.pdf', '_blank');
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