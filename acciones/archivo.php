<?php
include('../config/config.php');
$nombre_equipo_user = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$to_user = $_REQUEST['to_user'];
$user = $_REQUEST['user'];

$user_id = $_POST['user_id'];
$to_id = $_POST['to_id'];
$leido = "NO";
date_default_timezone_set("America/Bogota");
$hora = date('h:i a', time() - 3600 * date('I'));
$fecha = date("d/m/Y");
$FechaMsj = $fecha . " " . $hora;

$directorio = '../archivos/';
if (!file_exists($directorio)) {
  mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
}

// Verificar si se envió al menos un archivo
if (isset($_FILES["namearchivo"]) && !empty($_FILES["namearchivo"]["name"])) {
  $filename = $_FILES["namearchivo"]["name"];
  $source = $_FILES["namearchivo"]["tmp_name"];

  // Renombrar el nombre de la imagen
  $logitudPass = 10;
  $newNameFoto = substr(md5(microtime()), 1, $logitudPass);

  $explode = explode('.', $filename);
  $extension_foto = array_pop($explode);
  $nuevoNameFoto = $newNameFoto . '.' . $extension_foto;

  $target_path = $directorio . '/' . $nuevoNameFoto;

  // Mover y guardar la imagen solo si no existe ya en el servidor
  if (!file_exists($target_path)) {
    if (move_uploaded_file($source, $target_path)) {
      $sqlInsertImg = ("INSERT INTO msjs(user,user_id,to_user,to_id,fecha,nombre_equipo_user,leido,archivos) VALUES('$user','$user_id','$to_user','$to_id','$FechaMsj','$nombre_equipo_user','$leido','$nuevoNameFoto')");
      $resulInsertImg = mysqli_query($con, $sqlInsertImg);
    } else {
      echo "Ha ocurrido un error al cargar la imagen, por favor inténtelo de nuevo.<br>";
    }
  } else {
    echo "La imagen con el mismo nombre ya existe en el servidor.<br>";
  }
}
