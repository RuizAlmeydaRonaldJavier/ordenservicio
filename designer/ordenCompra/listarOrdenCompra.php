<?php 
  session_start();

  require_once '../../DAL/DBAccess.php';
  
  //importando las clases y los dao
  require_once '../../BOL/ordenCompra.php';
  require_once '../../DAO/ordenCompraDAO.php';

  //importando header
  require '../layout/header.php';

  $ordenCompraDAO = new OrdenCompraDAO();
  $resultadoOrdenCompra = $ordenCompraDAO->listarOrdenCompra();
?>

<br> 
<div class="container mb-3">
  <div class="row">
    <div class="col-12 border cont-from" style="background: white;">
      <div class="row"></div>
      <div class="titulo-usuario mt-3 mb-3">
        <h5 class="text-center"><i class="fas fa-user-friends"></i> LISTA DE ORDENES DE COMPRAS</h5>
      </div>
      <a href="registrarProveedor.php" class="btn btn-info icon-left mb-3 alinear-derecha">Registar <span class="fas fa-plus-circle"></span></a>
      <div class="table-responsive mb-3">
        <table id="datatable" class="table table-hover table-sm" style="text-align:center; border-collapse: collapse;">
          <thead class="thead-dark" style='font-size: 15px;'>
            <tr>
              <th>Código</th>
              <th>Fecha</th>
              <th>Proveedor</th>
              <th>Total</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($resultadoOrdenCompra)):
              foreach($resultadoOrdenCompra as $resultado): ?>
            <tr>
              <td class="centrar-contenido">
                <?php echo $resultado->__GET('numero_ordenCompra'); ?>
              </td>
              <td class="centrar-contenido">
                <?php echo $resultado->__GET('fecha'); ?>
              </td>
              <td class="centrar-contenido">
                <?php echo $resultado->__GET('id_proveedor'); ?>
              </td>
              <td class="centrar-contenido">
                <?php echo $resultado->__GET('total'); ?>
              </td>
              <td class="centrar-contenido">
                <a href="editar_persona.php?id=<?php echo $resultado->__GET('id_ordenCompra');?>" role="button" style='font-size: 13px; font: sans-serif;'><i class="fa fa-edit text-warning"></i></a>
              </td>
              <td class="centrar-contenido">
                <a href="?action=eliminar&id=<?php echo $resultado->__GET('id_ordenCompra');?>" role="button" style='font-size: 13px;'><i class="fa fa-trash text-danger"></i></a>
              </td>
            </tr>
            <?php endforeach;
              else:?>
                <tr><td colspan="3" style="text-align: left;">No se encontraron registros en la base de datos.</td></tr>
              <?php endif;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require '../layout/footer.php'; ?>