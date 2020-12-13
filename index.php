<?php
  session_start();

  require_once 'DAL/DBAccess.php';

  require_once 'BOL/perfil.php';
  require_once 'DAO/perfilDAO.php';

  $perfilDAO = new PerfilDAO();
  $resultadoPerfil = $perfilDAO->listarPerfil();

  /*if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['tipo_usuario'])) {
      if ($_SESSION['tipo_usuario'] == "ADMINISTRADOR") {
        header('Location: DESIGNER/perfiles/administrador.php');
        exit;
      }else if ($_SESSION['tipo_usuario'] == "LOGISTICA") {
        header('Location: DESIGNER/perfiles/logistica.php');
        exit;
      }else if ($_SESSION['tipo_usuario'] == "ALMACEN") {
        header('Location: DESIGNER/perfiles/almacen.php');
        exit;
      }
    }
  }*/
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Css -->
    <link rel="stylesheet" href="DESIGNER/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="DESIGNER/asset/css/tema.css">
    <link rel="stylesheet" href="DESIGNER/asset/css/login.css">
    <link rel="stylesheet" href="DESIGNER/asset/css/my_css1.css">
    <link rel="stylesheet" href="DESIGNER/asset/css/login1.css">
    <!-- Css -->

    <style type="text/css">
      .centrar-text
      {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
      }

      .bold
      {
        color: #666666;
        font-weight: bold;
      }
    </style>

    <title>Sisasset EOR</title>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <!--<div class="col-md-4 col-sm-4 col-xs-2"></div>-->
        <div class="col-md-4 col-sm-8 col-10 pt-5">
          <div class="ajax-load">
           <div class="container-app-login">
              <img class="img-fluid" src="DESIGNER/asset/img/logo-mpch.png"/>
              <br>
              <div class="login-contenido">
                <h3 class="text-center login-text bold">Acceder</h3>
                <label class="bold">Usuario:</label>
                <div class="input-group input-focus pb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-white"><i class="fas fa-user-tie"></i></span>
                  </div>
                  <input type="text" class="form-control" id="usuario" name="usuario" onkeyup="mayus(this);" autocomplete="off">
                </div>

                <label class="bold">Contraseña:</label>    
                <div class="input-group input-focus  pb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-white"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" id="contrasenia" name="contrasenia" autocomplete="off">
                </div>

                <label class="bold">Perfil:</label>
                <div class="input-group input-focus  pb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-white">
                      <i class="fas fa-address-card"></i>
                    </span>
                  </div>
                  <select class="form-control" id="id_perfil" name="id_perfil">
                    <option>SELECCIONE SU PERFIL</option>
                    <?php foreach($resultadoPerfil as $resultado): ?>
                      <option value="<?php echo $resultado->__GET('id_perfil');?>">
                      <?php echo $resultado->__GET('descripcion');?>
                      </option>
                    <?php endforeach;?>                  
                  </select>
                </div>
                <div class="response-login">
                </div>
                <button type="submit" class="btn btn-info pt-4 pb-4 centrar-text" id="btnIniciarSession">
                Iniciar sessión
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="DESIGNER/asset/js/jquery-3.4.1.min.js"></script>
    <script src="DESIGNER/asset/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
      
      /*var dioClick = false;
   
      // Click en iniciar sesión
      $("#btnIniciarSession").click(function()
      {
          dioClick = true;
      });*/

      // Efecto de carga
      function togglemask(show)
      {
        if(show)
          $('.container-app-login').css(
          { 
            'background': 'url(http://upload.wikimedia.org/wikipedia/commons/d/de/Ajax-loader.gif) center no-repeat',
            'opacity': '.5',
            'background-color': 'white'
          });
        else
          $('.container-app-login').css(
          { 
            'background': '',
            'opacity': '',
            'background-color': ''
          });
      }

      // Empleo de mayúscula
      function mayus(e)
      {
        e.value = e.value.toUpperCase();
      }

      // Click en inciar session
      $("#btnIniciarSession").click(function(){
        iniciarSession();
      });

      // Iniciar sessión
      function iniciarSession()
      {
        var parametros = 
        {
          "usuario": $('#usuario').val(),
          "contrasenia": $('#contrasenia').val(),
          "id_perfil": $('#id_perfil option:selected').val()
        };
          
        console.log("usuario: " + parametros.usuario);
        console.log("contrasenia: " + parametros.contrasenia);
        console.log("id_perfil: " + parametros.id_perfil);

        $.ajax(
        {
          data: parametros,
          url: './DESIGNER/ajax/validarUsuario.php',
          type: 'post',
          beforeSend: function()
          {
            togglemask(true);
          },
          success: function(data)
          {
            if (data.success === 1)
            {
              togglemask(false);
              $('.response-login').show();
              var text = "¡Bienvenido " + data.data.usuario + "! En 3 segundos sera rederigido.";
              $('.response-login').text(text).css(
              {
                'color': 'green',
                'font-size': '15px',
                'margin-bottom': '13px'
              });

              /*console.log(data.data.urlPanel);
              console.log(data.data.tipo);*/

              window.setTimeout(function() {
                location.href = data.data.urlPanel;
              }, 3000);
            }
            else
            {
              togglemask(false);
              $('.response-login').show();
              var text = "Error al validar usuaio.";
              $('.response-login').text(text).css(
              {
                'color': 'red',
                'font-size': '15px',
                'margin-bottom': '13px'
              });
            }
          },
          error: function(){}
        });
      }
    </script> 
  </body>
</html>