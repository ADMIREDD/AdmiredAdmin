<?php
// Establecer conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$bd = "base_proyecto";
$conexion = mysqli_connect($servidor, $usuario, $password, $bd);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];

    $contrasena = $_POST['password'];

    // Consulta para verificar las credenciales
    $consulta = "SELECT * FROM usuarios WHERE EMAIL = '$email' AND CONTRASENA = '$contrasena'";

    $resultado = $conexion->query($consulta);



    if ($resultado->num_rows > 0) {
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso";
        header("Location: ./?c=pqr&m=pqr", true, 301);
        header("Location: /SENA/ADMIREDD/?c=pqr&m=pqr", true, 301);

        // Puedes redirigir o realizar acciones posteriores al inicio de sesión aquí
    } else {
        // Credenciales incorrectas
        echo "Correo electrónico o contraseña incorrectos";
    }
}

$conexion->close(); // Cerrar conexión
?>