<?php

	if (isset($_POST['internal']) && !empty($_POST['internal'])) {
		$contentTemp='';
		$footTemp='';
		$action = $_POST['internal'];
		switch ($action) {
			case 'usuario' :
				$contentTemp='src/design/views/mcli_asistance.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mcli_asistance.php');
				break;
			case 'rol' :
				$contentTemp='src/design/views/mrole_role.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mrole_role.php');
				break;
			case 'permiso' :
				$contentTemp='src/design/views/mprocess_dispatch.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mprocess_dispatch.php');
				break;
			case 'delete' : deleteData(); 
				break;
		}
		if($action=='thisfile'){
			$file = 'src/guide.pdf';
			$path = $file;
			$arr = array( 'url'=>$path);
			echo json_encode($arr);
		}else{
			$arr = array('content'=>$contentTemp,'foot'=>$footTemp);
			echo json_encode($arr);
		}
		
	} else {
		$arr = array( 'url'=>'nada');
		echo json_encode($arr);
	}

?>
