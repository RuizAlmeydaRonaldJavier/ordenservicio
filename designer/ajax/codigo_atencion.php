<?php 

//importando el DBacces
require_once '../../DAL/DBAccess.php';

require_once '../../BOL/Atencion.php';
require_once '../../DAO/AtencionDAO.php';

require_once '../../BOL/Ambiente.php';
require_once '../../DAO/AmbienteDAO.php';

require_once '../../BOL/Persona.php';
require_once '../../DAO/PersonaDAO.php';

require_once '../../BOL/Tipo_atencion.php';


if(isset($_POST['id_ambiente'])){
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Resoluciones
	$atencion = new Atencion();
	$atencionDAO = new AtencionDAO();

	$atencion->__GET('id_ambiente')->__SET('id_ambiente', $_POST['id_ambiente']);
	$resultado_atencion = $atencionDAO->Generar_codigo_atencion($atencion);


	if (count($resultado_atencion)>0) {
		$jsondata["success"] = 1;
	    $jsondata["data"] = array(
	      'codigo_unico'               => $resultado_atencion[0]->p_codigo_secundario
	    );
	}else{
		$jsondata["success"] = 0;
	    $jsondata["data"] = array(
	      'message' => 'Error'
	    );
	}

  	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);

}

?> 