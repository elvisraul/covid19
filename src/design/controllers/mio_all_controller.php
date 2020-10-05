<?php

	if (isset($_POST['internal']) && !empty($_POST['internal'])) {
		$contentTemp='';
		$footTemp='';
		$action = $_POST['internal'];
		switch ($action) {
			case 'questionario' :
				$contentTemp='src/design/views/mio_questionary.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mio_questionary.php');
				break;
			case 'pregunta' :
				$contentTemp='src/design/views/mio_question.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mio_question.php');
				break;				
			case 'almacen' :
				$contentTemp='src/design/views/mlogistics_warehouse.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_warehouse.php');
				break;
			case 'producto' :
				$contentTemp='src/design/views/mlogistics_good.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_good.php');
				break;
			case 'precio' :
				$contentTemp='src/design/views/mlogistics_price.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_price.php');
				break;
			case 'produccion' :
				$contentTemp='src/design/views/mlogistics_production.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_production.php');
				break;
			case 'ingreso' :
				$contentTemp='src/design/views/mlogistics_input.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_input.php');
				break;
			case 'salida' :
				$contentTemp='src/design/views/mlogistics_output.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_output.php');
				break;
			case 'compras' :
				$contentTemp='src/design/views/mlogistics_shopbilling.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_shopbilling.php');
				break;
			case 'requerimiento' : //Requerimiento
				$contentTemp='src/design/views/mlogistics_request.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_request.php');
				break;
			case 'tipo_cambio' : //Requerimiento
				$contentTemp='src/design/views/mlogistics_changetype.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mlogistics_changetype.php');
				break;
			case 'reporte_asistencia' : //Requerimiento
				$contentTemp='src/design/views/mio_asistancereport.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mio_asistancereport.php');
				break;	
			case 'asistencia' : //Requerimiento
				$contentTemp='src/design/views/mio_asistance.php';
				$footTemp= file_get_contents('../../../assets/xcalling/mio_asistance.php');
				break;	
			case 'delete' : deleteData();break;
		}
		$arr = array('content'=>$contentTemp,'foot'=>$footTemp);
		echo json_encode($arr);
	} else {
		$arr = array( 'url'=>'nada');
		echo json_encode($arr);
	}

	function deleteData(){

	}

?>
