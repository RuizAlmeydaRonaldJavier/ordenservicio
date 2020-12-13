<?php 

//importando el DBacces
require_once '../../DAL/DBAccess.php';

require_once '../../BOL/persona.php';
require_once '../../DAO/personaDAO.php';

require_once '../../BOL/usuario.php';
require_once '../../DAO/usuarioDAO.php';


if(isset($_POST['documentoPersona'])){
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Resoluciones
	$persona = new Persona();
	$personaDAO = new PersonaDAO();

	$persona->__SET('documento', $_POST['documentoPersona']);
	$resultado_persona = $personaDAO->Buscar_persona_ajax($persona);


	if (count($resultado_persona)>0) {
		$jsondata["success"] = 1;
	    $jsondata["data"] = array(
	      'nombre'               => $resultado_persona[0]->nombre,
	      'apellido_paterno'     => $resultado_persona[0]->apellido_paterno,
	      'apellido_materno'     => $resultado_persona[0]->apellido_materno,
	      'fecha_nacimiento'     => $resultado_persona[0]->fecha_nacimiento,
	      'correo'               => $resultado_persona[0]->correo,
	      'sexo'                 => $resultado_persona[0]->sexo,
	      'documento'            => $resultado_persona[0]->documento,
	      'id_persona'           => $resultado_persona[0]->id_persona
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