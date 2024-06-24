<?php

class CuotaController
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
        $query = "select * from cuotas_administracion";
        $resultado = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));


        require_once ('views/components/layout/head.php');
        require_once ('views/cuotas/index.php');
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
        $query = "select * from cuotas_administracion where ID = {$_GET['userId']}";

        $result = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));

        $user = $result->fetch_assoc();
        require_once ('views/components/layout/head.php');
        require_once ('views/cuotas/show.php');
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
        $query = "select * from cuotas_administracion where ID = {$_GET['userId']}";

        $result = mysqli_query($conexion, $query) or die("error: " . mysqli_error($conexion));

        $user = $result->fetch_assoc();
        require_once ('views/components/layout/head.php');
        require_once ('views/cuotas/edit.php');
        require_once ('views/components/layout/footer.php');
    }
    public function crear()
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
            $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
            $estado = mysqli_real_escape_string($conexion, $_POST['estado']);
            $fecha_limite = mysqli_real_escape_string($conexion, $_POST['fecha_limite']);
            $precio = mysqli_real_escape_string($conexion, $_POST['precio']);

            // Consulta para insertar un nuevo usuario
            $query = "INSERT INTO cuotas_administracion (FECHA, ESTADO, FECHA_LIMITE, PRECIO) 
                      VALUES ('$fecha', '$estado', $fecha_limite, '$precio')";

            if (mysqli_query($conexion, $query)) {
                echo "Nueva cuota creado exitosamente";
                header("Location: /SENA/AdmiredAdmin/?c=cuota&m=index", true, 301);
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conexion);
            }

            // Cerrar la conexión
            mysqli_close($conexion);
        } else {
            require_once('views/components/layout/head.php');
            require_once('views/cuotas/crear.php');
            require_once('views/components/layout/footer.php');
        }
    }




    public function delete()
    {
        session_start();

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            echo "Acceso no autorizado para eliminar la cuota. Por favor, inicia sesión.";
            return;
        }

        // Verificar si el usuario tiene el rol adecuado para eliminar cuotas (ejemplo: rol "admin")
        if ($_SESSION['role'] !== 'admin') {
            echo "Acceso no autorizado para eliminar la cuota. Debes ser administrador.";
            return;
        }

        // Procesar la eliminación de la cuota si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar y obtener el ID de la cuota a eliminar
            if (!isset($_POST['cuota_id']) || !is_numeric($_POST['cuota_id'])) {
                echo "Error: ID de cuota inválido.";
                return;
            }

            $cuotaId = $_POST['cuota_id'];

            // Realizar la eliminación en la base de datos
            $servidor = "localhost";
            $usuario = "root";
            $password = "";
            $bd = "base_proyecto";
            $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

            if (mysqli_connect_error()) {
                echo "Conexión fallida: " . mysqli_connect_error();
                return;
            }

            // Sanitizar el ID de la cuota para evitar inyección SQL
            $cuotaId = mysqli_real_escape_string($conexion, $cuotaId);

            // Query para eliminar la cuota
            $query = "DELETE FROM cuotas_administracion WHERE ID = $cuotaId";

            if (mysqli_query($conexion, $query)) {
                echo "Cuota eliminada exitosamente.";
                // Redireccionar o mostrar un mensaje de éxito
            } else {
                echo "Error al eliminar la cuota: " . mysqli_error($conexion);
            }

            // Cerrar la conexión
            mysqli_close($conexion);
        } else {
            echo "Acceso no autorizado para eliminar la cuota. Método de solicitud incorrecto.";
        }
    }
}




