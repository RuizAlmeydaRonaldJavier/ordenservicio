<?php 
session_start();
//importando el DBacces
require_once '../../DAL/DBAccess.php';

require_once '../../BOL/persona.php';
require_once '../../DAO/personaDAO.php';
require_once '../../BOL/usuario.php';
require_once '../../DAO/usuarioDAO.php';
require_once '../../BOL/sesion_usuario.php';
require_once '../../DAO/Sesion_usuarioDAO.php';
require_once '../../BOL/ambiente.php';


if(isset($_POST['nombreUsuario'])){
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Resoluciones
	$usuario = new Usuario();
	$usuarioDAO = new UsuarioDAO();

	$usuario->__SET('nom_usuario', $_POST['nombreUsuario']);

	$resultado_usuario = $usuarioDAO->Buscar_nombre_usuario_ajax($usuario);


	if (count($resultado_usuario)>0) {
		$jsondata["success"] = 1;
	    $jsondata["data"] = array(
	      
	      'tipo_usuario'          => $resultado_usuario[0]->tipo_usuario,
	      'nom_usuario'           => $resultado_usuario[0]->nom_usuario,
	      'estado'                => $resultado_usuario[0]->estado,
	      'id_usuario'            => $resultado_usuario[0]->id_usuario

	    );
	}else{
		$jsondata["success"] = 0;
	    $jsondata["data"] = array(
	      'message' => 'Error'
	    );
	}


?>