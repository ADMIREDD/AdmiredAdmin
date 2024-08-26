<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

        // Definir la consulta para obtener los datos de PQR con nombres de columnas ajustados
        $sql = "SELECT 
                    ID, 
                    DETALLE AS 'Detalle', 
                    ESTADO_ID AS 'Estado', 
                    USUARIO_ID AS 'Usuario', 
                    PQR_TIPO AS 'Tipo de PQR', 
                    FECHA_SOLICITUD AS 'Fecha de Solicitud', 
                    FECHA_RESPUESTA AS 'Fecha de Respuesta', 
                    RESPUESTA AS 'Respuesta'
                FROM pqr";
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
        $query = "SELECT 
                ID, 
                DETALLE AS 'Detalle', 
                ESTADO_ID AS 'Estado', 
                USUARIO_ID AS 'Usuario', 
                PQR_TIPO AS 'Tipo de PQR', 
                FECHA_SOLICITUD AS 'Fecha de Solicitud', 
                FECHA_RESPUESTA AS 'Fecha de Respuesta', 
                RESPUESTA AS 'Respuesta'
              FROM pqr 
              WHERE ID = $userId";

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

    public function respond()
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

        // Verificar que ID esté definido
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            die("El parámetro id no está definido.");
        }

        $id = (int)$_POST['id'];
        $response = $_POST['response'] ?? null;
        $customResponse = $_POST['customResponse'] ?? '';

        // Definir la consulta SQL para actualizar la respuesta
        $query = "UPDATE pqr SET RESPUESTA = ?, FECHA_RESPUESTA = NOW() WHERE ID = ?";
        $stmt = $conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        // Determinar qué valor usar para la respuesta
        $respuesta = $response ?: $customResponse;

        // Asegúrate de que el tipo de parámetro es correcto
        $stmt->bind_param('si', $respuesta, $id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Manejo de archivos adjuntos
            if (!empty($_FILES['attachments']['name'][0])) {
                $uploadDir = 'uploads/';
                foreach ($_FILES['attachments']['tmp_name'] as $key => $tmp_name) {
                    $fileName = basename($_FILES['attachments']['name'][$key]);
                    $targetFile = $uploadDir . $fileName;
                    if (move_uploaded_file($tmp_name, $targetFile)) {
                        // Puedes guardar la ruta del archivo en la base de datos si lo deseas
                    } else {
                        echo "Error al subir el archivo: $fileName";
                    }
                }
            }

            // Obtener el correo electrónico del usuario
            $query = "SELECT USUARIO_ID FROM pqr WHERE ID = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();

            $to = $usuario['USUARIO_ID'];
            $subject = "Respuesta a tu PQR";
            $message = "Tu PQR con ID $id ha sido respondida. Respuesta: " . ($response ?: $customResponse);
            $headers = "From: no-reply@example.com\r\n";
            $headers .= "Reply-To: no-reply@example.com\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // Verificar el envío del correo
            if (mail($to, $subject, $message, $headers)) {
                echo "Respuesta enviada exitosamente.";
            } else {
                echo "Error al enviar el correo.";
            }

            header("Location: ?c=pqr&m=pqr");
            exit();
        } else {
            die("Error al actualizar la respuesta: " . $stmt->error);
        }
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
