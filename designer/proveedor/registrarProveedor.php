<?php 
session_start();

//importando el DBacces
require_once '../../DAL/DBAccess.php';

//SEGURIDAD DE ACCESO DESDE ACA
//seguridad primer parametro es el tiempo de vida dentro de la web y la segunda que tipo de usuario es

//importando las clases y los dao
require_once '../../BOL/proveedor.php';
require_once '../../DAO/proveedorDAO.php';

//importando header
require '../layout/header.php';

$Proveedor = new Proveedor();
$ProveedorDAO = new ProveedorDAO();

$mensajeFinalS = file_get_contents('../msj/mensaje_general.php');

if(isset($_POST['btnGuardar']))
{

	$Proveedor->__SET('razon_social',          $_POST['inp_razon']);
	$Proveedor->__SET('ruc',                   $_POST['inp_ruc']);
	$Proveedor->__SET('dirección',             $_POST['inp_direcc']);
	$Proveedor->__SET('correo_electronico',    $_POST['inp_correo']);
    $Proveedor->__SET('telefono',              $_POST['inp_telefono']);

    $ProveedorDAO->Registrar_proveedor($Proveedor);

    echo $mensajeFinalS;
    DBAccess::rederigir("registrarProveedor.php");
}
?>
<!-- ************************************************* CONTENIDO ******************************************************* -->
<br> 
<div class="container">
    <div class="row">
        <div class="col-12 border cont-from" style="background: white;">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" >
               <div class="titulo-usuario mt-3 mb-3">      
                <h5 class="text-center"><i class="fas fa-user-friends"></i> REGISTRAR PROVEEDOR</h5>
            </div>
                <!-- <div class="form-group">
                  <label>Tipo Documento:</label>
                  <input type="text" class="form-control" name="" id="">
              </div> -->
              
          

            <div class="row">
                <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Razon Social:</strong>
                        <input type="text" class="form-control" id="NOMBRE" name="inp_razon" onkeyup="mayus(this);" required>
                    </div>
                </div>

                  <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Ruc:</strong>
                        <input type="text" class="form-control" name="inp_ruc" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

                <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Direccion:</strong>
                        <input type="text" class="form-control" id="APELLIDOP" name="inp_direcc" onkeyup="mayus(this);" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">  
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Correo:</strong>
                        <input id="email" type="email" class="form-control" name="inp_correo" data-validation="email" required>
                    </div>
                </div>

                <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Telefono:</strong>
                        <input type="text" class="form-control" name="inp_telefono" maxlength="9" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>
            </div>         

            <button name="btnGuardar" class="btn btn-primary"><i class="fa fa-check"></i> Registrar</button>
            <a href="./listarProveedor.php" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</a>
        </form>
        <br>                    
    </div>
</div>
</div>
<br> 

<?php require '../layout/footer.php'; ?>
