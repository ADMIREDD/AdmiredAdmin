<?php

class CuotaController
{
    private function conectarBD()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

        if (mysqli_connect_error()) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        return $conexion;
    }

    public function index()
    {
        $conexion = $this->conectarBD();

        $query = "SELECT * FROM cuotas_administracion";
        $resultado = mysqli_query($conexion, $query) or die("Error: " . mysqli_error($conexion));

        require_once('views/components/layout/head.php');
        require_once('views/cuotas/index.php');
        require_once('views/components/layout/footer.php');

        mysqli_close($conexion);
    }

    public function show()
    {
        $conexion = $this->conectarBD();

        $cuotaId = mysqli_real_escape_string($conexion, $_GET['userId']);
        $query = "SELECT * FROM cuotas_administracion WHERE ID = $cuotaId";

        $result = mysqli_query($conexion, $query) or die("Error: " . mysqli_error($conexion));
        $cuota = $result->fetch_assoc();

        if ($cuota) {
            // Pasar los datos a la vista
            $this->loadView('views/cuotas/show.php', ['cuota' => $cuota]);
        } else {
            echo "Cuota no encontrada.";
        }

        mysqli_close($conexion);
    }

    private function loadView($view, $data = [])
    {
        extract($data);
        require_once('views/components/layout/head.php');
        require_once('views/cuotas/show.php');
        require_once('views/components/layout/footer.php');
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
            $conexion = $this->conectarBD();

            $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
            $estado = mysqli_real_escape_string($conexion, $_POST['estado']);
            $fecha_limite = mysqli_real_escape_string($conexion, $_POST['fecha_limite']);
            $precio = mysqli_real_escape_string($conexion, $_POST['precio']);

            $query = "INSERT INTO cuotas_administracion (FECHA, ESTADO, FECHA_LIMITE, PRECIO) 
                      VALUES ('$fecha', '$estado', '$fecha_limite', '$precio')";

            if (mysqli_query($conexion, $query)) {
                echo "Nueva cuota creada exitosamente";
                header("Location: /SENA/AdmiredAdmin/?c=cuota&m=index", true, 301);
                exit();
            } else {
                echo "Error al crear la cuota: " . mysqli_error($conexion);
            }

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

    // Verificar si el usuario está autenticado y tiene el rol de administrador
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
        echo "Acceso no autorizado para eliminar la cuota.";
        return;
    }

    // Verificar si la solicitud es POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verificar y sanitizar el ID de la cuota
        if (!isset($_POST['cuota_id']) || !is_numeric($_POST['cuota_id'])) {
            echo "Error: ID de cuota inválido.";
            return;
        }

        // Conectar a la base de datos
        $conexion = $this->conectarBD();
        $cuotaId = mysqli_real_escape_string($conexion, $_POST['cuota_id']);

        // Crear la consulta SQL
        $query = "DELETE FROM cuotas_administracion WHERE ID = $cuotaId";

        // Ejecutar la consulta y verificar el resultado
        if (mysqli_query($conexion, $query)) {
            // Redireccionar o mostrar un mensaje de éxito
            $_SESSION['message'] = "Cuota eliminada exitosamente.";
            header('Location: ?c=cuota&m=index');
            exit();
        } else {
            echo "Error al eliminar la cuota: " . mysqli_error($conexion);
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Acceso no autorizado para eliminar la cuota. Método de solicitud incorrecto.";
    }
}


}
?>
