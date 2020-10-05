<script>

	function itemshow(value){
		switch(value){
		case 'usuario' : itemshowcalling(value); break;
		case 'rol' : itemshowcalling(value); break;
		case 'permiso' : itemshowcalling(value); break;
		case 'file' : fileGuide(); break;
		}
	}

	function itemshowcalling(value){
		$.ajax({
			type: "POST",
			url: "src/design/controllers/mcli_all_controller.php",
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
			url: "src/design/controllers/mcli_all_controller.php",
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
