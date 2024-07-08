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

        // Verificar que userId esté definido
        if (!isset($_GET['userId']) || empty($_GET['userId'])) {
            die("El parámetro userId no está definido.");
        }

        $userId = (int)$_GET['userId'];

        // Definir la consulta SQL
        $query = "SELECT * FROM pqr WHERE ID = $userId";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $query);

        // Verificar si hay errores en la consulta
        if (!$result) {
            die("Error en la consulta SQL: " . mysqli_error($conexion));
        }

        // Verificar si se obtuvo algún resultado
        if (mysqli_num_rows($result) == 0) {
            die("No se encontró ningún usuario con el ID especificado.");
        }

        $user = $result->fetch_assoc();

        // Pasar el resultado a la vista
        require_once('views/components/layout/head.php');
        require_once('views/pqr/show.php');
        require_once('views/components/layout/footer.php');
    }

    public function delete()
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

        // Verificar que userId esté definido
        if (!isset($_GET['userId']) || empty($_GET['userId'])) {
            die("El parámetro userId no está definido.");
        }

        $userId = (int)$_GET['userId'];

        // Definir la consulta SQL para eliminar
        $query = "DELETE FROM pqr WHERE ID = $userId";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $query)) {
            echo "Registro eliminado exitosamente.";
            // Redirigir después de eliminar
            header("Location: ?c=pqr&m=pqr");
            exit();
        } else {
            die("Error al eliminar el registro: " . mysqli_error($conexion));
        }
    }
}
?>
}
?>
