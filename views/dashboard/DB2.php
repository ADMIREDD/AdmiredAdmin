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

$nombre = mysqli_real_escape_string($conexion, $_REQUEST['nombre']);
$apellido = mysqli_real_escape_string($conexion, $_REQUEST['apellido']);
$usuario = mysqli_real_escape_string($conexion, $_REQUEST['usuario']);
$tipoDocumento = mysqli_real_escape_string($conexion, $_REQUEST['tipo_documento']);
$numeroDocumento = mysqli_real_escape_string($conexion, $_REQUEST['no_documento']);
$fechaNacimiento = mysqli_real_escape_string($conexion, $_REQUEST['fecha_nacimiento']);
$correo = mysqli_real_escape_string($conexion, $_REQUEST['email']);
$contrasena = mysqli_real_escape_string($conexion, $_REQUEST['contrasena']);
$telefono = mysqli_real_escape_string($conexion, $_REQUEST['telefono']);
$cargo = mysqli_real_escape_string($conexion, $_REQUEST['cargo']);
$torre = mysqli_real_escape_string($conexion, $_REQUEST['torre']);
$apto = mysqli_real_escape_string($conexion, $_REQUEST['apto']);

if ($cargo == "2") {
  $query = "INSERT INTO usuario_admin (NOMBRE, APELLIDO, USUARIO, TIPO_DOCUMENTO_ID, NO_DOCUMENTO, FECHA_NACIMIENTO, EMAIL, CONTRASENA, TELEFONO, CARGO_ID, TORRE, APTO) 
VALUES ('$nombre', '$apellido', '$usuario', '$tipoDocumento', '$numeroDocumento', '$fechaNacimiento', '$correo', '$contrasena', '$telefono', '$cargo', '$torre', '$apto')";
  $resultado = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));
  mysqli_close($conexion);
  echo "El usuario ha sido registrado exitosamente";
  header("Location: ../administrador/?c=administrador&m=index", true, 301);


  if (mysqli_connect_errno()) {
    echo "Error al conectar con MySQL: " . mysqli_connect_error();
    exit();
  }
} else {
  $query = "INSERT INTO usuarios (NOMBRE, APELLIDO, USUARIO, TIPO_DOCUMENTO_ID, NO_DOCUMENTO, FECHA_NACIMIENTO, EMAIL, CONTRASENA, TELEFONO, CARGO_ID, TORRE, APTO) 
VALUES ('$nombre', '$apellido', '$usuario', '$tipoDocumento', '$numeroDocumento', '$fechaNacimiento', '$correo', '$contrasena', '$telefono', '$cargo', '$torre', '$apto')";
  $resultado = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));
  mysqli_close($conexion);
  echo "El usuario ha sido registrado exitosamente";
  header("Location: ../administrador/?c=administrador&m=index", true, 301);

$resultado = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));
mysqli_close($conexion);
echo "El usuario ha sido registrado exitosamente";
header("Location: /SENA/ADMIREDD/?c=administrador&m=index", true, 301);


  if (mysqli_connect_errno()) {
    echo "Error al conectar con MySQL: " . mysqli_connect_error();
    exit();
  }
}
