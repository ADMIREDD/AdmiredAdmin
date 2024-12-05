<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "base_proyecto";
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_GET['userId'];


    $query = "DELETE FROM usuarios WHERE ID = {$_POST['userId']}";


    if (mysqli_query($conexion, $query)) {
        echo "El usuario ha sido eliminado exitosamente";
        header("Location: /SENA/AdmiredAdmin/?c=administrador&m=index", true, 301);
    } else {
        echo "Error al eliminar usuario: " . mysqli_error($conexion);
    }


    mysqli_close($conexion);
}
?>