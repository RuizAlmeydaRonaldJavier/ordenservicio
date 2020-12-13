<?php

require_once '../../DAL/DBAccess.php';

require_once '../../BOL/atencion.php';
require_once '../../DAO/atencionDAO.php';

require_once '../../BOL/ambiente.php';
require_once '../../DAO/ambienteDAO.php';

require_once '../../BOL/persona.php';
require_once '../../DAO/personaDAO.php';

require_once '../../BOL/ambiente.php';

require_once '../../BOL/tipo_atencion.php';

require_once '../../BOL/sesion_usuario.php';
require_once '../../DAO/sesion_usuarioDAO.php';

require_once '../../BOL/usuario_ambiente.php';
require_once '../../BOL/usuario.php';

// Finds all server sessions
session_start();

$sesion_usuario = new Sesion_usuario();
$sesion_usuarioDAO = new Sesion_usuarioDAO();


$usuario_Ambiente = new Usuario_Ambiente();
$usuario_Ambiente->__SET('id_usuario_ambiente', $_SESSION['id_usuario_ambiente']);

$sesion_usuarioDAO->Actualizar_session_usuario($usuario_Ambiente);



// Stores in Array
$_SESSION = array();
// Swipe via memory
if (ini_get("session.use_cookies")) {
    // Prepare and swipe cookies
    $params = session_get_cookie_params();
    // clear cookies and sessions
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// Just in case.. swipe these values too
ini_set('session.gc_max_lifetime', 0);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
// Completely destroy our server sessions..
session_destroy();

header('location: ../../index.php');
?>