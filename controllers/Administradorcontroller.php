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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $servidor = "localhost";
            $usuario = "root";
            $password = "";
            $bd = "base_proyecto";
            $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

            if (mysqli_connect_error()) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            // Datos del formulario
            $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
            $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
            $tipo_documento = (int) $_POST['tipo_documento'];
            $no_documento = mysqli_real_escape_string($conexion, $_POST['no_documento']);
            $fecha_nacimiento = mysqli_real_escape_string($conexion, $_POST['fecha_nacimiento']);
            $email = mysqli_real_escape_string($conexion, $_POST['email']);
            $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);
            $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
            $cargo = (int) $_POST['cargo'];
            $torre = mysqli_real_escape_string($conexion, $_POST['torre']);
            $apto = mysqli_real_escape_string($conexion, $_POST['apto']);

              

            // Consulta para insertar un nuevo usuario
            $query = "INSERT INTO usuarios (NOMBRE, APELLIDO, TIPO_DOCUMENTO_ID, NO_DOCUMENTO, FECHA_NACIMIENTO, EMAIL, CONTRASENA, TELEFONO, CARGO_ID, TORRE, APTO) 
                      VALUES ('$nombre', '$apellido', $tipo_documento, '$no_documento', '$fecha_nacimiento', '$email', '$contrasena', '$telefono', $cargo, '$torre', '$apto')";

            if (mysqli_query($conexion, $query)) {
                echo "Nuevo usuario creado exitosamente";
                header("Location: /SENA/AdmiredAdmin/?c=administrador&m=index", true, 301);
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conexion);
            }

            // Cerrar la conexión
            mysqli_close($conexion);
        } else {
            require_once('views/components/layout/head.php');
            require_once('views/administrador/create.php');
            require_once('views/components/layout/footer.php');
        }
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