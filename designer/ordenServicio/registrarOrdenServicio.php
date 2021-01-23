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
    <div class="col-12 border cont-from pr-5 pl-5" style="background: white;">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" >
        <div class="titulo-usuario mt-3 mb-3">
          <h5 class="text-center"><i class="fas fa-user-friends"></i> REGISTRAR ORDEN DE SERVICIO</h5>
        </div>
        <div class="pt-3 pr-2 pl-2 mb-2 pb-1 marco">
          <div class="row campo-altura">
            <div class="col-8">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm">Código:</label>
                <div class="col-sm-2 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_codigo" name="inp_codigo" required="" disabled="">
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label col-form-label-sm text-right">Fecha:</label>
                <div class="col-sm-6 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_fecha" name="inp_fecha" required="" disabled="">
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
                  <input type="text" class="form-control form-control-sm" id="inp_ruc" name="inp_ruc"  maxlength="11" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
                  <input name="id_proveedor" id="id_proveedor" type="hidden">
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
                  <select class="form-control btn-sm" id="id_tipoFactura" name="id_tipoFactura" onchange="seleccionarFactura();">
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
            <div class="col-8">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm pr-0">Razón Social:</label>
                <div class="col-sm-6 pl-0">
                  <input type="text" class="form-control form-control-sm" id="inp_razon_social" name="inp_razon_social" required="" disabled="">
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
                  <input type="text" class="form-control form-control-sm" id="inp_direccion" name="inp_direccion" required="" disabled="">
                </div>
              </div>
            </div>
            <div class="col-4">
            </div>
          </div>
        </div>
        <div class="pt-3 pr-2 pl-2 mb-2 pb-1 marco">
          <div class="row campo-altura">
            <div class="col-12">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label col-form-label-sm te">Requerimiento:</label>
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
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Meta:</label>
              <div class="col-sm-2 pl-0">
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm" id="inp_c1" name="inp_c1" maxlength="4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;">
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
                <input type="double" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_importe" name="inp_importe">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Función:</label>
              <div class="col-sm-2 pl-0">
                <input type="text" class="form-control form-control-sm" maxlength="4" id="inp_c2" name="inp_c2" required="" disabled="">
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Sub Total:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_subTotal" name="inp_subTotal" disabled="">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Programa:</label>
              <div class="col-sm-2 pl-0">
                <input type="text" class="form-control form-control-sm" maxlength="7" id="inp_c3" name="inp_c3" required="" disabled="">
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">I.G.V:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_igv" name="inp_igv" disabled="">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label col-form-label-sm">Descripción:</label>
              <div class="col-sm-10 pl-0">
                <input type="text" class="form-control form-control-sm" id="inp_c10" name="inp_c10" required="" disabled="">
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Importe neto:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_importeNeto01" name="inp_importeNeto01" disabled="">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Retención:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_retencion" name="inp_retencion" disabled="">
              </div>
            </div>
          </div>
        </div>
        <div class="row campo-altura">
          <div class="col-8">
          </div>
          <div class="col-4">
            <div class="form-group row">
              <label class="col-sm-6 col-form-label col-form-label-sm text-right">Importe neto:</label>
              <div class="col-sm-6 pl-0">
                <input type="text" class="form-control form-control-sm" align="right" style="text-align:right;" id="inp_importeNeto02" name="inp_importeNeto02" disabled="">
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