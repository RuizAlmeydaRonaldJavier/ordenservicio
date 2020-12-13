<?php 
session_start();
//importando el DBacces
require_once '../../DAL/DBAccess.php';

if(isset($_POST['time_user'])){
	
	$tiempo_restante = (time() - $_SESSION['tiempo_sess']);

	$jsondata["success"] = 1;
	$jsondata["data"] = array(
		'tiempo_restante' => $tiempo_restante
	);
	
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata, JSON_FORCE_OBJECT);
}


?>