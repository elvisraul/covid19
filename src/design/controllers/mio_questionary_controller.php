<?php
//require "../src/utils/Connection.php";
require ("../../utils/Connection.php");

use Util\Connection as Connection;

	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'list' : listData();break;
			case 'list_questionary' : listQuestionary();break;
			case 'list_orientarion' : listOrientation();break;
			case 'reference_reason' : loadReason();break;
			case 'reference_question' : loadQuestion();break;
			case 'reference_parameter' : loadParameter();break;
			case 'load_valueparameters' : loadValueParameter();break;
			case 'put_question' : linkQuestionQuestionary();break;
			case 'put_reason' : linkReasonQuestionaryHead();break;
			case 'put_parameter' : linkParameterQuestionaryHead();break;
			case 'return_code' : returnCode();break;
			case 'delete' : deleteData();break;
			case 'delete_parameter' : deleteDataParameter();break;
			case 'delete_question' : deleteQuestion();break;

		}
	}else{
		saveData();
	}

	function listData(){
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query('SELECT 
			        QH.id,
			        QH.code,
			        QH.name as qname,
			        QH.description,
			        QH.active,
			        emergency.names_reasons(QH.id) as rnames,
			        CASE WHEN Q.questions IS NULL THEN 0 ELSE Q.questions END  questions,
			        CASE WHEN O.orientations IS NULL THEN 0 ELSE O.orientations END orientations
			FROM emergency.questionary_head QH
			LEFT JOIN (SELECT Q.id_questionary_head  AS id, COUNT(Q.id) AS questions FROM emergency.questionary Q
			        GROUP BY Q.id_questionary_head) Q ON Q.id=QH.id
			LEFT JOIN (SELECT O.id_questionary_head  AS id, COUNT(O.id) AS orientations FROM emergency.orientation O
			        GROUP BY O.id_questionary_head) O ON O.id=QH.id
			ORDER BY QH.id DESC');
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


	function listOrientation(){
		$id = $_POST['idqh'];
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query('SELECT 
				O.id_reason AS id 
				FROM emergency.orientation O 
				WHERE O.id_questionary_head='.$id);
			$stmt->execute();
			while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
				$results["data"]= $row;
			}
			echo json_encode($results);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	function listQuestionary(){
		$id = $_POST['idqh'];
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query('SELECT 
				QY.id,
				QY.position,
				Q.precision as name
				FROM emergency.questionary QY 
				LEFT JOIN emergency.question Q ON QY.id_question=Q.id
				WHERE QY.id_questionary_head='.$id);
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
			$sqlp = 'DELETE FROM emergency.questionaryhead_parameter WHERE id_questionaryhead=?';
			$pdo->prepare($sqlp)->execute([$id]);

			$sql = 'DELETE FROM emergency.questionary_head WHERE id=?';
			$pdo->prepare($sql)->execute([$id]);
			
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function deleteDataParameter(){
		$id = $_POST['idp'];
		
		try {
			$pdo = Connection::get()->connect();
			$sqlp = 'DELETE FROM emergency.questionaryhead_parameter WHERE id=?';
			$pdo->prepare($sqlp)->execute([$id]);
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function deleteQuestion(){
		$id = $_POST['id'];
		
		try {
			$pdo = Connection::get()->connect();
			$sql = 'DELETE FROM emergency.questionary WHERE id=?';
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

	function loadQuestion(){
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query('SELECT id,precision FROM emergency.question ORDER BY id DESC');
			$stmt->execute();
			while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
				$results["data"]= $row;
			}
			echo json_encode($results);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}


	function loadParameter(){
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query('SELECT 
				RDD.ID AS id,
				RDD.V_1_1 AS code, 
				RDD.V_1_2 AS name 
				FROM core.rule_demand_detail RDD 
				WHERE RDD.id_rule_demand=11 
				ORDER BY RDD.ID ASC');
			$stmt->execute();
			while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
				$results["data"]= $row;
			}
			echo json_encode($results);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}

	function loadValueParameter(){

		$idquestionaryhead = $_POST['idqh'];

		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->prepare('SELECT 
            	QHP.id AS id, 
            	RDD.V_1_2 AS name, 
            	QHP.value AS value 
				FROM emergency.questionaryhead_parameter QHP
				INNER JOIN core.rule_demand_detail RDD ON QHP.id_parameter=RDD.id
				WHERE RDD.id_rule_demand=11 AND  QHP.id_questionaryhead=?
				ORDER BY RDD.ID ASC');

			$stmt->execute([$idquestionaryhead]);

			$results["data"]=array();
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
			
			$stmt = $pdo->query("SELECT MAX(id) AS quantity FROM emergency.questionary_head ");
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_OBJ);
			echo json_encode(array('code' => ($row->quantity)+1));

		} catch (PDOException $e) {
			echo $e->getMessage();
		}

	}



	function linkQuestionQuestionary(){
		$idquestionaryhead = $_POST['idqh'];
		$idquestion = $_POST['idq'];
		$order = generatedOrderQuestion($idquestionaryhead);

		try {
			if(verifiedduplicated($idquestionaryhead,$idquestion)==0){	
				$pdo = Connection::get()->connect();
				$sql = "INSERT INTO emergency.questionary (position,id_questionary_head,id_question) VALUES (?,?,?)";
				$pdo->prepare($sql)->execute([$order,$idquestionaryhead,$idquestion]);
				echo json_encode(array('duplicated' => 'no'));
			}else{
				echo json_encode(array('duplicated' => 'yes'));
			}
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	

	function linkReasonQuestionaryHead(){
		$idquestionaryhead = $_POST['idqh'];
		$reasonarray= $_POST['reasonarray'];

		try {
			$pdo = Connection::get()->connect();
			$sql = 'DELETE FROM emergency.orientation WHERE id_questionary_head=?';
			$pdo->prepare($sql)->execute([$idquestionaryhead]);

			foreach ($reasonarray as $value){
                $sql = "INSERT INTO emergency.orientation (
                    id_questionary_head, 
                    id_reason) VALUES (?,?)";

                $pdo->prepare($sql)->execute([$idquestionaryhead,$value]);
            }
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	
	function linkParameterQuestionaryHead(){
		$idquestionaryhead = $_POST['idqh'];
		$parameter= $_POST['parameter'];
		$pvalue= $_POST['value'];

		try {
			$pdo = Connection::get()->connect();
            $sql = "INSERT INTO emergency.questionaryhead_parameter (
                id_questionaryhead, 
                id_parameter,
            	value) VALUES (?,?,?)";
            $pdo->prepare($sql)->execute([$idquestionaryhead,$parameter,$pvalue]);


		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	function verifiedduplicated($idqh,$idq){
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query("SELECT MAX(Q.position) quantity FROM  emergency.questionary Q WHERE Q.id_questionary_head=".$idqh." AND Q.id_question=".$idq);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_OBJ);
			return (($row->quantity));

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}


	function generatedOrderQuestion($id_questionary_head ){
		try {
			$pdo = Connection::get()->connect();
			
			$stmt = $pdo->query("SELECT MAX(Q.position) maximo FROM  emergency.questionary Q WHERE Q.id_questionary_head=".$id_questionary_head);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_OBJ);
			return (($row->maximo)+1);

		} catch (PDOException $e) {
			echo $e->getMessage();
		}	
		
	}


	function saveData(){

		$id = $_POST['id'];
		$code = $_POST['code'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$idreason = $_POST['reason'];

		$active = 0;
		if(isset($_POST['active'])){
			$active = 1;
		}

		try {
			$pdo = Connection::get()->connect();
			if ( $id == 0 ) {
				$sql = "INSERT INTO emergency.questionary_head (code,name,description,id_reason,active) VALUES (?,?,?,?,?)";
				$pdo->prepare($sql)->execute([$code,$name,$description,$idreason,$active]);
			} else {
				$sql = "UPDATE emergency.questionary_head SET name=?, description=?,active=? WHERE id=?";
				$pdo->prepare($sql)->execute([$name,$description,$active,$id]);	
			}
			
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

?>