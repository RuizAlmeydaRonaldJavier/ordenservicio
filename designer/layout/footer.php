<!-- Opcional: enlazando el JavaScript de Bootstrap -->


<script type="text/javascript" src="../asset/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../asset/js/jquery.mask.js" ></script>

<script type="text/javascript" src="../asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://kit.fontawesome.com/0b1730660b.js"></script>
<script type="text/javascript" src="../asset/js/moment.js"></script>
<script type="text/javascript" src="../asset/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="../asset/js/notify.js"></script>

<script type="text/javascript" src="../asset/vendor/datatables/datatables.min.js"></script>

<script type="text/javascript" src="../asset/js/complements.js"></script>



<script type="text/javascript">

  window.onload = function(){
    if(document.getElementById("inp_fecha"))
    {
      var fecha = new Date(); //Fecha actual
      var mes = fecha.getMonth()+1; //obteniendo mes
      var dia = fecha.getDate(); //obteniendo dia
      var ano = fecha.getFullYear(); //obteniendo año
      if(dia<10)
        dia='0'+dia; //agrega cero si el menor de 10
      if(mes<10)
        mes='0'+mes //agrega cero si el menor de 10
      document.getElementById('inp_fecha').value=ano+"-"+mes+"-"+dia;
    }
  }

   //Buscar Ruc
  $('#btnBuscarRuc').click(function(e)
  {
    var value = $("#inp_ruc").val().length;
    if (value > 0)
    {
      buscarRucProveedor();
    }
    else
    {
      alert("Ingrese número de Ruc.");
    }
  });

  function buscarRucProveedor()
  {
    var parametros = {
      "ruc_proveedor": $('#inp_ruc').val()
    };

    $.ajax({
      data: parametros,
      url: '../ajax/buscar_proveedor.php',
      type: 'post',
      beforeSend: function()
      {
        $("#resultado").html("Procesando, espere por favor...");
      },
      success: function(data)
      {
        if (data.success === 1)
        {
          $('#inp_ruc').css({'border':'1px solid green'});

          $('#inp_razon_social').val("" + data.data.razon_social);
          $('#inp_ruc').val(""+data.data.ruc);
          $('#inp_direccion').val("" + data.data.direccion);
          $('#inp_codigo').val("" + data.data.id_proveedor);
          $('#id_proveedor').val("" + data.data.id_proveedor);
        }
        else
        {
          $('#inp_ruc').css({'border':'1px solid red'});

          $('#inp_razon_social').val("");
          $('#inp_ruc').val("");
          $('#inp_direccion').val("");
          $('#inp_codigo').val("");
          $('#id_proveedor').val("");
          alert("Proveedor no encontrado.");
        }
      },
      error: function()
      {
      }
    });
  }

  //Buscar Meta
  $('#btnBuscarMeta').click(function(e)
  {
    var value = $("#inp_c1").val().length;
    if (value > 0)
    {
      buscarMeta();
    }
    else
    {
      alert("Ingrese número de meta.");
    }
  });

  function buscarMeta()
  {
    var parametros = {
      "meta_orden": $('#inp_c1').val()
    };

    $.ajax({
      data: parametros,
      url: '../ajax/buscar_meta.php',
      type: 'post',
      beforeSend: function()
      {
        $("#resultado").html("Procesando, espere por favor...");
      },
      success: function(data)
      {
        if (data.success === 1)
        {
          $('#inp_c1').css({'border':'1px solid green'});

          $('#inp_c1').val("" + data.data.c1);
          $('#inp_c2').val(""+data.data.c2);
          $('#inp_c3').val("" + data.data.c3);
          $('#inp_c10').val("" + data.data.c10);
          $('#id_meta').val("" + data.data.id_meta);
        }
        else
        {
          $('#inp_c1').css({'border':'1px solid red'});

          $('#inp_c1').val("");
          $('#inp_c2').val("");
          $('#inp_c3').val("");
          $('#inp_c10').val("");
          $('#id_meta').val("");
          alert("Meta no encontrada.");
        }
      },
      error: function()
      {
      }
    });
  }

  function seleccionarFactura()
  {
    /* Para obtener el valor */
    var value = $("#inp_importe").val().length;
    if (value > 0)
    {
      calcularImporte();
    }
    /*var tipo_factura = document.getElementById("id_tipoFactura").value.substr(1,2);
    console.log('a', tipo_factura);*/

    /* Para obtener el texto */
    //var combo = document.getElementById("producto");
    //var selected = combo.options[combo.selectedIndex].text;
  }

  $( "#inp_importe" ).blur(function()
  {
    calcularImporte();
    //console.log('a', tipo_factura);
      // tu codigo ajax va dentro de esta function...
  });

  function calcularImporte()
    {
      var tipo_factura = document.getElementById("id_tipoFactura").value.charAt(0);
      var importe = $("#inp_importe").val();
      var porcentaje = document.getElementById("id_tipoFactura").value.substr(1,2);

      $("#inp_importe").val(parseInt(importe).toFixed(2));

      switch (tipo_factura) {
        case '1':
          var div_retencion = document.getElementById("div_retencion");
          var div_importeNeto02 = document.getElementById("div_importeNeto02");
          
          div_retencion.style.display = "";
          div_importeNeto02.style.display = "";

          $("#inp_retencion").val(parseInt(porcentaje).toFixed(2));
          $("#inp_importeNeto02").val(parseInt(importe).toFixed(2));

          $("#inp_subTotal").val("");
          $("#inp_igv").val("");
          $("#inp_importeNeto01").val("");

          var div_subTotal = document.getElementById("div_subTotal");
          var div_igv = document.getElementById("div_igv");
          var div_importeNeto01 = document.getElementById("div_importeNeto01");
          
          div_subTotal.style.display = "none";
          div_igv.style.display = "none";
          div_importeNeto01.style.display = "none";
          break;
        case '2':
          var div_retencion = document.getElementById("div_retencion");
          var div_importeNeto02 = document.getElementById("div_importeNeto02");
          
          div_retencion.style.display = "";
          div_importeNeto02.style.display = "";

          var retencion = importe * (porcentaje / 100);
          var importe_neto02 = importe - retencion;

          $("#inp_retencion").val(retencion.toFixed(2));
          $("#inp_importeNeto02").val(importe_neto02.toFixed(2));

          $("#inp_subTotal").val("");
          $("#inp_igv").val("");
          $("#inp_importeNeto01").val("");

          var div_subTotal = document.getElementById("div_subTotal");
          var div_igv = document.getElementById("div_igv");
          var div_importeNeto01 = document.getElementById("div_importeNeto01");
          
          div_subTotal.style.display = "none";
          div_igv.style.display = "none";
          div_importeNeto01.style.display = "none";
          break;
        case '3':
          var div_subTotal = document.getElementById("div_subTotal");
          var div_igv = document.getElementById("div_igv");
          var div_importeNeto01 = document.getElementById("div_importeNeto01");
          
          div_subTotal.style.display = "";
          div_igv.style.display = "";
          div_importeNeto01.style.display = "";

          var igv = importe * (porcentaje / 100);
          var importe_neto01 = parseInt(importe) + parseInt(igv);
          
          $("#inp_subTotal").val(parseInt(importe).toFixed(2));
          $("#inp_igv").val(igv.toFixed(2));
          $("#inp_importeNeto01").val(importe_neto01.toFixed(2));

          $("#inp_retencion").val("");
          $("#inp_importeNeto02").val("");

          var div_retencion = document.getElementById("div_retencion");
          var div_importeNeto02 = document.getElementById("div_importeNeto02");
          
          div_retencion.style.display = "none";
          div_importeNeto02.style.display = "none";
          break;
        case '4':
          var div_subTotal = document.getElementById("div_subTotal");
          var div_igv = document.getElementById("div_igv");
          var div_importeNeto01 = document.getElementById("div_importeNeto01");
          
          div_subTotal.style.display = "";
          div_igv.style.display = "";
          div_importeNeto01.style.display = "";

          var sub_total = importe / (1 + (porcentaje / 100));
          var igv = importe - sub_total;

          $("#inp_subTotal").val(sub_total.toFixed(2));
          $("#inp_igv").val(igv.toFixed(2));
          $("#inp_importeNeto01").val(parseInt(importe).toFixed(2));

          $("#inp_retencion").val("");
          $("#inp_importeNeto02").val("");

          var div_retencion = document.getElementById("div_retencion");
          var div_importeNeto02 = document.getElementById("div_importeNeto02");
          
          div_retencion.style.display = "none";
          div_importeNeto02.style.display = "none";
          break;
        case '5':
          var div_subTotal = document.getElementById("div_subTotal");
          var div_igv = document.getElementById("div_igv");
          var div_importeNeto01 = document.getElementById("div_importeNeto01");
          
          div_subTotal.style.display = "";
          div_igv.style.display = "";
          div_importeNeto01.style.display = "";

          $("#inp_subTotal").val(parseInt(importe).toFixed(2));
          $("#inp_igv").val(parseInt(porcentaje).toFixed(2));
          $("#inp_importeNeto01").val(parseInt(importe).toFixed(2));

          $("#inp_retencion").val("");
          $("#inp_importeNeto02").val("");

          var div_retencion = document.getElementById("div_retencion");
          var div_importeNeto02 = document.getElementById("div_importeNeto02");
          
          div_retencion.style.display = "none";
          div_importeNeto02.style.display = "none";
          break;
        default:
          break;
      }
    }
</script>

<!--<script type="text/javascript">

    var time = 2000;

    /*setInterval(function() { 
        var parametros = {
            "time_user": time
        };

        $.ajax({
            url : "../ajax/tiempo_vida.php",
            type: "POST",
            data : parametros,
            success: function(data){
               if (data.data.tiempo_restante > 234 && time == 2000) {
                mostrarAlerta();
                time = 1000000;
            }
        }
    });
    }, time);*/


    $('#datetimepicker2').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY' 
    });

    $(document).ready(function() {

      $('[data-toggle=offcanvas]').click(function() {
        $('.row-offcanvas').toggleClass('active');
    });
  });


    function jqUpdateSize(){
        // Get the dimensions of the viewport
        var width = $(window).width();
        var heightW = $(window).height();
        var heightD = $(document).height();
        var height = 0;

        if (heightW>heightD) {
            height += heightW;
        }else{
            height += heightD;
        }

        console.log(heightW+"w - d"+heightD+" - h"+height);
        $('#jqWidth').html(width);
        $('#jqHeight').html(height);
        $('.menu-adm').css(
        {
            height:  height,
            overflow:" hidden"
        }
        );
    }
        $(document).ready(jqUpdateSize);    // When the page first loads
        $(window).resize(jqUpdateSize);     // When the browser changes size



    // $('#btnBuscarPersonaAgrUsu').click(function(e){
    //         var value = $("#inpDocumentoAgrUsu").val().length;
    //         if (value>0) {
    //             buscarPersonaDocumento();
    //         }else{
    //             alert("Ingrese un numero");
    //         }
    //     });

    function FX_passGenerator(form,element) {
          var thePass = "";
          var randomchar = "";
          var numberofdigits = Math.floor((Math.random() * 7) + 6);
          for (var count=1; count<=numberofdigits; count++) {
            var chargroup = Math.floor((Math.random() * 3) + 1);
            if (chargroup==1) {
              randomchar = Math.floor((Math.random() * 26) + 65);
          }
          if (chargroup==2) {
              randomchar = Math.floor((Math.random() * 10) + 48);
          }
          if (chargroup==3) {
              randomchar = Math.floor((Math.random() * 26) + 97);
          }
          thePass+=String.fromCharCode(randomchar);
      }
      eval('document.'+form+'.'+element+'.value = thePass');
  }

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }

function validar_campo(evento){
 evento.value = evento.value.replace(/[^0-9]/g,"");
}


function caracteresCorreoValido(email, div){
    console.log(email);
    //var email = $(email).val();
    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);

    if (caract.test(email) == false){
        $(div).hide().removeClass('hide').slideDown('fast');

        return false;
    }else{
        $(div).hide().addClass('hide').slideDown('slow');
//        $(div).html('');
        return true;
    }
}

$('#NOMBRE').bind('keypress', function(event) {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
$('#APELLIDOP').bind('keypress', function(event) {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
$('#APELLIDOM').bind('keypress', function(event) {
                var regex = new RegExp("^[a-zA-Z ]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });

function buscarPersonaDocumento() {

            var parametros = {
                "documentoPersona": $('#inpDocumentoAgrUsu').val()
            };

            $.ajax({
                data: parametros,
                url: '../ajax/buscar_persona.php',
                type: 'post',
                beforeSend: function() {
                    $("#resultado").html("Procesando, espere por favor...");
                },
                success: function(data) {

                    if (data.success === 1) {
                        $('#inpDocumentoAgrUsu').css({'border':'1px solid green'});

                        $('#inpNombre').val("" + data.data.nombre);
                        $('#inpApellido_paterno').val(""+data.data.apellido_paterno);
                        $('#inpApellido_materno').val("" + data.data.apellido_materno);
                        $('#inpSexo').val("" + data.data.sexo);                        
                        $('#inpFecha_nacimiento').val("" + data.data.fecha_nacimiento);
                        $('#inpCorreo').val("" + data.data.correo);
                        $('#inpIdPersonaAgrUsu').val("" + data.data.id_persona); 

                    } else {
                        $('#inpDocumentoAgrUsu').css({'border':'1px solid red'});
                        alert("Persona no encontrado");
                        $('#pr_nombre').val("");
                        $('#pr_apellidoP').val("");
                        $('#pr_apellidoM').val("");
                        $('#pr_FechaNacimiento').val("");
                        $('#inpCorreoElectronico').val("");
                    }

                },
                error: function() {

                }
            });
        }

        $('#btnBuscarPersonaAgrUsu').click(function(e){
            var value = $("#inpDocumentoAgrUsu").val().length;
            if (value>0) {
                buscarPersonaDocumento();
            }else{
                alert("Ingrese un numero");
            }
        });

$('#btnBuscar_usu_amb').click(function(e){
            var value = $("#inpNombreUsuario").val().length;
            if (value>0) {
                buscar_Nombre_usuario();
            }else{
                alert("Ingrese nombre de usuario");
            }
        });


    function buscar_Nombre_usuario() {

            var parametros = {
                "NombreUsuario": $('#inpNombreUsuario').val()
            };

            $.ajax({
                data: parametros,
                url: '../ajax/buscar_persona.php',
                type: 'post',
                beforeSend: function() {
                    $("#resultado").html("Procesando, espere por favor...");
                },
                success: function(data) {

                    if (data.success === 1) {
                     $('#inpNombreUsuario').css({'border':'1px solid green'});

                     $('#inpestado').val("" + data.data.estado);                      
                     $('#inpNomusuario').val("" + data.data.nom_usuario); 
                     $('#inpTipoUsuario').val("" + data.data.tipo_usuario);
                     $('#inpId_usuario').val("" + data.data.id_usuario); 
                    } else {
                        $('#inpNombreUsuario').css({'border':'1px solid red'});
                        alert("usuario no encontrado PTMR");
                        $('#pr_tipo_usuario').val("");
                        $('#pr_estado').val("");
                        
                    }

                },
                error: function() {

                }
            });
        }


            
    </script>-->

</div>
<!--/col-->
</div>
<!--/row-->

</div>
<!--/main col-->
<!--/.container-->
</body>

</html>