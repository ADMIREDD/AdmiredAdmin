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
  echo "Todos los campos son obligatorios.";
  exit();
}

$query = "INSERT INTO usuarios SET
NOMBRE = '$nombre',
APELLIDO = '$apellido',
TIPO_DOCUMENTO_ID = '$tipoDocumento',
NO_DOCUMENTO = '$numeroDocumento',
FECHA_NACIMIENTO = '$fechaNacimiento',
EMAIL = '$email',
CONTRASENA = '$contrasena',
TELEFONO = '$telefono',
CARGO_ID = '$cargo',
TORRE = '$torre',
APTO = '$apto' 
WHERE ID = $userId";

if (mysqli_query($conexion, $query)) {
  echo "El usuario ha sido creado exitosamente";
  header("Location: /SENA/AdmiredAdmin/?c=administrador&m=index", true, 301);
  exit();
} else {
  echo "Error al crear usuario: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>

