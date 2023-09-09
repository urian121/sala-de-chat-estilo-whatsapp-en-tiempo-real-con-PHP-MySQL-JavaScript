<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chat - WhatApp!</title>
  <style type="text/css" media="screen">
    .zmdi-mail-reply:hover {
      color: #00796B !important;
      cursor: pointer;
    }

    .zmdi-comment-image:hover {
      color: #00796B !important;
      cursor: pointer;
    }

    /**style para el boton examinar***/
    .uploadFile {
      visibility: hidden;
    }

    #uploadIcon {
      cursor: pointer;
    }

    .camara {
      font-size: 45px;
      float: right !important;
      margin-left: 1000px;
      margin-top: -5px;
    }

    .camara:hover {
      color: #333;
    }

    .fa-microphone:hover {
      cursor: pointer;
      color: #333;
    }
  </style>
</head>

<body>

  <?php
  sleep(1);
  header("Content-Type: text/html;charset=utf-8");

  include('config/config.php');
  $IdUser                 = $_REQUEST['id'];
  $idConectado            = $_REQUEST['idConectado'];
  $email_user             = $_REQUEST['email_user'];

  //Actualizando los mensajes no leidos ya que estoy entrando en mis mensajes
  if (!empty($IdUser)) {
    $leyendoMsj = ("UPDATE msjs SET leido = 'SI' WHERE  user_id='$IdUser' AND to_id='$idConectado' ");
    $queryLeerMsjs = mysqli_query($con, $leyendoMsj);
  }

  $QueryUserSeleccionado = ("SELECT * FROM users WHERE id='$IdUser' LIMIT 1 ");
  $QuerySeleccionado     = mysqli_query($con, $QueryUserSeleccionado);

  while ($rowUser = mysqli_fetch_array($QuerySeleccionado)) {
  ?>
    <div class="status-bar"> </div>
    <div class="row heading">
      <div class="col-sm-2 heading-avatar">
        <a href="./" style="color: #fff;">
          <div class="heading-avatar-icon">
            <i class="zmdi zmdi-arrow-left" style="font-size:20px"></i>
            <img src="<?php echo 'imagenesperfil/' . $rowUser['imagen']; ?>">
          </div>
        </a>
      </div>
      <div class="col-sm-3 heading-name">
        <a class="heading-name-meta">
          <?php echo $rowUser['nombre_apellido']; ?>
        </a>
      </div>

    </div>

    <div class="row message" id="conversation">
      <?php
      $QueryUserClick = ("SELECT UserIdSession FROM clickuser WHERE UserIdSession='$idConectado' LIMIT 1");
      $QueryClick     = mysqli_query($con, $QueryUserClick);
      $veririficaClick = mysqli_num_rows($QueryClick);
      if ($veririficaClick == 0) {
        $InserClick = ("INSERT INTO clickuser (UserIdSession,clickUser) VALUES ('$idConectado','$IdUser')");
        $ResulInsertClick = mysqli_query($con, $InserClick);
      } else {
        $UpdateClick = ("UPDATE clickuser SET clickUser='$IdUser' WHERE UserIdSession='$idConectado'");
        $ResultUpdateClick = mysqli_query($con, $UpdateClick);
      }


      //Mostrando msjs deacuerdo al Usuario seleccionado
      $Msjs = ("SELECT * FROM msjs WHERE (user_id ='" . $idConectado . "' AND to_id='" . $IdUser . "') OR (user_id='" . $IdUser . "' AND to_id='" . $idConectado . "') ORDER BY id ASC");
      $QueryMsjs = mysqli_query($con, $Msjs);

      while ($UserMsjs = mysqli_fetch_array($QueryMsjs)) {
        $archivo = $UserMsjs['archivos'];
        $explode = explode('.', $archivo);
        $extension_arch = array_pop($explode);

        if ($idConectado == $UserMsjs['user_id']) { ?>
          <div class="row message-body">
            <div class="col-sm-12 message-main-sender">
              <div class="sender">
                <div class="message-text">
                  <?php
                  if (!empty($UserMsjs['message'])) {
                    echo $UserMsjs['message'];
                  } else { ?>
                    <img src="<?php echo 'archivos/' . $archivo; ?>" style="width: 100%; max-width: 250px;">
                    <div class="row">
                      <div class="col-md-12">
                        <a class="boton_desc" download="" href="archivos/<?php echo $archivo; ?>" title="Descargar Imagen">Descargar
                        </a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <span class="message-time pull-right">
                  <?php echo $UserMsjs['fecha'];  ?>
                </span>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="row message-body">
            <div class="col-sm-12 message-main-receiver">
              <div class="receiver">
                <div class="message-text">
                  <?php
                  if ($UserMsjs['message'] != "") {
                    echo $UserMsjs['message'];
                  } else { ?>
                    <img src="<?php echo './archivos/' . $UserMsjs['archivos']; ?>" style="width: 100%; max-width: 250px;">
                    <div class="row">
                      <div class="col-md-12">
                        <a class="boton_desc" download="" href="archivos/<?php echo $archivo; ?>" title="Descargar Imagen">Descargar
                        </a>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <span class="message-time pull-right">
                  <?php echo $UserMsjs['fecha'];  ?>
                </span>
              </div>
            </div>
          </div>

      <?php  }
      }
      ?>

    </div>



    <div class="row reply" id="formnormal">
      <form class="conversation-compose" id="formenviarmsj" name="formEnviaMsj">
        <input type="hidden" name="user_id" value="<?php echo $idConectado; ?>">
        <input type="hidden" name="to_id" value="<?php echo $rowUser['id']; ?>">
        <input type="hidden" name="user" value="<?php echo $email_user; ?>">
        <input type="hidden" name="to_user" value="<?php echo $rowUser['nombre_apellido']; ?> ">

        <div class="emoji">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" id="smiley" x="3147" y="3209">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.153 11.603c.795 0 1.44-.88 1.44-1.962s-.645-1.96-1.44-1.96c-.795 0-1.44.88-1.44 1.96s.645 1.965 1.44 1.965zM5.95 12.965c-.027-.307-.132 5.218 6.062 5.55 6.066-.25 6.066-5.55 6.066-5.55-6.078 1.416-12.13 0-12.13 0zm11.362 1.108s-.67 1.96-5.05 1.96c-3.506 0-5.39-1.165-5.608-1.96 0 0 5.912 1.055 10.658 0zM11.804 1.01C5.61 1.01.978 6.034.978 12.23s4.826 10.76 11.02 10.76S23.02 18.424 23.02 12.23c0-6.197-5.02-11.22-11.216-11.22zM12 21.355c-5.273 0-9.38-3.886-9.38-9.16 0-5.272 3.94-9.547 9.214-9.547a9.548 9.548 0 0 1 9.548 9.548c0 5.272-4.11 9.16-9.382 9.16zm3.108-9.75c.795 0 1.44-.88 1.44-1.963s-.645-1.96-1.44-1.96c-.795 0-1.44.878-1.44 1.96s.645 1.963 1.44 1.963z" fill="#7d8489" />
          </svg>
        </div>
        <input class="input-msg" name="message" id="message" placeholder="Escribir tu Mensaje y presiona Enter..." autocomplete="off" autofocus="autofocus" required="true">
        <i class="zmdi zmdi-comment-image" style="font-size: 45px; color: grey;" title="Enviar Imagen." id="mostrarformenviarimg"></i>
      </form>
    </div>


    <!---audio para cuando se envia un msj-->
    <audio class="audio" style="display:none;">
      <source src="effect.mp3" type="audio/mp3">
    </audio>
    <!---fin del audio--->


    <!---- form enviar img--->
    <div class="row reply" id="formenviaimg">
      <form class="conversation-compose" id="formenviarmsj" name="formEnviaMsj" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo $idConectado; ?>">
        <input type="hidden" name="to_id" value="<?php echo $rowUser['id']; ?>">
        <input type="hidden" name="to_user" value="<?php echo $rowUser['nombre_apellido']; ?> ">
        <input type="hidden" name="user" value="<?php echo $email_user; ?>">


        <div class="col-sm-12 col-xs-12 reply-recording">
          <label for="uploadFile" id="uploadIcon">
            <i class="zmdi zmdi-camera camara"></i>
          </label>
          <input type="file" name="namearchivo" value="upload" id="uploadFile" class="uploadFile" required />
        </div>
        <button class="send" name="enviar" id="botonenviarimg" name="botonenviarimg">
          <div class="circle">
            <i class="zmdi zmdi-mail-send" title="Enviar Imagen..."></i>
          </div>
        </button>
        <i class="zmdi zmdi-mail-reply" style="font-size: 50px;color: grey;" id="volverformnormal" title="Volver . ."></i>
      </form>
    </div>
  <?php } ?>


  <script type="text/javascript">
    $(function() {
      scroll();

      var idConectado = "<?php echo $idConectado; ?>";

      //console.log('Id User: ' + idConectado);

      //Buscando mensajes nuevos cada 4 segundos
      function actualizar() {
        var valor = 0;
        var bucle = setInterval(function() {
          valor++;
          //console.log('Buscando mensajes sin leer ' + valor);
          if (valor == 8) {
            $.ajax({
              type: "POST",
              url: "buscarMensajesNuevos.php",
              dataType: "json",
              data: {
                idConectado: idConectado
              },
              success: function(data) {
                //console.log(data);
                if (data.msj == true) {
                  $.post('MsjsUsers.php', {
                    id: idConectado
                  }, function(data) {
                    $('#conversation').html(data);
                    var scrolltoh = $('#conversation')[0].scrollHeight;
                    $('#conversation').scrollTop(scrolltoh);
                  })
                  //console.log('si hay msjs');
                } else {
                  //console.log('no hay msjs');
                }
              }
            })
            valor = 0;
          }
        }, 2000);
      }

      actualizar(); //Llamado a la funcion.


      $(".conversation-compose").keypress(function(e) {
        if (e.which == 13) {

          var url = "acciones/RegistMsj.php";
          $.ajax({
            type: "POST",
            url: url,
            data: $("#formenviarmsj").serialize(),
            complete: function(data) {
              scroll(); //llamando la funcion
            },
            success: function(data) {
              $("#conversation").load('MsjsUsers.php?id=' + idConectado);
              //$('#conversation').html(data);
              $("#message").val(""); //limpiar el input del msg
              $(".audio")[0].play(); //reproducir audio de envio
            }
          });
          return false;
        }
      });


      $("#formenviaimg").hide();

      $("#mostrarformenviarimg").click(function() {
        $("#formnormal").hide();
        $("#formenviaimg").show(200);
      });

      $("#volverformnormal").click(function() {
        $("#formenviaimg").hide();
        $("#formnormal").show(200);
      });

    });


    /******ENVIANDO FOR DE IMAGEN*****/
    var enviandoImagen = false; // Variable para rastrear si se está enviando una imagen
    // Unir el evento clic al botón solo una vez en el documento cargado
    $('body').off('click', '#botonenviarimg').on('click', '#botonenviarimg', async function(e) {
      e.preventDefault();

      if (enviandoImagen) {
        return; // Si ya se está enviando una imagen, no hacer nada
      }

      enviandoImagen = true; // Establecer la bandera de envío de imagen

      const form = $(this).closest('form')[0];
      const formData = new FormData(form);
      const idConectado = "<?php echo $idConectado; ?>";

      // Validando que no envíen el formulario sin imagen
      const namearchivo = $("#uploadFile").val();
      if (!namearchivo) {
        alert("Debes seleccionar una imagen");
        return;
      }

      try {
        const response = await fetch('acciones/archivo.php', {
          method: 'POST',
          body: formData,
        });

        if (!response.ok) {
          throw new Error('Error en la solicitud');
        }

        const data = await response.text();
        $("#conversation").html(data);
        $(".audio")[0].play(); // Reproducir audio de envío

        // Volver al formulario de mensaje
        $("#formenviaimg").hide();
        $("#formnormal").show(200);

        // Actualizar conversación
        const updatedData = await $.post('MsjsUsers.php', {
          id: idConectado
        });
        $('#conversation').html(updatedData);

        const scrolltoh = $('#conversation')[0].scrollHeight;
        $('#conversation').scrollTop(scrolltoh);

        // Restablecer la variable
        enviandoImagen = false;

        // Restablecer el formulario
        form.reset();
      } catch (error) {
        console.error('Error:', error);
      }
    });
  </script>

</body>

</html>