<?php 
session_start();

//importando el DBacces
require_once '../../DAL/DBAccess.php';

//SEGURIDAD DE ACCESO DESDE ACA
//seguridad primer parametro es el tiempo de vida dentro de la web y la segunda que tipo de usuario es

//importando las clases y los dao
require_once '../../BOL/meta.php';
require_once '../../DAO/metaDAO.php';

//importando header
require '../layout/header.php';

$Meta = new Meta();
$MetaDAO = new MetaDAO();

$mensajeFinalS = file_get_contents('../msj/mensaje_general.php');

if(isset($_POST['btnGuardarMeta']))
{

	$Meta->__SET('c1',             $_POST['inp_c1']);
	$Meta->__SET('c2',             $_POST['inp_c2']);
	$Meta->__SET('c3',             $_POST['inp_c3']);
	$Meta->__SET('c4',             $_POST['inp_c4']);
    $Meta->__SET('c5',             $_POST['inp_c5']);
    $Meta->__SET('c6',             $_POST['inp_c6']);
    $Meta->__SET('c7',             $_POST['inp_c7']);
    $Meta->__SET('c8',             $_POST['inp_c8']);
    $Meta->__SET('c9',             $_POST['inp_c9']);
    $Meta->__SET('c10',            $_POST['inp_c10']);
    $Meta->__SET('dpto',           $_POST['inp_dpto']);
    $Meta->__SET('prov',           $_POST['inp_prov']);
    $Meta->__SET('dist',           $_POST['inp_dist']);
    $Meta->__SET('und_medida',     $_POST['inp_und_medida']);


    $MetaDAO->Registrar_meta($Meta);

    echo $mensajeFinalS;
    DBAccess::rederigir("registrarMeta.php");
}
?>
<!-- ************************************************* CONTENIDO ******************************************************* -->
<br> 
<div class="container">
    <div class="row">
        <div class="col-12 border cont-from" style="background: white;">

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" >
             <div class="titulo-usuario mt-3 mb-3">      
                <h5 class="text-center"><i class="fas fa-user-friends"></i> REGISTRAR METAS PRESUPUESTALES</h5>
            </div>
            <div class="row">
                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Sec. Func.:</strong>
                        <input type="text" class="form-control" id="NOMBRE" name="inp_c1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Funcion:</strong>
                        <input type="text" class="form-control" name="inp_c2" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>
                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Program. Funcion:</strong>
                        <input type="text" class="form-control" name="inp_c3" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Sub Progr. Func.:</strong>
                        <input type="text" class="form-control" id="APELLIDOP" name="inp_c4" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

                         
            </div>

            <div class="row">

                <div class="col-2"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Programa:</strong>
                        <input type="text" class="form-control" id="APELLIDOP" name="inp_c5" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Act./Proyecto:</strong>
                        <input type="text" class="form-control" id="APELLIDOP" name="inp_c6" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>
                <div class="col-3">  
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Componente:</strong>
                        <input id="email" type="text" class="form-control" name="inp_c7" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

                <div class="col-2"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Finalidad:</strong>
                        <input type="text" class="form-control" name="inp_c8" maxlength="9" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

                <div class="col-2"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Meta:</strong>
                        <input type="text" class="form-control" name="inp_c9" maxlength="9" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" required>
                    </div>
                </div>

            </div>  

            <div class="row">
              <div class="col-12">
                <div class="form-group">
                    <strong style="color: #17a2b8;">Descripcion de la Meta:</strong>
                    <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" name="inp_c10" rows="5"></textarea>
                </div>
            </div>
        </div>

        <div class="row">

                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Departamem.:</strong>
                        <input type="text" class="form-control" id="APELLIDOP" maxlength="15" name="inp_dpto" onkeyup="mayus(this);" required>
                    </div>
                </div>
                <div class="col-3">  
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Provincia:</strong>
                        <input id="email" type="text" class="form-control" name="inp_prov" maxlength="15" onkeyup="mayus(this);" required>
                    </div>
                </div>

                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Distrito:</strong>
                        <input type="text" class="form-control" name="inp_dist" maxlength="15" onkeyup="mayus(this);" required>
                    </div>
                </div>

                <div class="col-3"> 
                    <div class="form-group">
                        <strong style="color: #17a2b8;">Und Medida:</strong>
                        <input type="text" class="form-control" name="inp_und_medida" maxlength="15" onkeyup="mayus(this);" required>
                    </div>
                </div>

            </div>      

        <button name="btnGuardarMeta" class="btn btn-primary"><i class="fa fa-check"></i> Registrar</button>
        <a href="./listarProveedor.php" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</a>
    </form>
    <br>                    
</div>
</div>
</div>
<br> 

<?php require '../layout/footer.php'; ?>
