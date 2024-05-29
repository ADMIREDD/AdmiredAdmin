<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "base_proyecto";
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

// Verificar la conexión
if (mysqli_connect_errno()) {
    echo "Error al conectar con MySQL: " . mysqli_connect_error();
    exit();
}

// Obtener el ID del usuario a actualizar
$userId = $_GET['userId'];

// Variables para almacenar los datos actualizados del usuario
$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$tipoDocumento = mysqli_real_escape_string($conexion, $_POST['tipo_documento']);
$numeroDocumento = mysqli_real_escape_string($conexion, $_POST['no_documento']);
$fechaNacimiento = mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']);
$email = mysqli_real_escape_string($conexion, $_POST['email']);
$contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$cargo = mysqli_real_escape_string($conexion, $_POST['cargo']);
$torre = mysqli_real_escape_string($conexion, $_POST['torre']);
$apto = mysqli_real_escape_string($conexion, $_POST['apto']);

// Query para actualizar los datos del usuario
$query = "UPDATE usuarios SET 
              NOMBRE = '$nombre',
              APELLIDO = '$apellido',
              USUARIO = '$usuario',
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
    header("Location: /SENA/ADMIREDD/?c=administrador&m=index", true, 301);
} else {
    echo "Error al actualizar usuario: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
