<?php


class PqrController
{
    public function pqr()
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

        // Verificar conexión
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        // Definir la consulta para obtener los datos de PQR
        $sql = "SELECT ID, DETALLE, ESTADO_ID, USUARIO_ID, PQR_TIPO FROM pqr";
        $resultado = $conexion->query($sql);

        if ($resultado === FALSE) {
            die("Error en la consulta: " . $conexion->error);
        }

        // Pasar el resultado a la vista
        require_once('views/components/layout/head.php');
        require_once('views/pqr/pqr.php');
        require_once('views/components/layout/footer.php');
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
        require_once ('views/pqr/show.php');
        require_once ('views/components/layout/footer.php');
    }
}
?>
