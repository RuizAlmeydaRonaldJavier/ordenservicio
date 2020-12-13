<?php
session_start();
//importando el DBacces
require_once '../../DAL/DBAccess.php';
//seguridad primer parametro es el tiempo de vida dentro de la web y la segunda que tipo de usuario es
DBAccess::seguridadUsuarios(9999,"ADMINISTRADOR");

//importando las clases y los dao
require_once '../../BOL/video.php';
require_once '../../DAO/videoDAO.php';

//importando header
require '../secciones/admin/header.php';

$Video = new Video();
$VideoDAO = new VideoDAO();

if(isset($_POST['btnEliminarVideo']))
{
    $id = $_POST['id']; 

    include('DBAccess.php');   

    $query = "delete from $videos where id = '$id'";  
    $result = mysql_query($query);  

  echo " 
<p>El registro ha sido eliminado con exito.</p>"}
    /*$idVideo = $_POST['id_video']; 

include('abre_conexion.php');   

$query = "delete from $tabla_db1 where id = '$id'";  
$result = mysql_query($query);  

include('cierra_conexion.php');   

echo " 
<p>El registro ha sido eliminado con exito.</p> "*/

?>
<br>
<div class="row">
  <?php if(isset($resultado_video)):?>
    <?php foreach($resultado_video as $r_g): ?>

   <div class="col-sm-4 col-lg-4 col-md-4">
    <div class="card" style="width:280px">
      <div class="card-body" >
        <div id="imgv-<?php echo $imgv1;?>" class="card-header">
        
        </div>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>NOMBRE: </strong><?php echo $r_g->__GET('nombre');?></li>
        <li class="list-group-item"><strong>DESCRIPCIÓN: </strong><?php echo $r_g->__GET('descripcion');?></li>
        <li class="list-group-item"><strong>FECHA: </strong><?php echo $r_g->__GET('fecha');?></li>
        <li class="list-group-item"><strong>URL: </strong><?php echo $r_g->__GET('url');?></li>
        <!-- <li class="list-group-item"><strong>URL: </strong><?php echo $r_g->__GET('id_video');?></li> -->
        <li class="list-group-item"><a href="" name ="btnEliminarV" class="btn btn-danger" role="button" style='font-size: 13px;'><i class="fa fa-trash"></i> Eliminar</a>

          <a href="editar_video.php?id=<?php echo $r_g->__GET('id_video');?>" class="btn btn-primary" role="button" style='font-size: 13px; font: sans-serif;'><i class="fa fa-edit"></i> Editar</a>
          </li>

        </ul>
      </div>
      </div>
       <script type="text/javascript">
         showImageAt('http://localhost:81/UGEL-ATENCION/deSIGNER/utilidades/video/<?php echo $r_g->__GET('url');?>','imgv-<?php echo $imgv1;?>',4);
       </script>
       <?php $imgv1++; ?>
    <?php endforeach;?>
  <?php endif;?>
  <ol id="olFrames"></ol>
</div>

<?php endforeach;?>
<?php require '../secciones/admin/footer.php'; ?>