<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include('config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $email_user    = $_SESSION['email_user'];
  $imgPerfil    = $_SESSION['imagen'];
  $idConectado  = $_SESSION['id'];
?>

  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Chat - WhatApp,una sala para compartir mensajes, audios, imagenes, videos entre muchascosas mas.">
    <meta name="author" content="URIAN VIERA">
    <meta name="keyword" content="Web Developer Urian Viera">
    <title>Chat - WhatApp!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png" />
    <link rel="stylesheet" src="https://fonts.googleapis.com/css?family=Roboto:400,700,300" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/inputEnviar.css">
    <style type="text/css" media="screen">
      .seleccionado {
        background-color: hsl(0, 0%, 90%);
      }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.1.2/css/material-design-iconic-font.min.css">
  </head>

  <body>


    <div class="container app">
      <div class="row app-one">

        <!----Lista de usuarios------------>
        <div class="col-sm-4 side" id="myusers">
          <div class="side-one">

          </div>
        </div>
        <!-------->

        <!----contenedor del chat--->
        <div class="col-sm-8 conversation">
          <div id="capausermsj">

            <img src="assets/img/capa.png" id="capawelcome" />
          </div>
        </div>
        <!---fin--->

      </div>
    </div>


    <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(function() {
        load2();

        function load2() {
          window.setTimeout(function() {
            $.post('users.php', function(data) {
              $('#myusers').html(data);
            });
          }, 1000);
        }


        $(function() {
          if ($(".side-one")[0]) {
            users();
          }
          users();

          setInterval(function() {
            if ($(".side-one")[0]) {
              users();
            }
            users();
          }, 10000);

        });

        function users() {
          load_data = {
            'fetch': 1
          };
          window.setTimeout(function() {
            $.post('users.php', load_data, function(data) {
              $('#myusers').html(data);
            });
          }, 10000);
        }
      });
    </script>


  </body>

  </html>
<?php } else {
  echo '<script type="text/javascript">
    alert("Debe Iniciar Sesion");
    window.location.assign("index.php");
    </script>';
}
?>