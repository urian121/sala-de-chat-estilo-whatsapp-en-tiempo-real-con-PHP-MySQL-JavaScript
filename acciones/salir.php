<?php
include('../config/config.php');

session_start();
$IdUserSession = $_REQUEST['id'];

//Eliminando las  cookies  en session
setcookie ($_SESSION['id'], "", 1);
setcookie ($_SESSION['id'], false);
unset($_COOKIE[$_SESSION['id']]);


unset ($_SESSION['id']); // Eliminar el IdUser de usuario
session_unset(); //Eliminar todas las sesiones

// Terminar la sesión:
session_destroy();
$parametros_cookies = session_get_cookie_params();
setcookie(session_name(),0,1,$parametros_cookies["path"]);
    

date_default_timezone_set("America/Bogota" ) ;
$hora = date('h:i a',time() - 3600*date('I'));
$fecha = date("d/m/Y");
$UltimaSession = $fecha." ".$hora;

//ACTUALIZANDO EL ESTADO DE CONEXION DEL USUARIO ES DECIR, USUARIO DESCONECTADO.
$stateconexion = "Inactiva";
$updateStateConexion = ("UPDATE users SET estatus='$stateconexion', fecha_session='$UltimaSession' WHERE id='$IdUserSession' ");
$stateUpdate = mysqli_query($con, $updateStateConexion);
if ($stateUpdate >0) {
	echo '<meta http-equiv="refresh" content="0;url=../index.php">';
}

?>
