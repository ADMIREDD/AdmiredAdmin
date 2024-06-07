<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "base_proyecto";
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

if (!$conexion) {
  die("Error al conectar con MySQL: " . mysqli_connect_error());
}

$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
$tipoDocumento = mysqli_real_escape_string($conexion, $_POST['tipo_documento']);
$numeroDocumento = mysqli_real_escape_string($conexion, $_POST['no_documento']);
$fechaNacimiento = mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']);
$email = mysqli_real_escape_string($conexion, $_POST['email']);
$contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$cargo = mysqli_real_escape_string($conexion, $_POST['cargo']);
$torre = mysqli_real_escape_string($conexion, $_POST['torre']);
$apto = mysqli_real_escape_string($conexion, $_POST['apto']);

if (empty($nombre) || empty($apellido) || empty($tipoDocumento) || empty($numeroDocumento) || empty($fechaNacimiento) || empty($email) || empty($contrasena) || empty($telefono) || empty($cargo) || empty($torre) || empty($apto)) {
  die("Todos los campos son obligatorios.");
}

$query = "INSERT INTO usuarios (NOMBRE, APELLIDO, TIPO_DOCUMENTO_ID, NO_DOCUMENTO, FECHA_NACIMIENTO, EMAIL, CONTRASENA, TELEFONO, CARGO_ID, TORRE, APTO) 
          VALUES ('$nombre', '$apellido', '$usuario', '$tipoDocumento', '$numeroDocumento', '$fechaNacimiento', '$email', '$contrasena', '$telefono', '$cargo', '$torre', '$apto')";

if (mysqli_query($conexion, $query)) {
  echo "El usuario ha sido creado exitosamente";
  header("Location: /SENA/AdmiredAdmin/?c=administrador&m=index", true, 301);
  exit();
} else {
  echo "Error al crear usuario: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>

