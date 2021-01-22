<?php 
session_start();

//importando el DBacces
require_once '../../DAL/DBAccess.php';

//SEGURIDAD DE ACCESO DESDE ACA
//seguridad primer parametro es el tiempo de vida dentro de la web y la segunda que tipo de usuario es

//importando las clases y los dao
require_once '../../BOL/proveedor.php';
require_once '../../DAO/proveedorDAO.php';

require_once '../../BOL/tipoFactura.php';
require_once '../../DAO/tipoFacturaDAO.php';

//importando header
require '../layout/header.php';

$proveedor = new Proveedor();
$proveedorDAO = new ProveedorDAO();

$mensajeFinalS = file_get_contents('../utilidades/mensaje_general.php');

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

$tipos_facturas = new TipoFactura();
$tipos_facturasDAO = new TipoFacturaDAO();

$resultado_tipoFactura = $tipos_facturasDAO->listarTipoFactura();

?>
<!-- ************************************************* CONTENIDO ******************************************************* -->
<br> 
<div class="container">
  <div class="row">
    <div class="col-12 border cont-from" style="background: white;">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" >
        <div class="titulo-usuario mt-3 mb-3">
          <h5 class="text-center"><i class="fas fa-user-friends"></i> REGISTRAR ORDEN DE SERVICIO</h5>
        </div>
        <div class="pt-3 pr-2 pl-2 mb-2 pb-1 marco">
          <div class="row campo-altura">
            <div class="col-5">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label col-form-label-sm">Código:</label>
                <div class="col-sm-5 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_codigo" name="inp_codigo" required="">
                </div>
              </div>
            </div>
            <div class="col-4">
            </div>
            <div class="col-3">
              <div class="form-group row">
                <label class="col-sm-5 col-form-label col-form-label-sm text-right">Fecha:</label>
                <div class="col-sm-7 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_fecha" name="inp_fecha" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-5">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label col-form-label-sm">Ruc:</label>
                <div class="col-sm-7 pl-0">
                  <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="inp_ruc" name="inp_ruc"  maxlength="11" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                  <input name="id_proveedor" id="id_proveedor" type="hidden">
                  <div class="input-group-append">
                    <button class="btn btn-outline-info btn-sm" type="button" name="btnBuscarRuc" id="btnBuscarRuc">Buscar</button>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <div class="col-4">
            </div>
            <div class="col-3">
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-5 col-form-label col-form-label-sm text-right">Tipo factura:</label>
                <div class="col-sm-7 pl-0">
                  <select class="form-control btn-sm" id="id_tipofactura" name="id_tipofactura">
                    <?php foreach($resultado_tipoFactura as $r_g): ?>
                          <option value="<?php echo $r_g->__GET('id_tipoFactura').$r_g->__GET('porcentaje');?>">
                              <?php echo $r_g->__GET('descripcion');?>
                          </option>
                      <?php endforeach;?>             
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-5">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label col-form-label-sm pr-0">Razón Social:</label>
                <div class="col-sm-9 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_razon_social" name="inp_razon_social">
                </div>
              </div>
            </div>
            <div class="col-4">
            </div>
            <div class="col-3">
              <div class="form-group row">
                <label class="col-sm-5 col-form-label col-form-label-sm pr-0"></label>
                <div class="col-sm-7 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_porcentaje">
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-5">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label col-form-label-sm">Dirección:</label>
                <div class="col-sm-9 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_direccion" name="inp_direccion">
                </div>
              </div>
            </div>
            <div class="col-7">
            </div>
          </div>
        </div>
        <div class="pt-3 pr-2 pl-2 mb-2 pb-1 marco">
          <div class="row campo-altura">
            <div class="col-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm te">Requerimiento de ref.:</label>
                <div class="col-sm-10 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inputPassword">
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-12">
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">Informe de ref.:</label>
                <div class="col-sm-10 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inputPassword">
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
          <div class="col-12">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label col-form-label-sm">Observación:</label>
              <div class="col-sm-10 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="pt-3 pr-2 pl-2 mb-2 pb-1 marco">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="col-form-label-sm" for="exampleFormControlTextarea1">Descripción del servicio:</label>
              <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="5"></textarea>
            </div>
          </div>
        </div>

        <div class="row campo-altura">
          <div class="col-5">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Meta:</label>
              <div class="col-sm-5 pl-0">
                <div class="input-group">
                  <input id="inpAgrProve" type="text" class="form-control form-control-sm" maxlength="11" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                  <input name="inpIdPersonaAgrUsu" id="inpIdPersonaAgrUsu" type="hidden">
                  <div class="input-group-append">
                    <button class="btn btn-outline-info btn-sm" type="button" name="btnBuscarRuc" id="btnBuscarRuc">Buscar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-3">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-6 col-form-label col-form-label-sm text-right">Importe:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-5">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Código:</label>
              <div class="col-sm-5 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
          <div class="col-3">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-6 col-form-label col-form-label-sm text-right">Sub Total:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-5">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Código:</label>
              <div class="col-sm-5 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
          <div class="col-3">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-6 col-form-label col-form-label-sm text-right">I.G.V:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-5">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Código:</label>
              <div class="col-sm-5 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
          <div class="col-3">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-6 col-form-label col-form-label-sm text-right">Importe neto:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-6 col-form-label col-form-label-sm text-right">Retención:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-6 col-form-label col-form-label-sm text-right">Importe neto:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" id="inputPassword">
              </div>
            </div>
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