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

$proveedor = new Proveedor();
$proveedorDAO = new ProveedorDAO();

$mensajeFinalS = file_get_contents('../msj/mensaje_general.php');

if(isset($_POST['btnGuardar']))
{

	/*$proveedor->__SET('documento',            $_POST['inp_documento']);
	$proveedor->__SET('nombre',               $_POST['inp_nombre']);
	$proveedor->__SET('apellido_paterno',     $_POST['inp_apellido_paterno']);
	$proveedor->__SET('apellido_materno',     $_POST['inp_apellido_materno']);
    $proveedor->__SET('fecha_nacimiento',     $_POST['date_fecha_nacimiento']);
    $proveedor->__SET('correo',               $_POST['inp_correo']);
    $proveedor->__SET('sexo',                 $_POST['inp_sexo']);

    $proveedorDAO->Registrar_per($proveedor);

    echo $mensajeFinalS;
    DBAccess::rederigir("agregar_persona.php");*/
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
                        <strong style="color: #17a2b8;">Numero Documento:</strong>
                        <input type="text" class="form-control" name="inp_documento" maxlength="8" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Nombre:</strong>
                        <input type="text" class="form-control" id="NOMBRE" name="inp_nombre" onkeyup="mayus(this);" required>
                    </div>
                </div>
                <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Apellido Paterno:</strong>
                        <input type="text" class="form-control" id="APELLIDOP" name="inp_apellido_paterno" onkeyup="mayus(this);" required>
                    </div>
                </div>
                <div class="col-4">  
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Apellido Materno:</strong>
                        <input type="text" class="form-control" id="APELLIDOM" name="inp_apellido_materno" onkeyup="mayus(this);" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Fecha Nacimiento:</strong>
                        <input type="date" class="form-control" name="date_fecha_nacimiento" required>
                    </div>
                </div>   
                <div class="col-4">  
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Correo:</strong>
                        <input id="email" type="email" class="form-control" name="inp_correo" data-validation="email">
                    </div>
                </div>        
                <div class="col-4"> 
                    <div class="form-group"> 
                        <strong style="color: #17a2b8;">Sexo:</strong>
                        <select class="form-control" name="inp_sexo" id="sel1">
                            <option value="MASCULINO">MASCULINO</option>
                            <option value="FEMENINO">FEMENINO</option>
                        </select>                
                    </div>
                </div>
            </div>         

            <button name="btnGuardar" class="btn btn-primary"><i class="fa fa-check"></i> Registrar</button>
            <a href="./lista_atencion.php" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</a>
        </form>
        <br>                    
    </div>
</div>
</div>
<br> 

<?php require '../layout/footer.php'; ?>
