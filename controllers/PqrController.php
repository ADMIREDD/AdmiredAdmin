<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class PqrController
{
    private $conexion;

    public function __construct()
    {
        $servidor = "localhost";
        $usuario = "root"; // Cambia esto a tu usuario de base de datos
        $password = ""; // Cambia esto a tu contraseña de base de datos
        $bd = "base_proyecto"; // Asegúrate de que el nombre de la base de datos sea correcto
        $this->conexion = new mysqli($servidor, $usuario, $password, $bd);

        if ($this->conexion->connect_error) {
            die("Connection failed: " . $this->conexion->connect_error);
        }
    }

    public function pqr()
    {
        $sql = "SELECT 
                    ID, 
                    DETALLE AS 'Detalle', 
                    ESTADO_ID AS 'Estado', 
                    USUARIO_ID AS 'Usuario', 
                    PQR_TIPO_ID AS 'Tipo de PQR', 
                    FECHA_SOLICITUD AS 'Fecha de Solicitud', 
                    FECHA_RESPUESTA AS 'Fecha de Respuesta', 
                    RESPUESTA AS 'Respuesta'
                FROM pqr";
        $resultado = $this->conexion->query($sql);

        if ($resultado === FALSE) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        // Pasar el resultado a la vista
        require_once('views/components/layout/head.php');
        require_once('views/pqr/pqr.php');
        require_once('views/components/layout/footer.php');
    }

    public function show()
    {
        if (!isset($_GET['ID']) || empty($_GET['ID'])) {
            die("El parámetro ID no está definido.");
        }

        $userId = (int)$_GET['ID'];

        $query = "SELECT 
                    ID, 
                    DETALLE AS 'Detalle', 
                    ESTADO_ID AS 'Estado', 
                    USUARIO_ID AS 'Usuario', 
                    PQR_TIPO_ID AS 'Tipo de PQR', 
                    FECHA_SOLICITUD AS 'Fecha de Solicitud', 
                    FECHA_RESPUESTA AS 'Fecha de Respuesta', 
                    RESPUESTA AS 'Respuesta'
                FROM pqr 
                WHERE ID = $userId";

        $result = $this->conexion->query($query);

        if (!$result) {
            die("Error en la consulta SQL: " . $this->conexion->error);
        }

        if ($result->num_rows == 0) {
            die("No se encontró ningún PQR con el ID especificado.");
        }

        $user = $result->fetch_assoc();

        require_once('views/components/layout/head.php');
        require_once('views/pqr/show.php');
        require_once('views/components/layout/footer.php');
    }

    public function respond()
    {
        if (isset($_POST['id'], $_POST['respuesta'], $_POST['userId'])) {
            $pqrId = $_POST['id'];
            $respuesta = $_POST['respuesta'];

            if (isset($_POST['respuestaPersonalizada']) && !empty($_POST['respuestaPersonalizada'])) {
                $respuesta = $_POST['respuestaPersonalizada'];
            }

            $userId = $_POST['userId'];

            // Obtener el correo del usuario
            $query = "SELECT EMAIL FROM usuarios WHERE ID = $userId";
            $result = $this->conexion->query($query);

            if (!$result) {
                die("Error en la consulta SQL: " . $this->conexion->error);
            }

            $usuario = $result->fetch_assoc();

            if ($usuario && isset($usuario['EMAIL'])) {
                $emailUsuario = $usuario['EMAIL'];

                $to = $emailUsuario;
                $subject = "Respuesta a tu PQR";
                $message = "Hola, esta es la respuesta a tu PQR:\n\n" . $respuesta;
                $headers = "From: tuemail@ejemplo.com";

                if (mail($to, $subject, $message, $headers)) {
                    // Actualizar la PQR con la respuesta
                    $query = "UPDATE pqr SET RESPUESTA = ?, FECHA_RESPUESTA = ? WHERE ID = ?";
                    $stmt = $this->conexion->prepare($query);
                    $fechaRespuesta = date('Y-m-d');
                    $stmt->bind_param('ssi', $respuesta, $fechaRespuesta, $pqrId);
                    $stmt->execute();
                    $stmt->close();

                    header("Location: ?c=pqr&m=show&ID=$pqrId&success=1");
                    exit();
                } else {
                    echo "Error al enviar el correo.";
                }
            } else {
                echo "Usuario no encontrado o correo electrónico no disponible.";
            }
        } else {
            echo "Error: datos no válidos.";
        }
    }

    public function delete()
    {
        if (!isset($_GET['ID']) || empty($_GET['ID'])) {
            die("El parámetro ID no está definido.");
        }

        $userId = (int)$_GET['ID'];

        $query = "DELETE FROM pqr WHERE ID = $userId";

        if ($this->conexion->query($query)) {
            header("Location: ?c=pqr&m=pqr");
            exit();
        } else {
            die("Error al eliminar el registro: " . $this->conexion->error);
        }
    }

    public function __destruct()
    {
        $this->conexion->close();
    }
}