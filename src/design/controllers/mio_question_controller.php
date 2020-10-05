<?php
//require "../src/utils/Connection.php";
require ("../../utils/Connection.php");

use Util\Connection as Connection;

	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'list' : listData();break;
			case 'reference_reason' : loadReason();break;
			case 'return_code' : returnCode();break;
			case 'delete' : deleteData();break;

		}
	}else{
		saveData();
	}

	function listData(){
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query("SELECT 
				id,
				code,
				precision AS name,
				(CASE WHEN optional IS NULL  THEN 'NO' ELSE CASE WHEN optional  THEN 'SI' ELSE 'NO' END END) optional
				FROM emergency.question");
			$stmt->execute();
			
			$results["data"]=array();
			while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
				$results["data"]= $row;
			}
			echo json_encode($results);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	
	function deleteData(){
		$id = $_POST['id'];
		
		try {
			$pdo = Connection::get()->connect();
			$sql = 'DELETE FROM emergency.question WHERE id=?';
			$pdo->prepare($sql)->execute([$id]);
			
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	function loadReason(){
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query('SELECT id,name FROM emergency.reason ORDER BY id DESC');
			$stmt->execute();
			while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
				$results["data"]= $row;
			}
			echo json_encode($results);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}

	function returnCode(){

		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query("SELECT COUNT(id) AS quantity FROM emergency.question");
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_OBJ);
			echo json_encode(array('code' => ($row->quantity)+1));

		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}


	function saveData(){
		$id = $_POST['id'];
		$code = $_POST['code'];
		$precision = $_POST['precision'];

		$optional = 0;
		if(isset($_POST['optional'])){
			$optional = 1;
		}

		try {
			$pdo = Connection::get()->connect();
			if ( $id == 0 ) {
				$sql = "INSERT INTO emergency.question (code,precision,optional) VALUES (?,?,?)";
				$pdo->prepare($sql)->execute([$code,$precision,$optional]);
			} else {
				$sql = "UPDATE emergency.question SET precision=?,optional=? WHERE id=?";
				$pdo->prepare($sql)->execute([$precision,$optional,$id]);	
			}
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		
	}

?>