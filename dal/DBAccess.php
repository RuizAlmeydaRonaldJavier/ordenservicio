<?php
  class DBAccess
  {
    private $conn;
    
    public function __construct()
    {

      if( defined( 'PDO::MYSQL_ATTR_MAX_BUFFER_SIZE' ))
      {
        $opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::MYSQL_ATTR_MAX_BUFFER_SIZE => 15*1024*1024);
      }
      else
      {
        $opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
      }

      try
      {
        $this->conn = new PDO('mysql:host=localhost;dbname=db_sistemaeor', 'root', '', $opt);
  			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e)
      {
        echo "error:" .$e->getMessage();
      }
   }

    public static function getUrl()
    {
      //$name = "ResolucionesApp";
      $name = "UGEL-ATENCION";
      $url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST']."/".$name;
      return $url;
    }

    public function getConexion()
    {
      return $this->conn;
    }

    public static function rederigir($url)
    {
        //echo '<script language="javascript">window.location.href ="'.$url.'"</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="'.$url.'"} , 1500);</script>';
    }

    public static function rederigirv2($url,$time){
        //echo '<script language="javascript">window.location.href ="'.$url.'"</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="'.$url.'"} , "'.$time.'");</script>';
    }


    public static function seguridadUsuarios($tiempo = "3000", $tipo_usuario){
      if (!isset($_SESSION['usuario'])) {
        header('Location: ../../index.php');
        exit;
      }else{
        if (!isset($_SESSION['tiempo_sess'])) {
          $_SESSION['tiempo_sess'] = time();
        } else if (time() - $_SESSION['tiempo_sess'] > $tiempo) { //segundos 1800 = 30 minutos
          $helper = array_keys($_SESSION);
          foreach ($helper as $key){
            unset($_SESSION[$key]);
          }
        }
        if ($_SESSION['tipo_usuario'] != $tipo_usuario) {
          header('Location: ../../index.php');
          exit;
        }
      }
    }

  }
?>