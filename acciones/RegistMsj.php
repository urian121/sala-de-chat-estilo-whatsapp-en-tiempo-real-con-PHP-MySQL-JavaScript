<?php
include('../config/config.php');

date_default_timezone_set("America/Bogota" ) ;
$hora             = date('h:i a',time() - 3600*date('I'));
$fecha            = date("d/m/Y");
$FechaMsj         = $fecha." ".$hora;
$nombre_equipo_user = gethostbyaddr($_SERVER['REMOTE_ADDR']);

$de               = $_POST['user'];
$UserId 		      = $_POST['user_id'];
$to_id 			      = $_POST['to_id'];
$para                 = $_POST['to_user'];
$leido 			      = "NO";
$msj 	            = utf8_decode( strip_tags(trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING))) );

if($msj != ''){
  $NuevoMsj  = ("INSERT INTO msjs (user, user_id,to_user,to_id,message,fecha,nombre_equipo_user,leido)
    VALUES ('$de', '$UserId', '$para', '$to_id', '$msj', '$FechaMsj', '$nombre_equipo_user', '$leido')");
  $reg = mysqli_query($con, $NuevoMsj);
 
	}
?>
