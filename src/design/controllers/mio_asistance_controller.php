<?php
session_start();


require '../../services/PHPMailer/Exception.php';
require '../../services/PHPMailer/PHPMailer.php';
require '../../services/PHPMailer/SMTP.php';

require '../../services/vendor/autoload.php';

require ("../../utils/Connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Goutte\Client;

use Util\Connection as Connection;// Load Composer's autoloader



if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'list' : listData();break;
        case 'load_userolpesoft' : loadUserolpesot();break;
        case 'load_reason' : loadReason();break;
        case 'load_issuesgeneral' : loadIssuesgeneral();break;
        case 'load_historialtemperature' : loadHistorialtemperature();break;
        case 'load_questionary' : loadQuestionary();break;
        case 'put_temperature' : putTemperature();break;
        case 'generate_user' : registerUp();break;
        case 'update_mail' : updateMail();break;
        case 'save_quiz' :saveQuiz();break;
        case 'save_visit' :saveVisit();break;
    }
}else{
    saveData();
}

function listData(){
    try {
        $pdo = Connection::get()->connect();
        $stmt = $pdo->query("SELECT 
            S.id,
            S.code,
            S.complete,
            S.phone,
            to_char(M.registration, 'YYYY-MM-DD HH24:MI:SS') AS registration,
            CASE WHEN dd.id IS NULL THEN 'NO' ELSE 'SI' END AS worker,
            R.quantity,
            V.id AS idvisit,
            R.id_quiz AS idquiz,
            R.id_temperature AS idtemperature,
            T.temperature,
            Q.fill,
            RR.id_reason AS idreason,
            RR.temperature AS oldtemperature,
            CASE WHEN U.action='E' THEN 'INGRESÓ' ELSE 'SALIÓ' END AS action            
            FROM emergency.visit V
            INNER JOIN core.subject S ON V.id_subject=S.id 
            LEFT JOIN (SELECT C.id,S.id AS idsubject FROM core.charge C
                    INNER JOIN core.business_subject BS ON C.id_business_subject=BS.id
                    INNER JOIN core.subject S ON BS.id_subject=S.id
                    WHERE C.active=true) DD ON S.id=DD.idsubject
            LEFT JOIN (SELECT R.id_visit, COUNT(R.id) as quantity,MIN(R.id) as id_quiz,MAX(R.id) as id_temperature
                    FROM emergency.recurrence R
                    INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                    WHERE P.action='E' AND TO_DATE(CAST(registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE 
                    GROUP BY id_visit) R ON V.id=R.id_visit
            LEFT JOIN (SELECT R.id_visit,R.temperature,MIN(R.id) as id_quiz,R.id_reason
                    FROM emergency.recurrence R
                    INNER JOIN emergency.reason RR ON R.id_reason=RR.id 
                    WHERE TO_DATE(CAST(registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE 
                    GROUP BY R.id_visit,R.temperature,R.id_reason) RR ON R.id_quiz=RR.id_quiz                    
            LEFT JOIN (SELECT R.id,R.temperature,R.registration
                    FROM emergency.recurrence R
                    WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE) T ON R.id_temperature=T.id
            LEFT JOIN (SELECT R.id_visit,MAX(R.id) AS id,MAX(R.registration) AS registration
                    FROM emergency.recurrence R
                    INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                    WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE
                    GROUP BY R.id_visit) M ON V.id=M.id_visit                  
            LEFT JOIN (SELECT P.id_recurrence,P.action
                    FROM emergency.recurrence R
                    INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                    WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE ) U ON M.id=U.id_recurrence
            LEFT JOIN (SELECT Q.id_recurrence, (CASE WHEN Q.answered IS NULL THEN 'NO' ELSE 'SI' END) AS fill
                    FROM emergency.quiz Q
                    GROUP BY Q.id_recurrence,Q.answered) Q ON R.id_quiz=Q.id_recurrence
            WHERE  TO_DATE(CAST(V.registration as TEXT),'YYYY-MM-DD')=CURRENT_DATE
            ORDER BY V.registration DESC");
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


function loadUserolpesot(){
    $id = $_POST['id'];
    try {

        $pdo = Connection::get()->connect();
        $stmt = $pdo->prepare('SELECT code,alias,username FROM core.operator WHERE id_business_subject=?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        if($row){
            $code=$row->code;
            $alias=$row->alias;
            $username=$row->username;    

            $arr=array('exist'=>'yes','code'=>$code,'alias'=>$alias,'username'=>$username);
            echo json_encode($arr);
        }else{
            $arr=array('exist'=>'not');
            echo json_encode($arr);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function loadReason(){
    try {

        $pdo = Connection::get()->connect();
        $stmt = $pdo->prepare('SELECT id,name FROM emergency.reason');
        $stmt->execute();
        
        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $results["data"]= $row;
        }
        echo json_encode($results);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function loadIssuesgeneral(){
    try {
        $pdo = Connection::get()->connect();
        $stmt = $pdo->query("SELECT 
            Q.id,
            Q.position,
            QH.id idh,
            QQ.id idq, 
            QQ.precision nameq 
            FROM emergency.questionary Q
            INNER JOIN emergency.questionary_head QH ON Q.id_questionary_head=QH.id
            INNER JOIN emergency.question QQ ON Q.id_question=QQ.id");
        $stmt->execute();
        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $results["data"]= $row;
        }
        echo json_encode($results);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function loadHistorialtemperature(){
    $id = $_POST['idvisit'];
    try {
        $pdo = Connection::get()->connect();
        $stmt = $pdo->prepare("SELECT 
            R.turn,
            CASE WHEN P.action='E' THEN 'INGRESÓ' ELSE 'SALIÓ' END AS action,
            TO_CHAR(R.registration , 'HH24:MI:SS') AS registration,
            CASE WHEN P.action='S' THEN '-' ELSE CAST ( R.temperature AS varchar ) END AS temperature
            FROM emergency.recurrence R 
            INNER JOIN emergency.permanence P ON R.id=P.id_recurrence
            WHERE R.id_visit=? AND TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE
            ORDER BY R.turn DESC");
        $stmt->execute([$id]);

        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $results["data"]= $row;
        }
        echo json_encode($results);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function saveQuestionary($idrecurrence,$idreason){

    try {


        $pdo = Connection::get()->connect();
        $stmt = $pdo->prepare("SELECT 
            Q.id,
            Q.position,
            Q.id_questionary_head,
            Q.id_question,
            O.id_reason,
            Q.precision, 
            QQ.value,
            QQ.note,
            R.id as id_recurrence 
            FROM emergency.orientation O 
            INNER JOIN emergency.questionary_head QH ON O.id_questionary_head=QH.id
            INNER JOIN(SELECT Q.id,Q.position,Q.id_questionary_head,Q.id_question,QQ.precision 
                FROM emergency.questionary Q
                INNER JOIN emergency.question QQ ON Q.id_question=QQ.id) Q ON O.id_questionary_head=Q.id_questionary_head
            LEFT JOIN(SELECT id,id_recurrence,id_questionary,value,note,answered FROM emergency.quiz) QQ ON QQ.id_recurrence=?
            LEFT JOIN(SELECT id,turn FROM emergency.recurrence) R ON R.id=? AND R.turn=1
            WHERE QH.active=true AND O.id_reason=?
            ORDER BY O.id_reason,O.id_questionary_head, Q.position ASC");
        $stmt->execute([$idrecurrence,$idrecurrence,$idreason]);

        $sql = "INSERT INTO emergency.quiz (
            id_recurrence, 
            id_questionary,
            value,
            note,
            answered) VALUES (?,?,?,?,?)";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pdo->prepare($sql)->execute([$idrecurrence,$row['id'],null,null,null]);
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function loadQuestionary(){
    
    $idrecurrence = $_POST['idrecurrence'];
    $idreason = $_POST['idreason'];
    
    try {

        $pdo = Connection::get()->connect();

        $stmt = $pdo->prepare("SELECT Q.id,Q.id_recurrence FROM emergency.quiz Q WHERE Q.id_recurrence=?");

        $stmt->execute([$idrecurrence]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        if($row){
            goto continueread;
        }

        saveQuestionary($idrecurrence,$idreason);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    continueread:

    try {
        $pdo = Connection::get()->connect();
        


        $stmtm = $pdo->prepare("SELECT 
            row_number() OVER () as numeration,
            QH.id as questionary_head,
            QH.name,
            QH.description,
            Q.questions 
            FROM emergency.orientation O
            INNER JOIN emergency.questionary_head QH ON O.id_questionary_head=QH.id
            LEFT JOIN (SELECT COUNT(id) as questions,id_questionary_head 
                FROM emergency.questionary 
                GROUP BY id_questionary_head) Q ON QH.id=Q.id_questionary_head
            WHERE  QH.active=true AND O.id_reason=?
            ORDER BY QH.id ASC");
        $stmtm->execute([$idreason]);

        $array_cab=array();
        while ($row = $stmtm->fetch(PDO::FETCH_ASSOC)) {
            array_push($array_cab,$row);
        }

        $stmt = $pdo->prepare("SELECT 
            QQ.id,
            Q.position,
            Q.id_questionary_head,
            Q.id_question,
            RE.id as id_reason,
            QU.precision, 
            QQ.value,
            QQ.note,
            R.id as id_recurrence 
        FROM emergency.quiz QQ
        INNER JOIN emergency.recurrence R ON QQ.id_recurrence=R.id
        INNER JOIN emergency.reason RE ON R.id_reason=RE.id
        INNER JOIN emergency.questionary Q ON QQ.id_questionary=Q.id
        INNER JOIN emergency.questionary_head QH ON Q.id_questionary_head=QH.id
        INNER JOIN emergency.question QU ON Q.id_question=QU.id
        WHERE R.turn=1 AND R.id=? AND QH.active=true 
        ORDER BY RE.id,QH.id, Q.position ASC");
        $stmt->execute([$idrecurrence]);

        $array_det=array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($array_det,$row);
        }


        $array_result= array();

        foreach ($array_cab as $keyc) {
            $temp_array=array();
            foreach ($array_det as $keyd) {
                if($keyc["questionary_head"]==($keyd["id_questionary_head"])){
                    array_push($temp_array,$keyd);
                }
            }
            $keyc['questions']=$temp_array;
            
            array_push($array_result,$keyc);
        }

        $results["data"]=$array_result;

        echo json_encode($results);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function putTemperature(){
    $idtemperature = $_POST['idtemperature'];
    $temperature = $_POST['temperature'];
    $idreason = $_POST['idreason'];
    try {
        $pdo = Connection::get()->connect();
        $stmt = $pdo->prepare("UPDATE emergency.recurrence SET temperature=?,id_reason=? 
            WHERE id=? ");
        $stmt->execute([$temperature,$idreason,$idtemperature]);

        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $results["data"]= $row;
        }
        echo json_encode($results);
    } catch (PDOException $e) {
        echo $e->getMessage();
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

            $alias=generateAlias($rows[0]->paternal,$rows[0]->name);

            mailWelcome($code,$alias,$mail);

            $sql = "INSERT INTO core.operator (
            code, 
            alias, 
            username,
            userpassword,
            active,
            id_business_subject) VALUES (?,?,?,?,?,?)";

            $pdo->prepare($sql)->execute([$code,$alias,$mail,$password,true,$idbusinesssubject]);
            

            $arr = array( 'success'=>'true',"code"=>$code,'alias'=>$alias,'username'=>$mail);
            echo json_encode($arr);
        } catch (PDOException $e) {
                //echo $e->getMessage();
            $arr = array( 'success'=>'false','msg'=>$e->getMessage());
            echo json_encode($arr);
        }
    }



    function mailWelcome($pcode,$palias,$pusername){
        $ucode = $pcode;
        $umail = $pusername;
        $uname = $palias;
        
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
            $mail->addAddress($umail);               // Name is optional

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
            <h5 style="margin:0px 0 7px; text-align:center">Mediante el presente, OLEAGINOSAS DEL PERÚ le comunica que desde ahora cuenta con una credencial de acceso a su sistema OLPESOFT, el mismo que consiste en: Usuario ('. $uname.','. $umail.') y Contraseña('. $ucode.'), para su seguridad y la de Oleaginosas del Perú, sugerimos cambiar su contraseña en el primer inicio de sesión en OLPESOFT</h5>
            <h5 style="margin:20px 2px 0px 0px; text-align:center">
            </h5>
            <h6 style="margin:0px 0px 0px 0px; text-align:center">Para ingresar a OLPESOFT de click en el siguiente enlace :</h6>
            <h5 style="margin:0px 0px 0px 0px; text-align:center"><a href="http://app.olpesa.pe/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" id="LPlnk730356">
            http://app.olpesa.pe/</a></h5>
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
            
        } catch (Exception $e) {
            //echo "El mensaje no pudo ser enviado. Error de correo: {$mail->ErrorInfo}";
            
        }
                
    }





    function saveData(){
        $id = $_POST['id'];
        $mail = $_POST['lmail'];

        if($mail==''){
            $mail=null;
        }else{
            if(strpos($mail, '@')!==false){
                $mail=substr($mail, 0, strpos($mail, '@'));
            }
            $mail=$mail.'@olpesa.com';
        }


        try {
            $pdo = Connection::get()->connect();
            if ( $id == 0 ) {
                $sql = "INSERT INTO core.warehouse (code,name,description,address,id_warehouse_type,id_locale) VALUES (?,?,?,?,?,?)";
                $pdo->prepare($sql)->execute([$code, $name,$description,$address,$id_warehouse_type,$id_locale]);
            } else {

                $stmt = $pdo->prepare('SELECT code FROM core.business_subject WHERE mail=? AND id!=? ');
                $stmt->execute([$mail,$id]);
                $rows = $stmt->fetchAll( PDO::FETCH_OBJ );


                $existe='no';
                if(COUNT($rows)>0){
                    $existe='si';
                }
                
                if($existe=='no'){
                    $sql = "UPDATE core.business_subject SET mail=? WHERE id=?";
                    $pdo->prepare($sql)->execute([$mail,$id]);

                    $arr = array( 'update'=>'si');
                    echo json_encode($arr);

                }else{
                    $arr = array( 'update'=>'no');
                    echo json_encode($arr);
                }
                
            }

        } catch (PDOException $e) {
            //echo $e->getMessage();
            $arr = array( 'update'=>'no');
            echo json_encode($arr);
        }
    }


function updateMail(){
    $id = $_POST['id'];
    $mail = $_POST['lmail'];

    if($mail==''){
        $mail=null;
    }else{
        if(strpos($mail, '@')!==false){
            $mail=substr($mail, 0, strpos($mail, '@'));
        }
        $mail=$mail.'@olpesa.com';
    }


    try {
        $pdo = Connection::get()->connect();

        $stmt = $pdo->prepare('SELECT code FROM core.business_subject WHERE mail=? AND id!=? ');
        $stmt->execute([$mail,$id]);
        $rows = $stmt->fetchAll( PDO::FETCH_OBJ );


        $existe='no';
        if(COUNT($rows)>0){
            $existe='si';
        }
        
        if($existe=='no'){
            $sql = "UPDATE core.business_subject SET mail=? WHERE id=? ";
            $pdo->prepare($sql)->execute([$mail,$id]);

            $sql = "UPDATE core.operator SET username=? WHERE id_business_subject=? ";
            $pdo->prepare($sql)->execute([$mail,$id]);

            $arr = array( 'update'=>'si');
            echo json_encode($arr);

        }else{
            $arr = array( 'update'=>'no');
            echo json_encode($arr);
        }

    } catch (PDOException $e) {
        //echo $e->getMessage();
        $arr = array( 'update'=>'no');
        echo json_encode($arr);
    }
}


function saveQuiz(){
    $quizfill= json_decode($_POST['quizfill']);

    try {
        /*$pdo = Connection::get()->connect();
        $sql = "INSERT INTO emergency.quiz (id_recurrence,id_questionary,value,note) VALUES (?,?,?,?)";
        foreach ($quizfill as $item){
            $reference = explode("-", $item->reference);
            $id_questionary=intval($reference[0]);
            $id_recurrence=intval($reference[1]);
            $value =isset($item->value)? empty($item->value)? 'false':'true' :null;
            $note = empty($item->note)?null:$item->note;

            
            $pdo->prepare($sql)->execute([$id_recurrence,$id_questionary,$value,$note]);

        }*/

        $pdo = Connection::get()->connect();
        $sql = "UPDATE emergency.quiz SET value=?, note=?, answered=? WHERE id=?";
        
        foreach ($quizfill as $item){
            $id = $item->id;
            $value =isset($item->value)? empty($item->value)? 'false':'true' :null;
            $note = empty($item->note)?null:$item->note;
            
            $pdo->prepare($sql)->execute([$value,$note,true,$id]);
        }


        echo json_encode(['sucess'=>'si']);

    } catch (PDOException $e) {
        //echo $e->getMessage();
        //$arr = array( 'sucess'=>'no');
        $arr = array( 'error'=>$e->getMessage());
        echo json_encode($arr);
    }

}


function saveVisit(){
    $dni = $_POST['dni'];

    //date_default_timezone_set('America/Bogota');
    
    try {
        $pdo = Connection::get()->connect();

        buscarsiregistrado:

        //BUSCAMOS SI EL DNI ESTA REGISTRADO, ASIMISMO SI ES TRABAJADOR, SI YA HIZO UNA VISITA HOY DIA
        $stmt = $pdo->prepare("SELECT 
            S.id,
            CASE WHEN SS.id IS NULL THEN 'NO' ELSE 'SI' END AS worker,
            CASE WHEN V.id_subject IS NULL THEN 'NO' ELSE 'SI' END AS entered,
            V.id AS idvisit
            FROM core.subject S
            LEFT JOIN (SELECT C.id, S.id AS idsubject FROM core.charge C
                        INNER JOIN core.business_subject BS ON C.id_business_subject=BS.id
                        INNER JOIN core.subject S ON BS.id_subject=S.id
                        WHERE C.active=true AND S.code=?) SS ON S.id=SS.idsubject
            LEFT JOIN (SELECT V.id,V.id_subject FROM emergency.visit V 
                        WHERE TO_DATE(CAST(V.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE)  V ON S.id=V.id_subject
            WHERE S.code=?");

        $stmt->execute([$dni,$dni]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        
        $arr = array();
        if($row){

            //SI ESTA REGISTRADO, VERIFICAMOS SI INGRESO DURANTE EL DIA
            $id_visit=0;
            if(($row->entered)=='SI'){//SI YA VISITO DURANTE EL DIA EXTRAEMOS SU REGISTRO DE VISITA
                $id_visit=$row->idvisit;

            }else{//SI NO VISITO DURANTE EL DIA REGISTRAMOS SU VISITA
                $sql = "INSERT INTO emergency.visit (id_subject) VALUES (?)";
                $pdo->prepare($sql)->execute([$row->id]);
                $id_visit = $pdo->lastInsertId('emergency.visit_id_seq');
            }

            $id_reason=0;//4-TRABAJADOR
            if(($row->worker)=='SI'){
                $id_reason=4;//4-TRABAJADOR
                $arr = array( 'worker'=>'si');
            }else{
                $id_reason=1;//1-TRANSPORTISTA - CISTERNA / TRAILER
                $arr = array( 'worker'=>'no');
            }

            $stmtx = $pdo->prepare("SELECT R.id_visit,RR.quantity,RRR.hour as input_last,RRR.lapse,RE.temperature,RE.id_reason FROM emergency.recurrence R
                        LEFT JOIN (SELECT (COUNT( R.id)+1) AS quantity, R.id_visit 
                                FROM emergency.recurrence R 
                                WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE AND R.id_visit=?
                                GROUP BY R.id_visit) RR ON R.id_visit=RR.id_visit
                        LEFT JOIN(SELECT trunc(EXTRACT( epoch FROM (NOW()::timestamp - R.registration))/60) as lapse,age(NOW()::timestamp,R.registration ) AS hour,
                                R.id_visit  FROM emergency.recurrence R
                                WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE AND R.id_visit=?
                                ORDER BY R.ID DESC LIMIT 1) RRR ON R.id_visit=RRR.id_visit
                        LEFT JOIN(SELECT R.id_visit,R.temperature,R.id_reason,MIN(R.id)  FROM emergency.recurrence R
                            WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE AND R.id_visit=?
                            GROUP BY R.id_visit,R.temperature,R.id_reason
                            ORDER BY R.id_visit
                            LIMIT 1) RE ON R.id_visit=RE.id_visit                                
                        WHERE R.id_visit=? AND TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE
                        LIMIT 1");
            $stmtx->execute([$id_visit,$id_visit,$id_visit,$id_visit]);
            $rowx = $stmtx->fetch(PDO::FETCH_OBJ);

            /*if(($rowx->worker)=='SI'){
                $id_reason=4;//4-TRABAJADOR
            }else{
                $id_reason=1;//4-PUBLIC
            }*/
            $quantity=1;
            $lapse=5.0;//ESTABLECEMOS EL LAPSO DE TIEMPO TRANSCURRIDO EN 5, PARA EL VISITANTE

            if($rowx){
                $quantity=$rowx->quantity;
                $lapse=$rowx->lapse;//Obtenemos el tiempo transcurrido
                $id_reason=$rowx->id_reason;
            }

            if($lapse>=5.0){//Registramos si ya pasó 5 minutos
                $sqlR = "INSERT INTO emergency.recurrence (id_visit,id_reason,turn) VALUES (?,?,?)";
                $pdo->prepare($sqlR)->execute([$id_visit,$id_reason,$quantity]);
                $arr=array_merge($arr,array('success'=>'si'),array('saved'=>'si'));
                $idrecurrencesaved = $pdo->lastInsertId('emergency.recurrence_id_seq');


                //$datecapture = (new DateTime())->format('Ymd');
                $datecapture=date('Ymd');

                $flag=$datecapture.'|'.$dni;
                $iosstate='E';
                $idcontrolpoint=$_SESSION['controlpoint'];

                $stmtp = $pdo->prepare("SELECT P.id_control_point,P.action 
                    FROM emergency.permanence P 
                    WHERE P.flag LIKE ? 
                    ORDER BY P.id ASC");
                $stmtp->execute([$flag]);

                //$rowp = $stmtp->fetch(PDO::FETCH_OBJ);

                $array_pemanences=array();

                while ($rowp = $stmtp->fetch(PDO::FETCH_OBJ)) {
                    array_push($array_pemanences,$rowp);
                }

                if(count($array_pemanences)>0){
                    $countpermanences=0;
                    foreach ($array_pemanences as $keyc) {
                        if($idcontrolpoint==($keyc->id_control_point)){
                            $countpermanences++;
                        }
                    }
                    if ($countpermanences%2==0){
                        $iosstate='E';
                    }else{
                        $iosstate='S';
                    }

                }

                
                
                /*if($rowp){
                    $quantity=$rowx->quantity;
                    $lapse=$rowx->lapse;//Obtenemos el tiempo transcurrido
                }*/


                $sqlP = "INSERT INTO emergency.permanence (id_recurrence,flag,action,id_control_point) VALUES (?,?,?,?)";
                $pdo->prepare($sqlP)->execute([$idrecurrencesaved,$flag,$iosstate,$idcontrolpoint]);
                //$arr=array_merge($arr,array('success'=>'si'),array('saved'=>'si'));
                /*
                */

            }else{
                $arr=array_merge($arr,array('success'=>'si'),array('saved'=>'no'));
            }
            
            echo json_encode($arr);
            
        }else{
            //SI NO ESTA REGISTRADO, REGISTRAMOS PRIMERO AL VISITANTE

            $ur = "apisubject.olpesa.pe/dni/".$dni;
            $data = file_get_contents($ur);
            
            goto buscarsiregistrado;
            //$arr=array_merge($arr,array('success'=>'si'),array('saved'=>'si'),array('data'=>$data));
            //LUEGO, REGISTRAMOS SU VISITA

            echo json_encode($arr);
        }

        //CONSULTAMOS SI SE TRATA DE UN TRABAJADOR

        
    } catch (PDOException $e) {
        //echo $e->getMessage();
        $arr = array('worker'=>'no','success'=>'no');
        //$arr = array( 'worker'=>$e->getMessage());
        echo json_encode($arr);
    }

}


?>
