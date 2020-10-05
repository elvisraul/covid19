<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../../services/PHPMailer/Exception.php';
require '../../services/PHPMailer/PHPMailer.php';
require '../../services/PHPMailer/SMTP.php';


session_start();
require "../../utils/Connection.php"  ;
require "../../utils/Enigma.php"  ;

	use Util\Connection as Connection;
	use Util\Enigma as Enigma;

	if (isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'check' : checkMail();break;
			case 'delete' : deleteData();break;
			case 'activate' : activateMail();break;
			case 'registerup' : registerUp();break;
			case 'close_session' : closeSession();break;
		}
	} else {
		login();
	}
	
	function login(){

		$meta=json_decode($_POST["json"]);
		$uname=$meta->{'data'}[0]->{'username'};
		$upassword=$meta->{'data'}[0]->{'password'};
		$captcha=$meta->{'data'}[0]->{'captcha'};
		
		$robot = '';
		if ( $captcha && ($captcha!="") ) {
			// Validation: Checking entered captcha code with the generated captcha code
			if (strcasecmp($_SESSION['captcha'], $captcha) != 0) {
				// Note: the captcha code is compared case insensitively.
				// if you want case sensitive match, update the check above to strcmp()
				$robot = 'yes';
			} else {
				$robot = 'no';
			}
		}
		
		if ($robot=='no') {
			try {
				$pdo = Connection::get()->connect();
					$stmt = $pdo->prepare('SELECT * FROM core.operator WHERE userpassword = ? AND ( code = ? OR alias = ? OR username = ? ) '); //Preparamos la consulta
					$stmt->execute( array($upassword,$uname,$uname,$uname ) ); //Le pasamos el valor
					$rows = $stmt->fetchAll( PDO::FETCH_OBJ ); //convirtiendo el resultado en objetos para poder iterar en un ciclo.

					if (count($rows) >0) {

						$_SESSION['operatoralias']=$rows[0]->alias;
						$_SESSION['operatorid']=$rows[0]->id;
						$_SESSION['businesssubjectid']=$rows[0]->id_business_subject;

						$stmtx = $pdo->prepare('SELECT R.id, R.name, R.module, R.resource FROM core.charge_role CR
							INNER JOIN core.role R ON CR.id_role=R.id
							INNER JOIN core.charge C ON CR.id_charge=C.id
							WHERE C.id_business_subject=? AND C.active=true
							ORDER BY R.id ASC');

						$stmtx->execute( array( $_SESSION['businesssubjectid'] ) );
						$rowsx = $stmtx->fetchAll( PDO::FETCH_OBJ );
						$key = array_search('all', array_column($rowsx, 'module'));



						$stmtm = $pdo->prepare('SELECT R.module FROM core.charge_role CR
							INNER JOIN core.role R ON CR.id_role=R.id
							INNER JOIN core.charge C ON CR.id_charge=C.id
							WHERE C.id_business_subject=? AND C.active=true
							GROUP BY R.module');
						$stmtm->execute( array( $_SESSION['businesssubjectid'] ) );
						$rowsm = $stmtm->fetchAll( PDO::FETCH_OBJ );

						$_SESSION['modules']=$rowsm;


						$stmto = $pdo->prepare('SELECT R.module,R.option FROM core.charge_role CR
							INNER JOIN core.role R ON CR.id_role=R.id
							INNER JOIN core.charge C ON CR.id_charge=C.id
							WHERE C.id_business_subject=? AND C.active=true and R.option is not null
							GROUP BY R.module,R.option');
						$stmto->execute( array( $_SESSION['businesssubjectid'] ) );
						$rowso = $stmto->fetchAll( PDO::FETCH_OBJ );

						$_SESSION['options']=$rowso;


						$stmtf = $pdo->prepare('SELECT R.module,R.option,R.filter FROM core.charge_role CR
							INNER JOIN core.role R ON CR.id_role=R.id
							INNER JOIN core.charge C ON CR.id_charge=C.id
							WHERE C.id_business_subject=? AND C.active=true and R.option is not null and R.filter is not null
							GROUP BY R.module,R.option,R.filter');
						$stmtf->execute( array( $_SESSION['businesssubjectid'] ) );
						$rowsf = $stmtf->fetchAll( PDO::FETCH_OBJ );

						$_SESSION['filter']=$rowsf;



						$arr = array();

						if($key!=false){
							
							$arr = array( 'login'=>'true','url'=>'mio_all.php','datos'=>$key);
						}else{

							if(count($rowsm)==1){
								$arr = array( 'login'=>'true','url'=>'m'.($rowsm[0]->module).'_all.php');
							}else if (count($rowsm)>1) {
								$arr = array( 'login'=>'true','url'=>'mio_all.php');
							}
						}

						echo json_encode($arr);
					} else {
						$arr = array( 'login'=>'false');
						echo json_encode($arr);
					}
			} catch (PDOException $e) {
				/*echo $e->getMessage();*/
				$arr = array( 'login'=>'error','msg'=>$e->getMessage());
				echo json_encode($arr);
			}
		} else {
			$arr = array( 'login'=>'robot'); 
			echo json_encode($arr);
		}
		
	}



	function existMail($mail){
		try {
			$pdo = Connection::get()->connect();
			$stmt = $pdo->prepare('SELECT alias FROM core.operator WHERE username = ? '); //Preparamos la consulta
			$stmt->execute( array($mail) );
			$rows = $stmt->fetchAll( PDO::FETCH_OBJ );

			if ((COUNT($rows))>0) {
				return ($rows[0]->alias);
			}else{
				return (null);
			}
		} catch (PDOException $e) {
			return (null);
		}
	}

	function checkMail(){
		
		$umail = $_POST['mail'];
		$uname = existMail($umail);
		$exist = 'no';
		if($uname){
			$exist = 'si';
		}
		
		if ($exist=='si') {

			$reset_request=(new DateTime('now', new DateTimeZone('America/Lima')))->format('Y-m-d');
			$string_token=Enigma::encrypt($uname.'#'.$reset_request.'#T');

			try {
				$pdo = Connection::get()->connect();
				$stmt = $pdo->prepare('SELECT * FROM core.operator WHERE username = ? '); //Preparamos la consulta
				$stmt->execute( array($umail) ); //Le pasamos el valor
				$rows = $stmt->fetchAll( PDO::FETCH_OBJ ); //convirtiendo el resultado en objetos para poder iterar en un ciclo.
				
				if (count($rows) >0) {
					$mail = new PHPMailer(true);
					
					try {
						//Server settings
						$mail->SMTPDebug = 0;                                       // Enable verbose debug output
						$mail->isSMTP();                                            // Set mailer to use SMTP
						$mail->Host       = 'mail.olpesa.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
						//$mail->Username   = 'compras@olpesa.com';                     // SMTP username
						$mail->Username   = 'desarrollo@olpesa.com';                     // SMTP username
						//$mail->Password   = '$compras2019';                               // SMTP password
						$mail->Password   = '$DESARROLLO2020';                               // SMTP password

						$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
						$mail->Port       = 587;                                    // TCP port to connect to

						//Recipients
						$mail->setFrom('sistemas@olpesa.com', 'OLPESA');
						//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
						$mail->addAddress($umail);               // Name is optional
						//$mail->addAddress('pampayacu@gmail.com');               // Name is optional
						//$mail->addAddress('elmen_89_10@hotmail.com');               // Name is optional
						//$mail->addAddress('compras@olpesa.com');               // Name is optional
						/*$mail->addReplyTo('info@example.com', 'Information');
						$mail->addCC('cc@example.com');
						$mail->addBCC('bcc@example.com');*/

						// Attachments
						//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
						//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

						// Content
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Usuario : '.$uname;
						$mail->Body    = '<table style="max-width:100%; padding:10px; margin:0 auto; border-collapse:collapse">
						<tbody>
						<tr><td colspan="3">
						<div style="color: rgb(17, 17, 17); margin: 4% 10% 2%; text-align: center; font-family: sans-serif, serif, EmojiFont;">
						<img data-imagetype="External" src="http://www.olpesa.com/sites/all/themes/orane/logo.png">
						<h4 style="margin:0 0 7px; text-align:center">OLEAGINOSAS DEL PERÚ S.A.</h4>
						<hr></div></td>
						</tr>
						<tr><td colspan="3"><div style="color: rgb(17, 17, 17); margin: 1% 10% 2%; text-align: justify; font-family: sans-serif, serif, EmojiFont;">
						<h5 style="margin:0px 0 7px; text-align:center">Usted recibió este correo porque recibimos una solicitud <br>de reinicio de contraseña para su cuenta.</h5>
						<h5 style="margin:20px 2px 0px 0px; text-align:center">
						<form action="http://192.168.0.33/olpesin/mall_rlogin.php?token='.$string_token.'" target="_blank">
						<button type="submit" style="color:#fff; text-align:center; vertical-align:middle; background-color:#28a745; width:200px; height:45px">
						Resetear Contraseña</button></form>
						</h5>
						<h6 style="margin:0px 0px 0px 0px; text-align:center">Ó, haga click en el enlace siguiente :</h6>
						<h5 style="margin:0px 0px 0px 0px; text-align:center"><a href="http://192.168.0.33/olpesin/mall_rlogin.php?token='.$string_token.'" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" id="LPlnk730356">
						http://192.168.0.33/olpesin/mall_rlogin.php?token='.$string_token.'</a></h5>
						<h5 style="margin:20px 0px 0px 7px; text-align:center">Equipo de Desarrollo - Oleaginosas del Perú</h5>
						<hr><h6 style="margin:7px 0px 0px 7px; text-align:center">SISTEMA INFORMÁTICO DE OLEAGINOSAS DEL PERÚ S.A.</h6>
						<hr>
						</div></td>
						</tr>
						<tr style="background-color:#dcdcdc; font-family:sans-serif"><td colspan="3">
						<div style="color: rgb(17, 17, 17); text-align: center; font-family: sans-serif, serif, EmojiFont;">
						<h6 style="">Copyrigth © 2020 Sistema Informático de Oleaginosas del Perú S.A. Todos los derechos reservados</h6>
						</div>
						</td>
						</tr>
						</tbody>
						</table>';
						//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
						
						$mail->CharSet = 'UTF-8';
						$mail->send();

						$sql = "UPDATE core.operator SET reset_request=?,reset_pending=? WHERE id=?";
            			$pdo->prepare($sql)->execute([$reset_request,true,$rows[0]->id]);


						$arr = array('send'=>'true');
						echo json_encode($arr);
						
					} catch (Exception $e) {
						//echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
						$arr = array('send'=>'false');
						echo json_encode($arr);
					}
				} else {
					$arr = array( 'send'=>'false');
					echo json_encode($arr);
				}
			} catch (PDOException $e) {
				$arr = array( 'send'=>'error','msg'=>$e->getMessage());
				echo json_encode($arr);
			}
		} else {
			$arr = array( 'send'=>'robot');
			echo json_encode($arr);
		}
	}
	


	function activateMail(){

		//$meta=json_decode($_POST["json"]);
		$dni=$_POST["dni"];

		try {	
			$pdo = Connection::get()->connect();
			$stmt = $pdo->prepare("SELECT BS.name AS complete, BS.mail,S.paternal,S.maternal,S.name  FROM core.business_subject AS BS INNER JOIN core.subject AS S ON BS.id_subject=S.id WHERE BS.code=? ");
			$stmt->execute([$dni]);
			$rows = $stmt->fetchAll(PDO::FETCH_OBJ);
			
			if ((COUNT($rows))>0) {

				$alias=generateAlias($rows[0]->paternal,$rows[0]->name);

				$stmtx = $pdo->prepare("SELECT O.code, O.alias  FROM core.operator O WHERE O.code=? ");
				$stmtx->execute([$dni]);
				$rowsx = $stmtx->fetchAll(PDO::FETCH_OBJ);
				
				if($rows[0]->mail){

					if ((COUNT($rowsx))>0) {
						$alias=$rowsx[0]->alias;
						$arr = array('verified'=>'true','mail'=>($rows[0]->mail),'name'=>($rows[0]->complete),'true'=>'true','completed'=>'true','alias'=>$alias);
						echo json_encode($arr);
					}else{
						$arr = array('verified'=>'true','mail'=>($rows[0]->mail),'name'=>($rows[0]->complete),'mailx'=>'true','completed'=>'false','alias'=>$alias);
						echo json_encode($arr);
					}
				}else{
					$arr = array('verified'=>'true','mail'=>($rows[0]->mail),'name'=>($rows[0]->complete),'mailx'=>'false','completed'=>'false','alias'=>$alias);
					echo json_encode($arr);
				}
			}else{
				$arr = array( 'verified'=>'false');
				echo json_encode($arr);
			}
		} catch (PDOException $e) {
				//echo $e->getMessage();
				$arr = array( 'verified'=>'error','msg'=>$e->getMessage());
				echo json_encode($arr);
		}
	}


	function generateAlias($p_paternal,$p_name){
		$nameexplode=explode(" ", $p_name);
		$returnAlias=null;
		foreach ($nameexplode as $partname) {
			$returnAlias=SUBSTR(($partname),0,1).$p_paternal;
			if(!existAlias($returnAlias)){
				return ($returnAlias);
			}
		}

	}


	function existAlias($potential){
		try {
			$pdo = Connection::get()->connect();
			$stmt = $pdo->prepare("SELECT 
				O.alias
				FROM core.operator O
				WHERE O.alias='".$potential."'"); //Preparamos la consulta
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_OBJ);

			if ((COUNT($rows))>0) {
				return (true);
			}else{
				return (false);
			}

		} catch (PDOException $e) {
			return (true);
		}
	}



	
	function registerUp(){
		$dni = $_POST['dni'];
		
		$alias = $_POST['pa'];
		$password = $_POST['pp'];

		try {	
			$pdo = Connection::get()->connect();
			$stmt = $pdo->prepare("SELECT 
				BS.id, 
				BS.code,
				BS.mail,
				S.paternal,S.maternal,S.name  FROM core.business_subject AS BS INNER JOIN core.subject AS S ON BS.id_subject=S.id WHERE BS.code=? ");
			$stmt->execute([$dni]);
			$rows = $stmt->fetchAll(PDO::FETCH_OBJ);


			$idbusinesssubject=$rows[0]->id;
			$code=$rows[0]->code;
			$mail=$rows[0]->mail;


			$sql = "INSERT INTO core.operator (
            code, 
            alias, 
            username,
            userpassword,
            active,
            id_business_subject) VALUES (?,?,?,?,?,?)";

        	$pdo->prepare($sql)->execute([$code,$alias,$mail,$password,true,$idbusinesssubject]);
        	
        	$arr = array( 'success'=>'true');
			echo json_encode($arr);
		} catch (PDOException $e) {
				//echo $e->getMessage();
			$arr = array( 'success'=>'false','msg'=>$e->getMessage());
			echo json_encode($arr);
		}

	}


	function closeSession(){
		session_start();
		session_destroy();
	}


?>