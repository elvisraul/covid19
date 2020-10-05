<?php

require ("../../services/vendor/autoload.php");
require ("../../utils/Connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Fpdf\Fpdf;

use Util\Connection as Connection;

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'list' : listData();break;
        case 'load_userolpesoft' : loadUserolpesot();break;
        case 'load_reason' : loadReason();break;
        case 'load_issuesgeneral' : loadIssuesgeneral();break;
        case 'load_historialtemperature' : loadHistorialtemperature();break;
        case 'load_worker' : loadWorker();break;
        case 'load_questionary' : loadQuestionary();break;
        case 'put_temperature' : putTemperature();break;
        case 'generate_user' : registerUp();break;
        case 'update_mail' : updateMail();break;
        case 'save_quiz' :saveQuiz();break;
        case 'save_visit' :saveVisit();break;
        case 'download_asistence' :downloadAsistance();break;
        case 'download_quiz' :downloadQuiz();break;
    }
}else{
    saveData();
}

function listData(){

    $id = $_POST['idsubject'];
    $idreason = $_POST['idreason'];
    $dtslct = $_POST['dates'];

    $partstringsql="";

    if($id!=0){
        $partstringsql=" S.id=".$id." AND ";
    }
    if($idreason!=0){
        $partstringsql=" R.id_reason=".$idreason." AND ";
    }


    try {
        $pdo = Connection::get()->connect();
        /*$stmt = $pdo->query("SELECT 
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
            CASE WHEN U.action='E' THEN 'INGRESÓ' ELSE 'SALIÓ' END AS action
            FROM emergency.visit V
            INNER JOIN core.subject S ON V.id_subject=S.id 
            LEFT JOIN (SELECT C.id,S.id AS idsubject FROM core.charge C
                    INNER JOIN core.business_subject BS ON C.id_business_subject=BS.id
                    INNER JOIN core.subject S ON BS.id_subject=S.id
                    WHERE C.active=true) DD ON S.id=DD.idsubject
            LEFT JOIN (SELECT R.id_visit, COUNT(R.id) as quantity,min(R.id) as id_quiz,max(R.id) as id_temperature
                    FROM emergency.recurrence R
                    INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                    WHERE P.action='E' AND TO_DATE(CAST(registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE 
                    GROUP BY id_visit) R ON V.id=R.id_visit
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
            ORDER BY V.registration DESC");*/

            $stmt = $pdo->prepare("SELECT 
            S.id,
            S.code,
            S.complete,
            S.phone,
            to_char(M.registration, 'YYYY-MM-DD HH24:MI:SS') AS registration,
            CASE WHEN DD.id IS NULL THEN 'NO' ELSE 'SI' END AS worker,
            R.quantity,
            R.id_reason,
            V.id AS idvisit,
            R.id_quiz AS idquiz,
            M.id AS idtemperature,
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
            LEFT JOIN (SELECT R.id_visit,R.id_reason, COUNT(R.id) as quantity,min(R.id) as id_quiz,max(R.id) as id_temperature
                    FROM emergency.recurrence R
                    INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                    WHERE P.action='E' AND TO_DATE(CAST(registration AS TEXT), 'YYYY-MM-DD')=? 
                    GROUP BY id_visit,R.id_reason) R ON V.id=R.id_visit
            LEFT JOIN (SELECT R.id_visit,R.temperature,min(R.id) as id_quiz,R.id_reason
                    FROM emergency.recurrence R
                    INNER JOIN emergency.reason RR ON R.id_reason=RR.id 
                    WHERE TO_DATE(CAST(registration AS TEXT), 'YYYY-MM-DD')=? 
                    GROUP BY R.id_visit,R.temperature,R.id_reason) RR ON R.id_quiz=RR.id_quiz                    
            LEFT JOIN (SELECT R.id_visit,MAX(R.id) AS id,MAX(R.registration) AS registration
                    FROM emergency.recurrence R
                    INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                    WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=?
                    GROUP BY R.id_visit) M ON V.id=M.id_visit  
            LEFT JOIN (SELECT R.id,R.temperature,R.registration
                    FROM emergency.recurrence R
                    WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=?) T ON M.id=T.id
            LEFT JOIN (SELECT P.id_recurrence,P.action
                    FROM emergency.recurrence R
                    INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                    WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=? ) U ON M.id=U.id_recurrence  
            LEFT JOIN (SELECT Q.id_recurrence, (CASE WHEN Q.answered IS NULL THEN 'NO' ELSE 'SI' END) AS fill
                    FROM emergency.quiz Q
                    GROUP BY Q.id_recurrence,Q.answered) Q ON R.id_quiz=Q.id_recurrence
            WHERE ".$partstringsql." TO_DATE(CAST(V.registration as TEXT),'YYYY-MM-DD')=?
            ORDER BY V.registration DESC");

        $stmt->execute([$dtslct,$dtslct,$dtslct,$dtslct,$dtslct,$dtslct]);

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
    $ds = substr(strval($_POST['dates']), 0, 10);

    try {
        $pdo = Connection::get()->connect();
        $stmt = $pdo->prepare("SELECT 
            R.turn,
            CASE WHEN P.action='E' THEN 'INGRESÓ' ELSE 'SALIÓ' END AS action,
            TO_CHAR(R.registration , 'HH24:MI:SS') AS registration,
            CASE WHEN P.action='S' THEN '-' ELSE CAST ( R.temperature AS varchar ) END AS temperature
            FROM emergency.recurrence R 
            INNER JOIN emergency.permanence P ON R.id=P.id_recurrence
            WHERE R.id_visit=? AND TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=TO_DATE('".$ds."', 'YYYY-MM-DD')
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


function loadWorker(){
    $reason = $_POST['reason'];
    $ds = $_POST['dates'];

    try {
        $results["data"]= array();
        $pdo = Connection::get()->connect();
        $stmt = $pdo->prepare("SELECT 
            S.id,
            S.code,
            S.complete,
            S.phone
            FROM emergency.visit V
            INNER JOIN core.subject S ON V.id_subject=S.id 
            LEFT JOIN (SELECT C.id,S.id AS idsubject FROM core.charge C
                    INNER JOIN core.business_subject BS ON C.id_business_subject=BS.id
                    INNER JOIN core.subject S ON BS.id_subject=S.id) C ON S.id=C.idsubject
            LEFT JOIN (SELECT R.id_reason,R.id_visit FROM emergency.recurrence R) R ON R.id_visit=V.id
            WHERE R.id_reason=? AND TO_DATE(CAST(V.registration AS TEXT), 'YYYY-MM-DD')=TO_DATE(?, 'YYYY-MM-DD')
            GROUP BY S.ID
            ORDER BY S.complete ASC");
        $stmt->execute([$reason,strval($ds)]);
        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $results["data"]= $row;
        }
        echo json_encode($results);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}


    function putTemperature(){

        $idtemperature = $_POST['idtemperature'];
        $temperature = $_POST['temperature'];
        try {
            $pdo = Connection::get()->connect();
            $stmt = $pdo->prepare("UPDATE emergency.recurrence SET temperature=? 
                WHERE id=? ");
            $stmt->execute([$temperature,$idtemperature]);

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


function saveVisit(){
    $dni = $_POST['dni'];

    try {
        $pdo = Connection::get()->connect();

        //BUSCAMOS SI EL DNI ESTA REGISTRADO
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
                $id_reason=1;//4-PUBLIC
                $arr = array( 'worker'=>'no');
            }

            $stmtx = $pdo->prepare("SELECT R.id_visit,RR.quantity,RRR.hour as input_last,RRR.lapse FROM emergency.recurrence R
                        LEFT JOIN (SELECT (COUNT( R.id)+1) AS quantity, R.id_visit 
                                FROM emergency.recurrence R 
                                WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE AND R.id_visit=?
                                GROUP BY R.id_visit) RR ON R.id_visit=RR.id_visit
                        LEFT JOIN(SELECT trunc(EXTRACT( epoch FROM (NOW()::timestamp - R.registration))/60) as lapse,age(NOW()::timestamp,R.registration ) AS hour,
                                R.id_visit  FROM emergency.recurrence R
                                WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE AND R.id_visit=?
                                ORDER BY R.ID DESC LIMIT 1) RRR ON R.id_visit=RRR.id_visit
                        WHERE R.id_visit=? AND TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=CURRENT_DATE
                        LIMIT 1");
            $stmtx->execute([$id_visit,$id_visit,$id_visit]);
            $rowx = $stmtx->fetch(PDO::FETCH_OBJ);

            /*if(($rowx->worker)=='SI'){
                $id_reason=4;//4-TRABAJADOR
            }else{
                $id_reason=1;//4-PUBLIC
            }*/
            $quantity=1;
            $lapse=5.0;

            if($rowx){
                $quantity=$rowx->quantity;
                $lapse=$rowx->lapse;
            }

            if($lapse>=5.0){
                $sql = "INSERT INTO emergency.recurrence (id_visit,id_reason,turn) VALUES (?,?,?)";
                $pdo->prepare($sql)->execute([$id_visit,$id_reason,$quantity]);
                $arr=array_merge($arr,array('success'=>'si'),array('saved'=>'si'));
            }else{
                $arr=array_merge($arr,array('success'=>'si'),array('saved'=>'no'));
            }
            
            echo json_encode($arr);
        }else{
            //SI NO ESTA REGISTRADO, REGISTRAMOS PRIMERO AL VISITANTE

            //LUEGO, REGISTRAMOS SU VISITA            
        }

        //CONSULTAMOS SI SE TRATA DE UN TRABAJADOR

        
    } catch (PDOException $e) {
        //echo $e->getMessage();
        $arr = array('worker'=>'no','success'=>'no');
        //$arr = array( 'worker'=>$e->getMessage());
        echo json_encode($arr);
    }

}


function downloadAsistance(){

    $id = $_POST['idsubject'];
    $idreason = $_POST['idreason'];
    $ds = strval($_POST['dates']);

    $pdo = Connection::get()->connect();

    $partstringsql="";

    $namesubject = 'Todos';
    if($id!=0){
        $partstringsql=" S.id=".$id." AND ";
        $namesubject = $_POST['namesubject'];
    }

    if($idreason!=0){
        $partstringsql=" R.id_reason=".$idreason." AND ";
    }

    $datenow = date('Y-m-d');
    $weekday = (new DateTime($ds))->format('N');



    try {

        $stmtp = $pdo->query("SELECT 
            S.id,
            S.code,
            S.complete,
            S.phone,
            S.mail,
            TO_CHAR(I.registration , 'HH24:MI:SS') as input,
            I.action,
            RE.description as lapse
            FROM emergency.visit V
            INNER JOIN core.subject S ON V.id_subject=S.id 
            LEFT JOIN (SELECT C.id,S.id AS idsubject FROM core.charge C
                    INNER JOIN core.business_subject BS ON C.id_business_subject=BS.id
                    INNER JOIN core.subject S ON BS.id_subject=S.id
                    WHERE C.active=true) DD ON S.id=DD.idsubject            
            LEFT JOIN (SELECT R.id_visit,R.id_reason, COUNT(R.id) as quantity,min(R.id) as ingreso,max(R.id) as id_temperature
                            FROM emergency.recurrence R
                            INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                            WHERE P.action='E' AND TO_DATE(CAST(registration AS TEXT), 'YYYY-MM-DD')=TO_DATE('".$ds."', 'YYYY-MM-DD') 
                            GROUP BY id_visit,R.id_reason) R ON V.id=R.id_visit
            LEFT JOIN (SELECT R.id,R.registration,P.action,trunc(EXTRACT( epoch FROM (R.registration-TO_TIMESTAMP(TO_DATE('".$ds."', 'YYYY-MM-DD') ||' '||TO_CHAR(C.input , 'HH24:MI:SS'),'YYYY-MM-DD HH24:MI:SS')))/60) as lapse
                        FROM emergency.recurrence R
                        INNER JOIN emergency.permanence P ON R.id=P.id_recurrence
                        INNER JOIN emergency.visit V ON R.id_visit=V.id
                        INNER JOIN core.subject S ON V.id_subject=S.id
                        LEFT JOIN (SELECT SS.id,C.extrahours,P.input ,P.hours,P.break,PP.input_p,PP.hours_p,PP.break_p FROM core.charge C
                            INNER JOIN core.business_subject BS ON C.id_business_subject=BS.id
                            INNER JOIN core.subject SS ON BS.id_subject=SS.id
                            LEFT JOIN (SELECT input_proposed AS input,hours_proposed AS hours,break_proposed AS break,target,id_subject FROM rrhh.programme) P ON P.target=TO_DATE('".$ds."', 'YYYY-MM-DD') AND SS.id=P.id_subject
                            LEFT JOIN (SELECT input_".$weekday." AS input_p, hours_".$weekday." AS hours_P, break_".$weekday." AS break_p, id_subject FROM rrhh.payroll) PP ON SS.id=PP.id_subject
                            WHERE C.active='TRUE') C ON S.id=C.id
                        WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=TO_DATE('".$ds."', 'YYYY-MM-DD') ) I ON R.ingreso=I.id
            LEFT JOIN (SELECT P.id_recurrence,P.action
                            FROM emergency.recurrence R
                            INNER JOIN emergency.permanence P ON R.id=P.id_recurrence 
                            WHERE TO_DATE(CAST(R.registration AS TEXT), 'YYYY-MM-DD')=TO_DATE('".$ds."', 'YYYY-MM-DD')  ) U ON R.id_temperature=U.id_recurrence
            LEFT JOIN (SELECT RE.id,RE.description FROM emergency.reason RE) RE ON R.id_reason=RE.id                            
            WHERE ".$partstringsql."  TO_DATE(CAST(V.registration as TEXT),'YYYY-MM-DD')=TO_DATE('".$ds."', 'YYYY-MM-DD') 
            GROUP BY S.ID,I.registration,I.action,RE.description
            ORDER BY S.complete ASC");

        $stmtp->execute();





        $spreadsheet = new Spreadsheet();

        $spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        //$spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
        $spreadsheet->getDefaultStyle()->getFont()->setSize(8);
        $spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.5);
        $spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.5);
        $spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.5);
        $spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.5);


        $sheet = $spreadsheet->getActiveSheet()->setTitle("Asistencia");
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:B2');
        $sheet->mergeCells('E2:F2');
        $sheet->mergeCells('A3:F3');
        $sheet->setCellValue('A1', 'ASISTENCIA');
        $sheet->setCellValue('A2', 'PERSONAL');
        $sheet->setCellValue('C2', $namesubject);
        $sheet->setCellValue('D2', 'FECHA');
        $sheet->setCellValue('E2', strval($ds));
        $sheet->setCellValue('A3', 'REGISTRO DE ASISTENCIA');
        $sheet->setCellValue('A4', 'INGRESO')
                ->setCellValue('B4','DNI')
                ->setCellValue('C4','COMPLETO')
                ->setCellValue('D4','TELEFONO')
                ->setCellValue('E4','CORREO')
                ->setCellValue('F4','CONDICION');

        $stmtp->execute();
        //$rowp = $stmtp->fetch(PDO::FETCH_ASSOC); 


        $sheet->getStyle("A1:F4")->getFont()->setBold( true );
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('I3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('L3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('D4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('F4')->getAlignment()->setHorizontal('center');

        $rowNumber=5;

        $arr = $stmtp->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $row) {
            $sheet->setCellValue('A'.$rowNumber,$row['input'])
                 ->setCellValue('B'.$rowNumber,$row['code'])
                 ->setCellValue('C'.$rowNumber,$row['complete'])
                 ->setCellValue('D'.$rowNumber,$row['phone'])
                 ->setCellValue('E'.$rowNumber,$row['mail'])
                 ->setCellValue('F'.$rowNumber,$row['lapse']);
            $rowNumber++;
        }
        $rowNumber--;

        $sheet->getStyle('A1:F'.$rowNumber)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DASHED);
         //$sheet->getStyle('B2')->getAll()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DASHDOT);
        
        //$sheet->getFont()->setSize(10);


        $writer = new Xlsx($spreadsheet);
        $writer->save('../../resources/asistance.xlsx');


        $arr = array( 'url'=>'src/resources/asistance.xlsx');
        echo json_encode($arr);


    } catch (PDOException | Exception $e) {

        $arr = array( 'url'=>'','msg'=>$e->getMessage());
        //echo $e->getMessage();
        echo json_encode($arr);
    }


}

function mLether($numberMonth){

    $letherMonth = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre');

    return $letherMonth[$numberMonth-1];
}



function downloadQuiz(){

    $porciones = explode("-",  $_POST['recurrence_qh']);
    $idrecurrence =$porciones[0];
    $idQH =$porciones[1];

     try {

        $pdo = Connection::get()->connect();

        // INICIO DATOS DE SUJETO ENCUESTADO
        $stmts = $pdo->prepare("SELECT  R.id,R.id_reason
        FROM emergency.recurrence R
        WHERE R.id=?");
        $stmts->execute([$idrecurrence]);
        $rRecurrence = $stmts->fetch(PDO::FETCH_OBJ);

        $idreason=$rRecurrence->id_reason;


        if ($idreason==4) {
            downloadQuizW($idrecurrence,$idQH);//TRABAJADORES

        }else{
            downloadQuizX($idrecurrence,$idQH);
        }

    } catch (PDOException $e) {

        //$arr = array( 'url'=>'','msg'=>$e->getMessage());
        //echo $e->getMessage();
        echo json_encode(array());
    }

    

}

function downloadQuizW($idrecurrence,$idQH){

    /*$porciones = explode("-",  $_POST['recurrence_qh']);
    $idrecurrence =$porciones[0];
    $idQH =$porciones[1];*/

   

    //$datenow=date('Y-m-d');


    try {

        $pdo = Connection::get()->connect();

        // INICIO DATOS DE SUJETO ENCUESTADO
        $stmts = $pdo->prepare("SELECT  R.id,
            TO_CHAR(V.registration, 'YYYY-MM-DD') registration,
            S.complete,
            S.code,
            S.address,
            S.phone,
            RR.sign,
            UD.name disctrict,
            UP.name province,
            UR.name region 
        FROM emergency.recurrence R
        INNER JOIN emergency.reason RR ON R.id_reason=RR.id
        INNER JOIN emergency.visit V ON R.id_visit=V.id
        INNER JOIN core.subject S ON V.id_subject=S.id
        LEFT JOIN core.ubige UD ON S.id_residence_place =UD.id
        LEFT JOIN core.ubige UP ON UD.id_ubige=UP.id
        LEFT JOIN core.ubige UR ON UP.id_ubige=UR.id
        WHERE R.id=?");
        $stmts->execute([$idrecurrence]);
        $rSubject = $stmts->fetch(PDO::FETCH_OBJ);

        $namesubject=$rSubject->complete;
        $codesubject=$rSubject->code;
        $addresssubject=$rSubject->address;
        $dplacesubject=$rSubject->disctrict;
        $pplacesubject=$rSubject->province;
        $rplacesubject=$rSubject->region;
        $datesubject=$rSubject->registration;
        $signsubject=$rSubject->sign;
        $phonesubject=$rSubject->phone;
        // FIN DATOS DE SUJETO ENCUESTADO


        // INICIO DATOS DE QUESTIONARIO
        $stmtqh = $pdo->prepare("SELECT 
            QHP.id,
            RDD.v_1_1 AS code,
            RDD.v_1_2 AS name,
            QHP.value 
            FROM emergency.questionaryhead_parameter QHP
            INNER JOIN emergency.questionary_head QH ON QHP.id_questionaryhead=QH.id
            INNER JOIN core.rule_demand_detail RDD ON QHP.id_parameter=RDD.id
            WHERE QH.id=?
            ORDER BY QHP.id ASC");
        $stmtqh->execute([$idQH]);
        $rParameters = $stmtqh->fetchALL(PDO::FETCH_OBJ);

        
        $titles=array();//1
        

        $noteend=array();//5
        $notehomepre=array();
        $notehomepos=array();
        
        $notehomeadd='';//8
        
        $formatcode='';//2
        $formatversion='';//3
        $formatdate='';//4

        foreach ($rParameters as $p) {

            switch ($p->code) {
                case '1':
                    array_push($titles,$p->value);
                    break;
                case '2':
                    $formatcode=$p->value;
                    break;
                case '3':
                    $formatversion=$p->value;
                    break;
                case '4':
                    $formatdate=$p->value;
                    break;
                case '5':
                    array_push($noteend,$p->value);
                    break;
                case '6':
                    # code...
                    break;
                case '7':
                    # code...
                    break;
                case '8':
                    
                    $notehomeadd=$p->value;
                    break;
                case '9':
                    # code...
                    break;
                default:
                    # code...
                    break;
            }
        }
        // FIN DATOS DE QUESTIONARIO




        $stmtp = $pdo->prepare("SELECT Q.id,
            Q.value,
            Q.note,
            QQ.position,
            QU.precision,
            QH.description,
            QH.name,
            S.code,
            S.complete
            FROM emergency.quiz Q
            INNER JOIN emergency.questionary QQ ON Q.id_questionary=QQ.id
            INNER JOIN emergency.question QU ON QQ.id_question=QU.id
            INNER JOIN emergency.questionary_head QH ON QQ.id_questionary_head=QH.id
            INNER JOIN emergency.recurrence R ON Q.id_recurrence=R.id 
            INNER JOIN emergency.visit V ON R.id_visit=V.id 
            INNER JOIN core.subject S ON V.id_subject=S.id 
            WHERE R.id=? AND QQ.id_questionary_head=? ORDER BY Q.ID ASC");

        $stmtp->execute([$idrecurrence,$idQH]);
        $rObjects = $stmtp->fetchAll(PDO::FETCH_OBJ);


        $pdf= new Fpdf();
        $pdf->AliasNbPages('{totalPages}');
        $pdf->AddPage();
        
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(10,5);


        $pdf->Cell(35,20,$pdf->Image('../../resources/logo.jpg', 11, 5.5,32),1,0,'C');
        
        

        

        $pdf->SetFont('Arial','B',11.5);
        $pdf->SetFillColor(252, 202, 152);
        
        if(count($titles)<2 || count($titles)>4){

            if(count($titles)==0){
                $pdf->Cell(110,20,'',1,1,'C',true);
            }else{
                $pdf->Cell(110,20,iconv('UTF-8', 'windows-1252',$titles[0]==null?'':$titles[0]),1,1,'C',true);
            }
            

        }else{

            $pdf->Cell(110,8,iconv('UTF-8', 'windows-1252',$titles[0]==null?'':$titles[0]),'LRT',1,'C',true);
            $pdf->SetXY(45,13);
            $pdf->SetFont('Arial','',9);

            $titleformmulated='';
            for ($i=1; $i<count($titles) ; $i++) { 
                $titleformmulated=$titleformmulated.$titles[$i]."\n";
            }

            if(count($titles)==2){
                 $titleformmulated=$titleformmulated."\n"."\n";
            }

            if(count($titles)==3){
                $titleformmulated=$titleformmulated."\n";
            }

            $pdf->MultiCell(110,4,iconv('UTF-8', 'windows-1252', $titleformmulated),'LRB','C',true);

            
        }

        

        $pdf->SetFillColor(256, 256, 256);
        $pdf->SetXY(155,5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,5,$formatcode==null?'':$formatcode,1,1,'C');
        $pdf->SetXY(155,10);
        $pdf->Cell(0,5,iconv('UTF-8', "windows-1252", $formatversion==null?'':$formatversion),'R',1,'C');
        $pdf->SetXY(155,15) ;
        $pdf->Cell(0,5,iconv('UTF-8', "windows-1252", $formatdate==null?'':$formatdate),'R',1,'C');
        $pdf->SetXY(155,20);
        $pdf->Cell(0,5,iconv('UTF-8', "windows-1252","                     Página ". $pdf->PageNo() . " de {totalPages}" ),'LRB',1,'C');
        

        $pdf->SetFont('Arial','',9);
        $pdf->Ln();
        $pdf->SetXY(10,27);
        $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',
            'Por el presente documento, yo '.$namesubject.' identificado con  DNI N° '.$codesubject.' y con domicilio en '.$addresssubject.' del distrito de '.$dplacesubject.' de la provincia de '.$pplacesubject.' del departamento de '.$rplacesubject.$notehomeadd)
            ,0);


        foreach ($rObjects as $object) {

            $pdf->Ln();
            $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',
                ($object->position).' '.($object->precision))
                ,0);
            $pdf->Cell(10,4.5,'SI',0,0,'R');
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(0,0,256);
            $pdf->Cell(9,4,($object->value)==null?'':'X',1,0,'C',true);
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',9);
            $pdf->Cell(25,4.5,'NO',0,0,'R');
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(0,0,256);
            $pdf->Cell(9,4,($object->value)==null?'X':'',1,1,'C',true);
            $pdf->SetTextColor(0,0,0);
            //$pdf->SetFont('Arial','',9);

            if(($object->note)!=null){
                $pdf->SetFont('Arial','IB',8);
                $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252','          '.($object->note))
                    ,0,1);
            }
            $pdf->SetFont('Arial','',9);

        }

        $pdf->Ln();

        $noteendformmulated='';
        foreach ($noteend as $noteone) {
            $noteendformmulated=$noteendformmulated.$noteone."\n";
        }
        $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',$noteendformmulated),0);
        


        $pdf->Ln();
        $pdf->Cell(10,5,'Villa Palma, '.substr($datesubject,-2).' de '.mLether(intval(substr($datesubject,5,2))).' del '.substr($datesubject,0,4),0,1,'L');

        $pdf->Cell(0,15,'',0,1,'L',0);   

        
        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();
        $pdf->Cell(55,12,$pdf->Image('../../resources/id/46033275_firma.jpg',$current_x, $current_y-4,55),0,0,'C');
        //$pdf->Cell(55,12,'',0,0,'L',0,true);   
        $pdf->Cell(100,12,'',0,0,'L',0,true);

        $current_y = $pdf->GetY();
        $current_x = $pdf->GetX();
        $pdf->Cell(25,12,$pdf->Image('../../resources/id/46033275_huella.jpg',$current_x-4, $current_y,32),'LTR',0,'L');
        
        /*$current_y = $pdf->GetY();
        $current_x = $pdf->GetX();
        $pdf->Cell(25,12,,0,0,'C');*/
        
       

        $pdf->Ln();

        
        $pdf->Cell(55,5,'','B',0,'C',0);  
        $pdf->Cell(100,5,'',0,0,'L',0);
        $pdf->Cell(25,5,'','LR',0,'L',0);

        

        


        $pdf->Ln();

        $pdf->Cell(55,5,'Firma del '.$signsubject,0,0,'C',0);  
        $pdf->Cell(100,5,'',0,0,'L',0);
        $pdf->Cell(25,5,'','LR',0,'L',0);

        $pdf->Ln();

        $pdf->Cell(55,5,iconv('UTF-8', 'windows-1252','D.N.I. N° : '.sprintf("%'.17d",substr($codesubject,0,4)).sprintf("%'.-17d\n",substr($codesubject,-4))),0,0,'LB',0);  
        $pdf->Cell(100,5,'',0,0,'L',0);
        $pdf->Cell(25,5,'','LR',0,'L',0);

        $pdf->Ln();

        $fillstringphone=$phonesubject==null || $phonesubject==''?sprintf("%'.45s",''): sprintf("%'.17d",substr($phonesubject,0,4)).sprintf("%'.-18d\n",substr($phonesubject,-6));

        $pdf->Cell(55,5,'Celular : '.$fillstringphone,'',0,'LB',0);   
        $pdf->Cell(100,5,'',0,0,'L',0);
        $pdf->Cell(25,5,'','LBR',0,'L',0);

        $pdf->Ln();

        $pdf->Cell(55,5,'',0,0,'LB',0);   
        $pdf->Cell(100,5,'',0,0,'L',0);
        $pdf->Cell(25,5,'Huella Dactilar',0,0,'C',0);

        $pdf->SetXY(10,27);




        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();


        $pdf->Output('../../resources/PDF_Quiz.pdf','F');

        /*header('Content-Type: application/pdf'); 
        header('Content-Description: inline; filename.pdf'); */
        //header('Content-Disposition: attachment; filename=' . $pdf);
       //send data back to javascript
        //echo json_encode(array( 'url'=>$pdf));
        //header('Content-Type: application/json');
        $arr = array( 'url'=>'src/resources/PDF_Quiz.pdf');
        echo json_encode($arr);


        /*$arr = array( 'url'=>'src/resources/asistance.xlsx');
        echo json_encode($arr);*/




    } catch (PDOException | Exception $e) {

        $arr = array( 'url'=>'','msg'=>$e->getMessage());
        //echo $e->getMessage();
        echo json_encode($arr);
    }


}




function downloadQuizX($idrecurrence,$idQH){

    /*$porciones = explode("-",  $_POST['recurrence_qh']);
    $idrecurrence =$porciones[0];
    $idQH =$porciones[1];*/

   

    //$datenow=date('Y-m-d');


    try {

        $pdo = Connection::get()->connect();

        // INICIO DATOS DE SUJETO ENCUESTADO
        $stmts = $pdo->prepare("SELECT  R.id,
            TO_CHAR(V.registration, 'YYYY-MM-DD') registration,
            S.complete,
            S.code,
            S.address,
            RR.sign,
            UD.name disctrict,
            UP.name province,
            UR.name region 
        FROM emergency.recurrence R
        INNER JOIN emergency.reason RR ON R.id_reason=RR.id
        INNER JOIN emergency.visit V ON R.id_visit=V.id
        INNER JOIN core.subject S ON V.id_subject=S.id
        LEFT JOIN core.ubige UD ON S.id_residence_place =UD.id
        LEFT JOIN core.ubige UP ON UD.id_ubige=UP.id
        LEFT JOIN core.ubige UR ON UP.id_ubige=UR.id
        WHERE R.id=?");
        $stmts->execute([$idrecurrence]);
        $rSubject = $stmts->fetch(PDO::FETCH_OBJ);

        $namesubject=$rSubject->complete;
        $codesubject=$rSubject->code;
        $addresssubject=$rSubject->address;
        $dplacesubject=$rSubject->disctrict;
        $pplacesubject=$rSubject->province;
        $rplacesubject=$rSubject->region;
        $datesubject=$rSubject->registration;
        $signsubject=$rSubject->sign;
        // FIN DATOS DE SUJETO ENCUESTADO


        // INICIO DATOS DE QUESTIONARIO
        $stmtqh = $pdo->prepare("SELECT 
            QHP.id,
            RDD.v_1_1 AS code,
            RDD.v_1_2 AS name,
            QHP.value 
            FROM emergency.questionaryhead_parameter QHP
            INNER JOIN emergency.questionary_head QH ON QHP.id_questionaryhead=QH.id
            INNER JOIN core.rule_demand_detail RDD ON QHP.id_parameter=RDD.id
            WHERE QH.id=?
            ORDER BY QHP.id ASC");
        $stmtqh->execute([$idQH]);
        $rParameters = $stmtqh->fetchALL(PDO::FETCH_OBJ);

        
        $titles=array();//1

        $noteend=array();//5
        
        $notehomepre=array();
        $notehomepos=array();
        
        $notehomeadd='';//8

        $formatcode='';//2
        $formatversion='';//3
        $formatdate='';//4

        foreach ($rParameters as $p) {

            switch ($p->code) {
                case '1':
                    array_push($titles,$p->value);
                    break;
                case '2':
                    $formatcode=$p->value;
                    break;
                case '3':
                    $formatversion=$p->value;
                    break;
                case '4':
                    $formatdate=$p->value;
                    break;
                case '5':
                    array_push($noteend,$p->value);
                    break;
                case '6':
                    # code...
                    break;
                case '7':
                    # code...
                    break;
                case '8':
                    $notehomeadd=$p->value;
                    break;
                case '9':
                    # code...
                    break;
                default:
                    # code...
                    break;
            }
        }
        // FIN DATOS DE QUESTIONARIO




        $stmtp = $pdo->prepare("SELECT Q.id,
            Q.value,
            Q.note,
            QQ.position,
            QU.precision,
            QH.description,
            QH.name,
            S.code,
            S.complete
            FROM emergency.quiz Q
            INNER JOIN emergency.questionary QQ ON Q.id_questionary=QQ.id
            INNER JOIN emergency.question QU ON QQ.id_question=QU.id
            INNER JOIN emergency.questionary_head QH ON QQ.id_questionary_head=QH.id
            INNER JOIN emergency.recurrence R ON Q.id_recurrence=R.id 
            INNER JOIN emergency.visit V ON R.id_visit=V.id 
            INNER JOIN core.subject S ON V.id_subject=S.id 
            WHERE R.id=? AND QQ.id_questionary_head=? ORDER BY Q.ID ASC");

        $stmtp->execute([$idrecurrence,$idQH]);
        $rObjects = $stmtp->fetchAll(PDO::FETCH_OBJ);


        $pdf= new Fpdf();
        $pdf->AliasNbPages('{totalPages}');
        $pdf->AddPage();
        
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(10,5);


        $pdf->Cell(35,20,$pdf->Image('../../resources/logo.jpg', 11, 5.5,32),1,0,'C');
        
        

        

        $pdf->SetFont('Arial','B',11.5);
        $pdf->SetFillColor(252, 202, 152);
        
        if(count($titles)<2 || count($titles)>4){

            if(count($titles)==0){
                $pdf->Cell(110,20,'',1,1,'C',true);
            }else{
                $pdf->Cell(110,20,iconv('UTF-8', 'windows-1252',$titles[0]==null?'':$titles[0]),1,1,'C',true);
            }
            

        }else{

            $pdf->Cell(110,8,iconv('UTF-8', 'windows-1252',$titles[0]==null?'':$titles[0]),'LRT',1,'C',true);
            $pdf->SetXY(45,13);
            $pdf->SetFont('Arial','',9);

            $titleformmulated='';
            for ($i=1; $i<count($titles) ; $i++) { 
                $titleformmulated=$titleformmulated.$titles[$i]."\n";
            }

            if(count($titles)==2){
                 $titleformmulated=$titleformmulated."\n"."\n";
            }

            if(count($titles)==3){
                $titleformmulated=$titleformmulated."\n";
            }

            $pdf->MultiCell(110,4,iconv('UTF-8', 'windows-1252', $titleformmulated),'LRB','C',true);

            
        }

        

        $pdf->SetFillColor(256, 256, 256);
        $pdf->SetXY(155,5);
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(0,5,$formatcode==null?'':$formatcode,1,1,'C');
        $pdf->SetXY(155,10);
        $pdf->Cell(0,5,iconv('UTF-8', "windows-1252", $formatversion==null?'':$formatversion),'R',1,'C');
        $pdf->SetXY(155,15) ;
        $pdf->Cell(0,5,iconv('UTF-8', "windows-1252", $formatdate==null?'':$formatdate),'R',1,'C');
        $pdf->SetXY(155,20);
        $pdf->Cell(0,5,iconv('UTF-8', "windows-1252","                     Página ". $pdf->PageNo() . " de {totalPages}" ),'LRB',1,'C');
        



        
        $pdf->Ln();
        $pdf->SetFont('Arial','',9);
        /*$pdf->SetXY(10,27);
        $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',
            'Por el presente documento, yo '.$namesubject.' identificado con  DNI N° '.$codesubject.' y con domicilio en '.$addresssubject.' del distrito de '.$dplacesubject.' de la provincia de '.$pplacesubject.' del departamento de '.$rplacesubject.$notehomeadd)
            ,0);*/


        $pdf->Cell(120,4,iconv('UTF-8', 'windows-1252','Sr(es) : '),'LRT',0,'L');
        $pdf->Cell(0,4,iconv('UTF-8', 'windows-1252','Fecha :'),'LRT',1,'L');

        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(120,4,iconv('UTF-8', 'windows-1252','            '.$namesubject),'LRB',0,'L');
        $pdf->Cell(0,4,iconv('UTF-8', 'windows-1252','              '.$datesubject),'LRB',1,'L');
        
        $pdf->SetFillColor(255, 245, 238);

        $pdf->Cell(100,8,iconv('UTF-8', 'windows-1252','INDICADORES DEL PROTOCOLO'),1,0,'C',true);
        $pdf->Cell(20,4,iconv('UTF-8', 'windows-1252','CUMPLE'),'LRT',0,'C',true);
        $pdf->Cell(0,8,iconv('UTF-8', 'windows-1252','OBSERVACIONES'),1,0,'C',true);
        $pdf->Cell(0,4,'',0,1);

        $pdf->SetFillColor(252, 202, 152);
        $pdf->Cell(100,4,'',0);
        $pdf->Cell(10,4,iconv('UTF-8', 'windows-1252','SI'),1,0,'C');
        $pdf->Cell(10,4,iconv('UTF-8', 'windows-1252','NO'),1,0,'C');
        $pdf->Cell(0,4,'',0,1);

        $pdf->SetFont('Arial','',9); 

        

        foreach ($rObjects as $object) {

            $current_y = $pdf->GetY();
            $current_x = $pdf->GetX();
            $height_cell=4;


            //$pdf->Ln();
            $pdf->MultiCell(100,4,iconv('UTF-8', 'windows-1252',
                ($object->position).' '.($object->precision))
                ,1,'L',0);

            $oldx_current_y = $pdf->GetY();
            $oldx_current_x = $pdf->GetX();


            $pdf->SetXY($current_x +100,$current_y);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(0,0,256);
            $pdf->MultiCell(10,($oldx_current_y-$current_y),($object->value)==null?'':'X',1,'C');
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial','',9);
            //$pdf->Cell(25,4.5,'NO',0,0,'R');
            $pdf->SetXY($current_x +110,$current_y);
            $pdf->SetFont('Arial','B',9);
            $pdf->SetTextColor(0,0,256);
            $pdf->MultiCell(10,($oldx_current_y-$current_y),($object->value)==null?'X':'',1,'C');
            $pdf->SetTextColor(0,0,0);
            //$pdf->SetFont('Arial','',9);

            $pdf->SetXY($current_x +120,$current_y);
            

            if(($object->note)!=null){
                 $pdf->SetFont('Arial','I',8);
                if(($oldx_current_y-$current_y)>4){
                    if(($oldx_current_y-$current_y)>8){
                        $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',substr($object->note,0,150).'...'),1,1);
                    }else{
                        $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',substr($object->note,0,100).'...'),1,1);    
                    }
                    
                }else{
                     $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',substr($object->note,0,50).' ...'),1,1);
                }

               
               // $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',$object->note),1,1);

            }else{
                $pdf->MultiCell(0,($oldx_current_y-$current_y),'',1,1);
            }
            $pdf->SetFont('Arial','',9);

        }

        $pdf->Ln();

        /*$noteendformmulated='';
        foreach ($noteend as $noteone) {
            $noteendformmulated=$noteendformmulated.$noteone."\n";
        }
        $pdf->MultiCell(0,4,iconv('UTF-8', 'windows-1252',$noteendformmulated),0);*/
        


        /*$pdf->Ln();
        $pdf->Cell(10,5,'Villa Palma, '.substr($datesubject,-2).' de '.mLether(intval(substr($datesubject,5,2))).' del '.substr($datesubject,0,4),0,1,'L');

        $pdf->Cell(0,15,'',0,1,'L',0);   

        $pdf->Cell(55,12,'',0,0,'L',0,true);   
        $pdf->Cell(80,12,'',0,0,'L',0,true);*/
        $pdf->Cell(0,10,'',0,0,'L',0,true);

        $pdf->Ln();

        $pdf->Cell(55,5,'','B',0,'C',0);  
        $pdf->Cell(80,5,'',0,0,'L',0);
        $pdf->Cell(55,5,'','B',0,'L',0);

        $pdf->Ln();

        $pdf->Cell(55,5,'AGENTE DE SEGURDAD' ,0,0,'C',0);  
        $pdf->Cell(80,5,'',0,0,'L',0);
        $pdf->Cell(55,5,'SUPERVISOR DE SSOMA',0,0,'C',0);

        $pdf->Ln();

        $pdf->Cell(55,5,'',0,0,'LB',0);
        $pdf->Cell(80,5,'',0,0,'L',0);
        $pdf->Cell(55,5,'',0,0,'L',0);

        $pdf->Ln();

        $pdf->Cell(55,5,'','',0,'LB',0);   
        $pdf->Cell(80,5,'',0,0,'L',0);
        $pdf->Cell(55,5,'','',0,'L',0);

        $pdf->Ln();

        $pdf->Cell(55,5,'',0,0,'LB',0);   
        $pdf->Cell(80,5,'',0,0,'L',0);
        $pdf->Cell(55,5,'',0,0,'C',0);

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();


        $pdf->Output('../../resources/PDF_Quiz.pdf','F');

        /*header('Content-Type: application/pdf'); 
        header('Content-Description: inline; filename.pdf'); */
        //header('Content-Disposition: attachment; filename=' . $pdf);
       //send data back to javascript
        //echo json_encode(array( 'url'=>$pdf));
        //header('Content-Type: application/json');
        $arr = array( 'url'=>'src/resources/PDF_Quiz.pdf');
        echo json_encode($arr);


        /*$arr = array( 'url'=>'src/resources/asistance.xlsx');
        echo json_encode($arr);*/




    } catch (PDOException | Exception $e) {

        $arr = array( 'url'=>'','msg'=>$e->getMessage());
        //echo $e->getMessage();
        echo json_encode($arr);
    }


}



?>
