<?php 

//importando el DBacces
require_once '../../DAL/DBAccess.php';

require_once '../../BOL/proveedor.php';
require_once '../../DAO/proveedorDAO.php';

if(isset($_POST['ruc_prove'])){
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Resoluciones
	$proveedor = new Proveedor();
	$proveedorDAO = new ProveedorDAO();

	$proveedor->__SET('ruc', $_POST['ruc_prove']);
	$resultado_proveedor = $proveedorDAO->Buscar_proveedor_ajax($proveedor);


	if (count($resultado_proveedor)>0) {
		$jsondata["success"] = 1;
	    $jsondata["data"] = array(
	      'razon_social'    => $resultado_proveedor[0]->razon_social,
	      'ruc'     		=> $resultado_proveedor[0]->ruc,
	      'dirección'     	=> $resultado_proveedor[0]->dirección,
	      'id_proveedor'    => $resultado_proveedor[0]->id_proveedor
	    );
	}else{
		$jsondata["success"] = 0;
	    $jsondata["data"] = array(
	      'message' => 'Error'
	    );
	}



// if(isset($_POST['idPersona'])){
// 	//acceso a la archivo bd
// 	$dba = new DBAccess();

// 	//Resoluciones
// 	$usuario = new Usuario();
// 	$usuarioDAO = new UsuarioDAO();

// 	$usuario->__SET('documento', $_POST['idPersona']);
// 	$resultado_usuario = $UsuarioDAO->Buscar_usuario_dni_ajax($usuario);


// 	if (count($resultado_usuario)>0) {
// 		$jsondata["success"] = 1;
// 	    $jsondata["data"] = array(
	    	
// 	      'idpersona'               => $resultado_persona[0]->idpersona,

// 	    );
// 	}else{
// 		$jsondata["success"] = 0;
// 	    $jsondata["data"] = array(
// 	      'message' => 'Error'
// 	    );
// 	}

  	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);

}


if(isset($_POST['NombreUsuario'])){
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Resoluciones
	$usuario = new Usuario();
	$usuarioDAO = new UsuarioDAO();

	$usuario->__SET('nom_usuario', $_POST['NombreUsuario']);
	$resultado_usuario = $usuarioDAO->Buscar_nombre_usuario_ajax($usuario);


	if (count($resultado_usuario)>0) {
		$jsondata["success"] = 1;
	    $jsondata["data"] = array(
	      'estado'               => $resultado_usuario[0]->estado,
	      'nom_usuario'          => $resultado_usuario[0]->nom_usuario,
	      'tipo_usuario'         => $resultado_usuario[0]->tipo_usuario,
	      'id_usuario'           => $resultado_usuario[0]->id_usuario
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