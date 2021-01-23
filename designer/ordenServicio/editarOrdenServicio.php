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

require_once '../../BOL/meta.php';
require_once '../../DAO/metaDAO.php';

require_once '../../BOL/ordenServicio.php';
require_once '../../DAO/ordenServicioDAO.php';

//importando header
require '../layout/header.php';

$proveedor = new Proveedor();
$proveedorDAO = new ProveedorDAO();

$tipos_facturas = new TipoFactura();
$tipos_facturasDAO = new TipoFacturaDAO();

$ordenServicio = new OrdenServicio();
$ordenServicioDAO = new OrdenServicioDAO();

$id_ordenServicio = isset($_GET['id_ordenServicio']) ? $_GET['id_ordenServicio'] : 0 ;
$ordenServicio->__SET('id_ordenServicio',       $id_ordenServicio);
$resultadoOrdenServicio = $ordenServicioDAO->buscarOrdenServicio($ordenServicio);

$mensajeFinalS = file_get_contents('../msj/mensaje_general.php');

if(isset($_POST['btnGuardar']))
{

	$ordenServicio->__SET('requerimiento_referencia',  $_POST['inp_requerimientoReferencia']);
  $ordenServicio->__SET('informe_referencia',  $_POST['inp_informeReferencia']);
  $ordenServicio->__SET('descripcion',  $_POST['inp_descripcion']);
  $ordenServicio->__SET('importe',  $_POST['inp_importe']);
  $ordenServicio->__SET('sub_total',  $_POST['inp_subTotal']);
  $ordenServicio->__SET('igv',  $_POST['inp_igv']);
  $ordenServicio->__SET('importe_neto01',  $_POST['inp_importeNeto01']);
  $ordenServicio->__SET('retencion',  $_POST['inp_retencion']);
  $ordenServicio->__SET('importe_neto02',  $_POST['inp_importeNeto02']);
  $ordenServicio->__SET('observacion',  $_POST['inp_observacion']);
  $ordenServicio->__GET('id_proveedor')->__SET('id_proveedor',  $_POST['id_proveedor']);
  $ordenServicio->__GET('id_meta')->__SET('id_meta',  $_POST['id_meta']);
  $ordenServicio->__GET('id_tipoFactura')->__SET('id_tipoFactura',  $_POST['id_tipoFactura']);

  $ordenServicioDAO->registrarOrdenServicio($ordenServicio);

  echo $mensajeFinalS;
  DBAccess::rederigir("listarOrdenServicio.php");
}

$resultado_tipoFactura = $tipos_facturasDAO->listarTipoFactura();
foreach($resultadoOrdenServicio as $resultado):
?>
<!-- ************************************************* CONTENIDO ******************************************************* -->
<br> 
<div class="container">
  <div class="row">
    <div class="col-12 border cont-from pr-5 pl-5" style="background: white;">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" >
        <div class="titulo-usuario mt-3 mb-3">
          <h5 class="text-center"><i class="fas fa-user-friends"></i> MODIFICAR ORDEN DE SERVICIO</h5>
        </div>
        <div class="pt-4 pr-2 pl-2 mb-2 pb-3 marco">
          <div class="row campo-altura">
            <div class="col-8">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Código:</label>
                <div class="col-sm-2 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_codigo" name="inp_codigo" value="<?php echo $resultado->__GET('id_proveedor')->__GET('id_proveedor'); ?>" required="" disabled="">
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label col-form-label-sm text-right">Fecha:</label>
                <div class="col-sm-6 pl-0">
                  <input type="text" class="form-control form-control-sm" style="text-align:right;" id="" name="" value="<?php echo date('d-m-Y', strtotime($resultado->__GET('fecha'))); ?>" required="" disabled="" >
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-8">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Ruc:</label>
                <div class="col-sm-3 pl-0">
                  <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="inp_ruc" name="inp_ruc"  maxlength="11" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required="" value="<?php echo $resultado->__GET('id_proveedor')->__GET('ruc'); ?>">
                  <input name="id_proveedor" id="id_proveedor" value="<?php echo $resultado->__GET('id_proveedor')->__GET('id_proveedor'); ?>" type="hidden">
                  <div class="input-group-append">
                    <button class="btn btn-outline-info btn-sm" type="button" name="btnBuscarRuc" id="btnBuscarRuc"><i class="fas fa-search"></i></button>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label col-form-label-sm text-right">Tipo factura:</label>
                <div class="col-sm-6 pl-0">
                  <select class="form-control btn-sm" style="text-align-last:right;" id="id_tipoFactura" name="id_tipoFactura" onchange="seleccionarFactura();">
                    <?php foreach($resultado_tipoFactura as $r_g): ?>
                          <option value="<?php echo $r_g->__GET('id_tipoFactura').$r_g->__GET('porcentaje');?>" <?php echo ($r_g->__GET('id_tipoFactura') == $resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura')) ? 'selected' : ''; ?>>
                              <?php echo $r_g->__GET('descripcion');?>
                          </option>
                      <?php endforeach;?>             
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-8">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm pr-0">Razón Social:</label>
                <div class="col-sm-6 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_razon_social" name="inp_razon_social" value="<?php echo $resultado->__GET('id_proveedor')->__GET('razon_social'); ?>" required="" disabled="">
                </div>
              </div>
            </div>
            <div class="col-4">
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-8">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Dirección:</label>
                <div class="col-sm-6 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_direccion" name="inp_direccion" value="<?php echo $resultado->__GET('id_proveedor')->__GET('direccion'); ?>" required="" disabled="">
                </div>
              </div>
            </div>
            <div class="col-4">
            </div>
          </div>
        </div>
        <div class="pt-4 pr-2 pl-2 mb-2 pb-3 marco">
          <div class="row campo-altura">
            <div class="col-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm te">Requerimiento:</label>
                <div class="col-sm-10 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_requerimientoReferencia" name="inp_requerimientoReferencia" value="<?php echo $resultado->__GET('requerimiento_referencia'); ?>" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
            <div class="col-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Informe de ref.:</label>
                <div class="col-sm-10 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_informeReferencia" name="inp_informeReferencia" value="<?php echo $resultado->__GET('informe_referencia'); ?>" required="">
                </div>
              </div>
            </div>
          </div>
          <div class="row campo-altura">
          <div class="col-12">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Observación:</label>
              <div class="col-sm-10 pl-0">
                <input type="text" class="form-control form-control-sm" id="inp_observacion" name="inp_observacion" value="<?php echo $resultado->__GET('observacion'); ?>">
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="pt-4 pr-2 pl-2 mb-2 pb-3 marco">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="col-form-label-sm">Descripción del servicio:</label>
              <textarea class="form-control form-control-sm" id="inp_descripcion" name="inp_descripcion" rows="7" required=""><?php echo $resultado->__GET('descripcion'); ?></textarea>
            </div>
          </div>
        </div>

        <div class="row campo-altura">
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Meta:</label>
              <div class="col-sm-2 pl-0">
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="inp_c1" name="inp_c1" maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required=""  value="<?php echo $resultado->__GET('id_meta')->__GET('c1'); ?>">
                  <input name="id_meta" id="id_meta" type="hidden">
                  <div class="input-group-append">
                    <button class="btn btn-outline-info btn-sm" type="button" name="btnBuscarMeta" id="btnBuscarMeta"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Importe:</label>
              <div class="col-sm-6 pl-0">
                <input type="double" class="form-control form-control-sm" align="right" style="text-align:right;" value="<?php echo $resultado->__GET('importe'); ?>" id="inp_importe" name="inp_importe" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Función:</label>
              <div class="col-sm-2 pl-0">
                <input type="text" class="form-control form-control-sm" maxlength="4" id="inp_c2" name="inp_c2" value="<?php echo $resultado->__GET('id_meta')->__GET('c2'); ?>" required="" readonly="">
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group row" style="display: <?php echo ($resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '1' || $resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '2') ? 'none' : ''; ?>;" id="div_subTotal">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Sub Total:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_subTotal" name="inp_subTotal" value="<?php echo $resultado->__GET('sub_total'); ?>" readonly="">
              </div>
            </div>
            <div class="form-group row" id="div_retencion" style="display: <?php echo ($resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '1' || $resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '2') ? '' : 'none'; ?>;">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Retención:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_retencion" name="inp_retencion" value="<?php echo $resultado->__GET('retencion'); ?>" readonly="">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Programa:</label>
              <div class="col-sm-2 pl-0">
                <input type="text" class="form-control form-control-sm" maxlength="7" id="inp_c3" name="inp_c3" value="<?php echo $resultado->__GET('id_meta')->__GET('c3'); ?>" required="" disabled="">
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group row" style="display: <?php echo ($resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '1' || $resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '2') ? 'none' : ''; ?>;" id="div_igv">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">I.G.V:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_igv" name="inp_igv" value="<?php echo $resultado->__GET('igv'); ?>" readonly="">
              </div>
            </div>
            <div class="form-group row" id="div_importeNeto02" style="display: <?php echo ($resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '1' || $resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '2') ? '' : 'none'; ?>;">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Importe neto:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right; font-weight: bold;" id="inp_importeNeto02" name="inp_importeNeto02" value="<?php echo $resultado->__GET('importe_neto02'); ?>" readonly="">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Descripción:</label>
              <div class="col-sm-10 pl-0">
                <input type="text" class="form-control form-control-sm" id="inp_c10" name="inp_c10" value="<?php echo $resultado->__GET('id_meta')->__GET('c10'); ?>" required="" disabled="">
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group row" id="div_importeNeto01" style="display: <?php echo ($resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '1' || $resultado->__GET('id_tipoFactura')->__GET('id_tipoFactura') == '2') ? 'none' : ''; ?>;">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Importe neto:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right; font-weight: bold;" id="inp_importeNeto01" name="inp_importeNeto01" value="<?php echo $resultado->__GET('importe_neto01'); ?>" readonly="">
              </div>
            </div>
          </div>
        </div>
      </div>
        <button name="btnGuardar" class="btn btn-primary"><i class="fa fa-check"></i> Registrar</button>
        <a href="./listarOrdenServicio.php" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</a>
      </form>
      <br>
    </div>
  </div>
</div>
<br> 

<?php 
  endforeach;
  require '../layout/footer.php';
  ?>