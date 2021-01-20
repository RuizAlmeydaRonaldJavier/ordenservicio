<?php 
session_start();

//importando el DBacces
require_once '../../DAL/DBAccess.php';

//SEGURIDAD DE ACCESO DESDE ACA
//seguridad primer parametro es el tiempo de vida dentro de la web y la segunda que tipo de usuario es

//importando las clases y los dao
require_once '../../BOL/producto.php';
require_once '../../DAO/productoDAO.php';

require_once '../../BOL/unidadMedida.php';
require_once '../../DAO/unidadMedidaDAO.php';

//importando header
require '../layout/header.php';

$Producto = new Producto();
$ProductoDAO = new ProductoDAO();

$mensajeFinalS = file_get_contents('../msj/mensaje_general.php');

if(isset($_POST['btnGuardar']))
{

	$Producto->__SET('codigo',           $_POST['inp_cod']);
	$Producto->__SET('descripcion',      $_POST['inp_des']);
	$Producto->__SET('id_unidadMedida',  $_POST['inp_unidadM']);

    $ProductoDAO->Registrar_producto($Producto);

    echo $mensajeFinalS;
    DBAccess::rederigir("registrarProducto.php");
}

$unidades_medidas = new UnidadMedida();
$unidades_medidasDAO = new UnidadMedidaDAO();

$resultado_unidades = $unidades_medidasDAO->listarUnidadMedida();

?>
<!-- ************************************************* CONTENIDO ******************************************************* -->
<br> 
<div class="container">
    <div class="row">
        <div class="col-12 border cont-from" style="background: white;">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" >
               <div class="titulo-usuario mt-3 mb-3">      
                <h5 class="text-center"><i class="fas fa-user-friends"></i> REGISTRAR PRODUCTO</h5>
            </div>
                <!-- <div class="form-group">
                  <label>Tipo Documento:</label>
                  <input type="text" class="form-control" name="" id="">
              </div> -->
              
          

            <div class="row">
                <div class="col-4"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Codigo:</strong>
                        <input type="text" class="form-control" id="NOMBRE" name="inp_cod" onkeyup="mayus(this);" required>
                    </div>
                </div>

                  <div class="col-5"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Descripccion:</strong>
                        <input type="text" class="form-control" name="inp_des" maxlength="25" onkeyup="mayus(this);" required>
                    </div>
                </div>

                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;"> Unidad Medida:</strong>
                        <select class="form-control" name="inp_unidadM" id="inp_unidadM">
                         <?php foreach($resultado_unidades as $r_g): ?>
                          <option value="<?php echo $r_g->__GET('id_unidadMedida');?>">
                              <?php echo $r_g->__GET('descripcion');?>
                          </option>
                      <?php endforeach;?>  
                  </select>

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
