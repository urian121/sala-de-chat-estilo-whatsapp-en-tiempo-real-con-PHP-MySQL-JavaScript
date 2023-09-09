<?php
session_start();
include('config/config.php');
if (isset($_SESSION['email_user']) != "") {
  $idConectado        = $_SESSION['id'];
  $email_user         = $_SESSION['email_user'];
  $NombreUsarioSesion = $_SESSION['nombre_apellido'];
  $imgPerfil          = $_SESSION['imagen'];



  $QueryUsers = ("SELECT 
    id,imagen,
    email_user,
    nombre_apellido,
    fecha_session,
    estatus 
  FROM users WHERE id !='$idConectado' ORDER BY email_user ASC ");
  $resultadoQuery = mysqli_query($con, $QueryUsers);
?>

  <div class="status-bar"></div>
  <div class="row heading">
    <div class="col-sm-8 col-xs-8 heading-avatar">
      <div class="heading-avatar-icon">
        <img src="<?php echo 'imagenesperfil/' . $imgPerfil; ?>">
        <strong style="padding: 0px 0px 0px 20px;">
          <?php echo $NombreUsarioSesion; ?>
        </strong>
      </div>
    </div>

    <div class="col-sm-1 col-xs-1 heading-compose  pull-right">
      <a href="acciones/salir.php?id=<?php echo $idConectado; ?>">
        <i class="zmdi zmdi-power" style="font-size: 25px;"></i>
      </a>
    </div>
    <div class="col-sm-1 col-xs-1  pull-right icohome">
      <a href="home.php">
        <i class="zmdi zmdi-refresh zmdi-hc-2x"></i>
      </a>
    </div>
  </div>

  <div class="row searchBox">
    <div class="col-sm-12 searchBox-inner">
      <div class="form-group has-feedback">
        <input id="searchText" type="search" class="form-control" name="searchText" placeholder="Buscar">
        <span class="glyphicon glyphicon-search form-control-feedback"></span>
      </div>
    </div>
  </div>

  <div class="row sideBar">
    <?php
    while ($FilaUsers = mysqli_fetch_array($resultadoQuery)) {
      $id_persona     = $FilaUsers['id'];

      $resultado = ("SELECT * FROM msjs WHERE user_id='$id_persona' AND  to_id='$idConectado'  AND leido='NO' ");
      $re  = mysqli_query($con, $resultado);
      $numero_filas = mysqli_num_rows($re);

      //Buscando los msjs que estan sin leer por dicho usuario en sesion.
      $no_leidos = '';
      if ($numero_filas > 0) {
        $res = ("SELECT * FROM msjs WHERE user_id='$id_persona' AND leido='NO' ");
        $ree  = mysqli_query($con, $res);
        if ($cantMsjs = mysqli_num_rows($ree) > 0) { ?>
          <div style="display:none;">
            <audio controls autoplay>
              <source src="effect.mp3" type="audio/mp3">
            </audio>
          </div>
      <?php
        }
      }
      $no_leidos = $numero_filas;
      ?>

      <div class="row sideBar-body" id="<?php echo $FilaUsers['id']; ?>">
        <div class="col-sm-3 col-xs-3 sideBar-avatar">
          <?php
          if ($FilaUsers['estatus'] != 'Inactiva') { ?>
            <div class="avatar-icon">
              <img src="<?php echo 'imagenesperfil/' . $FilaUsers['imagen']; ?>" class="notification-container" style="border:3px solid #28a745 !important;">
            </div>
          <?php } else { ?>
            <div class="avatar-icon">
              <img src="<?php echo 'imagenesperfil/' . $FilaUsers['imagen']; ?>" class="notification-container" style="border:3px solid #696969 !important;">
            </div>
          <?php } ?>
        </div>

        <div class="col-sm-9 col-xs-9 sideBar-main">
          <div class="row">
            <div class="col-sm-8 col-xs-8 sideBar-name">
              <span class="name-meta">
                <?php
                echo $FilaUsers['nombre_apellido'];
                ?>
              </span>
            </div>
            <div class="col-sm-4 col-xs-4 pull-right sideBar-time" style="color:#93918f;">
              <span class="notification-counter">
                <?php echo $no_leidos; ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>


  <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(function() {
      $(".sideBar-body").on("click", function() {

        /**marcar el usuario selecciona**/
        $(".sideBar-body").removeClass("seleccionado");
        $(this).addClass("seleccionado");

        var id = $(this).attr('id');
        var idConectado = "<?php echo $idConectado; ?>";
        var email_user = "<?php echo $email_user; ?>";
        var dataString = 'id=' + id + '&idConectado=' + idConectado + '&email_user=' + email_user;

        var ruta = "UserSeleccionado.php";
        $('#capausermsj').html('<img src="assets/img/cargando.gif" class="ImgCargando"/>');
        $.ajax({
          url: ruta,
          type: "POST",
          data: dataString,
          success: function(data) {
            $("#capausermsj").html(data);
            $("#conversation").animate({
              scrollTop: $(document).height()
            }, 1000);
          }
        });
        return false;
      });
    });


    $(function() {
      $(".heading-compose").click(function() {
        $(".side-two").css({
          "left": "0"
        });
      });

      $(".newMessage-back").click(function() {
        $(".side-two").css({
          "left": "-100%"
        });
      });
    });
  </script>

<?php } ?>