<?php

class AdministradorController
{

    public function index()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        $query = "select * from usuarios";
        $resultado = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));


        require_once ('views/components/layout/head.php');
        require_once ('views/administrador/index.php');
        require_once ('views/components/layout/footer.php');
    }

    public function show()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        $query = "select * from usuarios where ID = {$_GET['userId']}";

        $result = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));

        $user = $result->fetch_assoc();
        require_once ('views/components/layout/head.php');
        require_once ('views/administrador/show.php');
        require_once ('views/components/layout/footer.php');
    }
    public function edit()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        $query = "select * from usuarios where ID = {$_GET['userId']}";

        $result = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));

        $user = $result->fetch_assoc();
        require_once ('views/components/layout/head.php');
        require_once ('views/administrador/edit.php');
        require_once ('views/components/layout/footer.php');
    }
    public function create()
{
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $bd = "base_proyecto";
    $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

    if (mysqli_connect_error()) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Datos del formulario
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
        $edad = (int) $_POST['edad'];

        // Consulta para insertar un nuevo usuario
        $query = "INSERT INTO usuarios (nombre, correo, edad) VALUES ('$nombre', '$correo', $edad)";

        if (mysqli_query($conexion, $query)) {
            echo "Nuevo usuario creado exitosamente";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conexion);
        }
    }

    require_once('views/components/layout/head.php');
    require_once('views/administrador/index.php');
    require_once('views/components/layout/footer.php');

    // Cerrar la conexión
    mysqli_close($conexion);
}


    public function destroy()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
        $query = "select * from usuarios where ID = {$_GET['userId']}";

        $result = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));

        $user = $result->fetch_assoc();
        require_once ('views/components/layout/head.php');
        require_once ('views/administrador/destroy.php');
        require_once ('views/components/layout/footer.php');
    }
}