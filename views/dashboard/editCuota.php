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
    echo "No se ha proporcionado un ID de cuota válido.";
    exit();
}

// Variables para almacenar los datos actualizados del usuario
$fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
$estado = mysqli_real_escape_string($conexion, $_POST['estado']);
$fechaLimite = mysqli_real_escape_string($conexion, $_POST['fecha_limite']);
$precio = mysqli_real_escape_string($conexion, $_POST['precio']);


if (empty($fecha) || empty($estado) || empty($fechaLimite) || empty($precio)) {
    echo "Todos los campos son obligatorios.";
    exit();
}

// Query para actualizar los datos del usuario
$query = "UPDATE cuotas_administracion SET 
              FECHA = '$fecha',
              ESTADO = '$estado',
              FECHA_LIMITE = '$fechaLimite',
              PRECIO = '$precio',
            WHERE ID = $userId";

// Ejecutar la consulta de actualización
if (mysqli_query($conexion, $query)) {
    echo "La cuota ha sido actualizado exitosamente";
    // Redireccionar a la página de inicio del administrador
    header("Location: /SENA/AdmiredAdmin/?c=cuotas&m=index", true, 301);
} else {
    echo "Error al actualizar cuota: " . mysqli_error($conexion);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);