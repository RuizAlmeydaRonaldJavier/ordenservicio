<?php
  session_start();

  require_once '../../DAL/DBAccess.php';

  require_once '../../BOL/usuario.php';
  require_once '../../DAO/usuarioDAO.php';

  if(isset($_POST['usuario']) && isset($_POST['contrasenia'])){
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Usuarios
	$usuario = new Usuario();
	$usuarioDAO = new usuarioDAO();

	$usuario->__SET('usuario', $_POST['usuario']);
	$usuario->__SET('contrasenia', $_POST['contrasenia']);
	$usuario->__SET('id_perfil', $_POST['id_perfil']);

	$resultado_usuario = $usuarioDAO->validarUsuario($usuario);

	if (count($resultado_usuario) > 0)
	{
	  $_SESSION['id_usuario'] = $resultado_usuario[0]->id_usuario;
	  $_SESSION['usuario'] = $resultado_usuario[0]->usuario;
	  $_SESSION['id_perfil'] = $resultado_usuario[0]->id_perfil;
	  $_SESSION['tiempo_sess'] = time();
	  $urlPanel = "DESIGNER/proveedor/listarProveedor.php";
	  //"DESIGNER/administrado/principal.php";
	  //$urlPanel = ($resultado_usuario[0]->tipo_usuario == "ADMINISTRADOR") ? "DESIGNER/admin/index.php":
	  //"DESIGNER/administrado/principal.php";

	  $jsondata["success"] = 1;
	  $jsondata["data"] = array(
	  	'usuario' => "Hola",
	  	'urlPanel' => $urlPanel
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