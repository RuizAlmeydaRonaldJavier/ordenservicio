<?php
//importando el DBacces
require_once '../../DAL/DBAccess.php';

require_once '../../BOL/meta.php';
require_once '../../DAO/metaDAO.php';

if(isset($_POST['meta_orden']))
{
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Resoluciones
	$meta = new Meta();
	$metaDAO = new MetaDAO();

	$meta->__SET('c1', $_POST['meta_orden']);
	$resultado_meta = $metaDAO->Buscar_meta_ajax($meta);

	if (count($resultado_meta) > 0)
	{
		$jsondata["success"] = 1;
		$jsondata["data"] = array(
	      'c1'    => $resultado_meta['0']->c1,
	      'c2'    => $resultado_meta['0']->c2,
	      'c3'    => $resultado_meta['0']->c3,
	      'c10'    => $resultado_meta['0']->c10,
	      'id_meta'    => $resultado_meta['0']->id_meta
	  );
	}
	else
	{
		$jsondata["success"] = 0;
	  $jsondata["data"] = array(
	      'message' => 'Error'
	  );
	}

	header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
?> 