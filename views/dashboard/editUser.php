<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "base_proyecto";
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

// Verificar la conexión
if (isset($_GET['userId'])) {
    $userId = intval($_GET['userId']);
} else {
    echo "No se ha proporcionado un ID de usuario válido.";
    exit();
}

// Variables para almacenar los datos actualizados del usuario
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

// Query para actualizar los datos del usuario
$query = "UPDATE usuarios SET 
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

// Ejecutar la consulta de actualización
if (mysqli_query($conexion, $query)) {
    echo "El usuario ha sido actualizado exitosamente";
    // Redireccionar a la página de inicio del administrador
    header("Location: /SENA/AdmiredAdmin/?c=administrador&m=index", true, 301);
} else {
    echo "Error al actualizar usuario: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
