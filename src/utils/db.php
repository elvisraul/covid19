<?php 
	$host='localhost';
	$db = 'olpesa';
	$username = 'postgres';
	$password = 'root';

	$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
	try{
		$conn = new PDO($dsn);
		if($conn){
			echo "Connectado correctamente!";
		}
	}catch (PDOException $e){
		echo $e->getMessage();
	} 
?>

