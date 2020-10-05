<?php
    session_start();
    require (__DIR__."/../../../utils/Connection.php");

    use Util\Connection as Connection;

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            case 'reference_controlpoint' : loadControlpoint();break;
            case 'select_controlpoint' : selectControlpoint();break;
        }
    }else{
        saveData();
    }

    function saveData(){

    }

    function loadControlpoint(){

        try {

            $pdo = Connection::get()->connect();
            $stmt = $pdo->query('SELECT id, name FROM emergency.control_point ORDER BY id ASC');
            $stmt->execute();
            
            while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                $results["data"]= $row;
            }
            echo json_encode($results);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    

    function selectControlpoint(){
        $controlpoint=$_POST["controlpoint"];
        $_SESSION['controlpoint']=$controlpoint;

        echo json_encode(array( 'value'=>$_SESSION['controlpoint']));
    }

?>    