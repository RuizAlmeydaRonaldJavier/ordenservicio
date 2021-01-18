<?php 
  session_start();

  require_once '../../DAL/DBAccess.php';
  
  //importando las clases y los dao
  require_once '../../BOL/meta.php';
  require_once '../../DAO/metaDAO.php';

  //importando header
  require '../layout/header.php';

  $metaDAO = new MetaDAO();
  $resultadoMeta = $metaDAO->listarMeta();
?>

<br> 
<div class="container mb-3">
  <div class="row">
    <div class="col-12 border cont-from" style="background: white;">
      <div class="row"></div>
      <div class="titulo-usuario mt-3 mb-3">
        <h5 class="text-center"><i class="fas fa-user-friends"></i> LISTA DE METAS PRESUPUESTALES</h5>
      </div>
      <a href="registrarMeta.php" class="btn btn-info icon-left mb-3 alinear-derecha">Registrar <span class="fas fa-plus-circle"></span></a>
      <div class="table-responsive mb-3">
        <table id="datatable" class="table table-hover table-sm" style="text-align:center; border-collapse: collapse;">
          <thead class="thead-dark" style='font-size: 15px;'>
            <tr>
              <th>C1</th>
              <th>C2</th>
              <th>Descripción</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($resultadoMeta)):
              foreach($resultadoMeta as $resultado): ?>
            <tr>
              <td class="centrar-contenido">
                <?php echo $resultado->__GET('c1'); ?>
              </td>
              <td class="centrar-contenido">
                <?php echo $resultado->__GET('c2'); ?>
              </td>
              <td class="centrar-contenido">
                <?php echo $resultado->__GET('c10'); ?>
              </td>
              <td class="centrar-contenido">
                <a href="editar_persona.php?id=<?php echo $resultado->__GET('id_meta');?>" role="button" style='font-size: 13px; font: sans-serif;'><i class="fa fa-edit text-warning"></i></a>
              </td>
              <td class="centrar-contenido">
                <a href="?action=eliminar&id=<?php echo $resultado->__GET('id_meta');?>" role="button" style='font-size: 13px;'><i class="fa fa-trash text-danger"></i></a>
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