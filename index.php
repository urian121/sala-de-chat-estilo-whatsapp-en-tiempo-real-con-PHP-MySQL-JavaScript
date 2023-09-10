<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (isset($_SESSION['email_user']) != "") {
  header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Chat - WhatApp,una sala para compartir mensajes, audios, imagenes, videos entre muchascosas mas.">
  <meta name="author" content="URIAN VIERA">
  <meta name="keyword" content="Web Developer Urian Viera">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png" />
  <title>Chat - WhatApp - Login</title>
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/loader.css">
  <link rel="stylesheet" href="assets/css/picnic.min.css">
  <style type="text/css" media="screen">
    .miniprofile {
      border-radius: 50%;
      /* Make it a circle */
      margin: 0 auto;
      /* Center horizontally */
      width: 60%;
      /* 60% width */
      padding-bottom: 60%;
      /* 60% height */
    }

    .group label {
      color: #cecece;
      font-size: 13px;
    }
  </style>
</head>

<body>
  <section class="mi_wallper">
    <img src="assets/img/fondo.jpg" alt="Imagen 100x100">
    <div id="demo-content">
      <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
      </div>
      <div id="content"> </div>
    </div>


    <div class="login-box" id="login">
      <img src="assets/img/favicon.png" class="avatar mb-4" alt="Avatar Image">
      <p style="text-align: center; font-weight:600">INICIAR SESIÓN AHORA!
        <hr>
      </p>
      <div id="espacio"></div>
      <form class="form-login" action="acciones/process_login.php" method="POST" autocomplete="off">
        <div class="group">
          <input type="text" name="email_user" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Email</label>
        </div>
        <div class="group">
          <input type="password" name="password" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Clave</label>
        </div>
        <div class="group" style="display:flex;">
          <button id="enviar" type="submit">Ingresar</button>
        </div>
      </form>

      <div class="group">
        <a style="float: right;" id="mostrar">Crear Cuenta. .!</a>
      </div>
    </div>


    <!---Crear cuenta de Usuario ---->
    <div class="login-box" id="registrar">
      <p style="text-align: center; font-weight:600">CREA TU CUENTA AHORA!</p>
      <img src="assets/img/favicon.png" class="avatar" alt="Avatar Image">
      <div id="espacio"></div>

      <form class="form-login" action="acciones/RegistarUser.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="group">
          <input type="text" name="nombre_apellido" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Nombre y Apellido</label>
        </div>
        <div class="group">
          <input type="text" name="email_user" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Email</label>
        </div>
        <div class="group">
          <input type="password" name="password" required>
          <span class="highlight"></span>
          <span class="bar"></span>
          <label>Clave</label>
        </div>
        <div style="width: 150px; margin: 0 auto;"> <!-- this div just for demo display -->
          <label class="dropimage miniprofile">
            <input type="file" name="imagenPerfil" title="Elegir imagen" required="required" accept="image/*">
          </label>
        </div>
        <div class="group" style="display: flex; margin-top:30px;">
          <button type="submit">Crear Cuenta</button>
        </div>
        <a style="float: right;" id="formlogin">Volver</a>

      </form>
    </div>
  </section>

  <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript" charset="utf-8"></script>
  <script src="assets/js/login.js"></script>


</body>

</html>