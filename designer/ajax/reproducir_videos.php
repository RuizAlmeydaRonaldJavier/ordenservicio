<?php 

//importando el DBacces
require_once '../../DAL/DBAccess.php';

require_once '../../BOL/video.php';
require_once '../../DAO/videoDAO.php';


if(isset($_POST['videoID'])){
	//acceso a la archivo bd
	$dba = new DBAccess();

	//Resoluciones
	$video = new Video();
	$videoDAO = new VideoDAO();

	$resultado_video = $videoDAO->Listar_videos_habilitados();


	if (count($resultado_video)>0) {
	    	$jsondata["success"] = 1;
	    	$jsondata["data"] = array();
	    foreach ($resultado_video as $video) {

	    	array_push($jsondata["data"], 
	    		array(
			      'nombre'               => $video->nombre,
			      'descripcion'     => $video->descripcion,
			      'fecha'     => $video->fecha,
			      'url'     => $video->url
			    )
	    	);
	    }
	}else{
		$jsondata["success"] = 0;
	    $jsondata["data"] = array(
	      'message' => 'Error'
	    );
	}

  	header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);

}

?> 