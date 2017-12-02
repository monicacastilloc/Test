<?php
error_reporting(0);
header('Content-Type: application/json');
include '../functions.php';
//$_GET['Consultar']=1;
$pdo=new PDO("mysql:dbname=ambient;host=localhost","root","");
switch($_GET['Consultar']){
		// Buscar Último Dato
		case 1:
			$now = date("U") - 1530309600 . PHP_EOL; //timestamp database
			$dayago = date("U") - 1530309600 - 86400 . PHP_EOL; //timestamp database menos un dia
		    $stmt=$pdo->prepare("SELECT (1530309600 + start_date)*1000 as x, pyrgeo as y FROM clouds_lasilla  WHERE start_date > $dayago ORDER BY start_date DESC LIMIT 0,1");
		    //$stmt=$pdo->prepare("SELECT (1530309600 + start_date)*1000 as x, pyrgeo as y FROM clouds_lasilla ORDER BY start_date DESC LIMIT 0,1");
		    $stmt->execute();
			$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($rows, JSON_NUMERIC_CHECK);
			echo $json;		
		break; 
		// Buscar Todos los datos
		default:
			$now = date("U") - 1530309600 . PHP_EOL; //timestamp database
			$dayago = date("U") - 1530309600 - 86400 . PHP_EOL; //timestamp database menos un dia
			$stmt=$pdo->prepare("SELECT (1530309600 + start_date)*1000 as x, pyrgeo as y FROM clouds_lasilla WHERE start_date > $dayago ORDER BY start_date ASC");
			$stmt->execute();
			$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($rows, JSON_NUMERIC_CHECK);
			echo $json;
		break;
}
?>
