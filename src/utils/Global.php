<?php
	require_once __DIR__.'/../services/vendor/autoload.php';

	use Goutte\Client;


	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch($action) {
			case 'money_changetype' : getMoneychangetype();break;
			case 'delete' : deleteData();break;
			case 'reference_money' : loadMoney();break;
		}
	}else{
		saveData();
	}

function getMoneychangetype(){

	echo json_encode(getChangeType());
}



function getChangeType($pd,$pm,$py){
	
	remition:

	$client = new Client();
	$crawler = $client->request('GET', 'http://www.sunat.gob.pe/cl-at-ittipcam/tcS01Alias?mesElegido='.$pm.'&anioElegido='.$py.'&mes='.$pm.'&anho='.$py.'&accion=init');


	$tables = $crawler->filter('table')->each(function ($tb, $i) {
	    return $tb->filter('tr')->each(function ($tr, $i) {
	         return $tr->filter('td')->each(function ($td, $i) {
		        return trim($td->text());
		    });
	    });
	});

//	$vpotencial= array();
	$vconfirmed= array();

	if(count($tables[1][1])==0){//SI DEL MES NO HAY
		$ppm=intval($pm);
		$ppy=intval($py);
		$pd=31;
		if($ppm==1){
			$ppy=$ppy-1;
			$py=str_pad($ppy, 4, "0", STR_PAD_LEFT);
			$pm='12';

		}else {
			$ppm=$ppm-1;
			$pm=str_pad($ppm, 2, "0", STR_PAD_LEFT);
		}
		goto remition;

	}

	for ($i = 1; $i < count($tables[1]); $i++) {
		//echo '['.count($tables[1][$i]).']';
		for ($j = 0; $j < count($tables[1][$i])/3; $j++) {
			$ni=3*$j;
			if($tables[1][$i][$ni]<$pd){
				$vconfirmed = array("anio" => $py,"month" => $pm,"day" => $tables[1][$i][$ni],"shopvalue" =>$tables[1][$i][$ni+1],"salevalue" => $tables[1][$i][$ni+2],"precision" => 'NO');
			}elseif($tables[1][$i][$ni]==$pd){
				$vconfirmed = array("anio" => $py,"month" => $pm,"day" => $tables[1][$i][$ni],"shopvalue" =>$tables[1][$i][$ni+1],"salevalue" => $tables[1][$i][$ni+2],"precision" => 'YES');
			}else{
				break;
			}
		    /*echo $tables[1][$i][$ni]."\n";
		    echo $tables[1][$i][$ni+1]."\n";
		    echo $tables[1][$i][$ni+2]."\n";*/
		}
	}

	if(count($vconfirmed)==0){//SI DEL MES NO HAY
		$ppm=intval($pm);
		$ppy=intval($py);
		$pd=31;
		if($ppm==1){
			$ppy=$ppy-1;
			$py=str_pad($ppy, 4, "0", STR_PAD_LEFT);
			$pm='12';

		}else {
			$ppm=$ppm-1;
			$pm=str_pad($ppm, 2, "0", STR_PAD_LEFT);
		}
		goto remition;

	}

	return $vconfirmed;
}


?>