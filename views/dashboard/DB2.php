<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "base_proyecto";
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);
$query = "";

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$nombre = mysqli_real_escape_string($conexion, $_REQUEST['NOMBRE']);
$apellido = mysqli_real_escape_string($conexion, $_REQUEST['APELLIDO']);
$tipoDocumento = mysqli_real_escape_string($conexion, $_REQUEST['TIPO_DOCUMENTO']);
$numeroDocumento = mysqli_real_escape_string($conexion, $_REQUEST['NO_DOCUMENTO']);
$fechaNacimiento = mysqli_real_escape_string($conexion, $_REQUEST['FECHA_NACIMIENTO']);
$correo = mysqli_real_escape_string($conexion, $_REQUEST['EMAIL']);
$contrasena = mysqli_real_escape_string($conexion, $_REQUEST['CONTRASENA']);
$telefono = mysqli_real_escape_string($conexion, $_REQUEST['TELEFONO']);
$cargo = mysqli_real_escape_string($conexion, $_REQUEST['CARGO']);
$torre = mysqli_real_escape_string($conexion, $_REQUEST['TORRE']);
$apto = mysqli_real_escape_string($conexion, $_REQUEST['APTO']);

if ($cargo == "2") {
  $query = "INSERT INTO usuarios (NOMBRE, APELLIDO, TIPO_DOCUMENTO_ID, NO_DOCUMENTO, FECHA_NACIMIENTO, EMAIL, CONTRASENA, TELEFONO, CARGO_ID, TORRE, APTO) 
VALUES ('$nombre', '$apellido', '$usuario', '$tipoDocumento', '$numeroDocumento', '$fechaNacimiento', '$correo', '$contrasena', '$telefono', '$cargo', '$torre', '$apto')";
  $resultado = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));
  mysqli_close($conexion);
  echo "El usuario ha sido registrado exitosamente";
  header("Location: ../administrador/?c=administrador&m=index", true, 301);


  if (mysqli_connect_errno()) {
    echo "Error al conectar con MySQL: " . mysqli_connect_error();
    exit();
  }

}
