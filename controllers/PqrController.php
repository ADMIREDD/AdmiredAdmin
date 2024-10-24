<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
                pqr.ID, 
                pqr.DETALLE AS 'Detalle', 
                estados.TIPO AS 'Estado', 
                usuarios.NOMBRE AS 'Usuario', 
                pqr_tipo.NOMBRE AS 'Tipo de PQR', 
                pqr.FECHA_SOLICITUD AS 'Fecha de Solicitud', 
                pqr.FECHA_RESPUESTA AS 'Fecha de Respuesta', 
                pqr.RESPUESTA AS 'Respuesta'
            FROM 
                pqr 
            JOIN 
                estados ON pqr.ESTADO_ID = estados.ID
            JOIN 
                usuarios ON pqr.USUARIO_ID = usuarios.ID
            JOIN 
                pqr_tipo ON pqr.PQR_TIPO_ID = pqr_tipo.ID";

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
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            die("El parámetro ID no está definido.");
        }

        $userId = (int)$_GET['id']; // Asegúrate de que sea un entero

        // Aquí podrías agregar más validaciones si lo consideras necesario

        $query = "SELECT 
            pqr.ID, 
            pqr.DETALLE AS 'Detalle', 
            estados.TIPO AS 'Estado', 
            pqr.USUARIO_ID AS 'Usuario', 
            pqr_tipo.NOMBRE AS 'Tipo de PQR', 
            pqr.FECHA_SOLICITUD AS 'Fecha de Solicitud', 
            pqr.FECHA_RESPUESTA AS 'Fecha de Respuesta', 
            pqr.RESPUESTA AS 'Respuesta'
        FROM pqr 
        JOIN estados ON pqr.ESTADO_ID = estados.ID
        JOIN usuarios ON pqr.USUARIO_ID = usuarios.ID
        JOIN pqr_tipo ON pqr.PQR_TIPO_ID = pqr_tipo.ID
        WHERE pqr.ID = ?";

        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

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
        if (isset($_POST['id'], $_POST['userId'])) {
            $pqrId = $_POST['id'];
            $userId = $_POST['userId'];
            $respuesta = '';
            $estadoId = 2; // Example for the new status

            // Recoger la respuesta del botón o del campo personalizado
            if (isset($_POST['estado'])) {
                $respuesta = $_POST['estado'];
            } elseif (isset($_POST['respuestaPersonalizada']) && !empty($_POST['respuestaPersonalizada'])) {
                $respuesta = $_POST['respuestaPersonalizada'];
            } else {
                echo "<script>alert('Por favor, escribe tu respuesta.');</script>";
                return;
            }

            // Obtener el correo del usuario
            $queryUsuario = "SELECT email FROM users WHERE id = ?";
            $stmt = $this->conexion->prepare($queryUsuario);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $resultUsuario = $stmt->get_result();

            if ($resultUsuario->num_rows > 0) {
                $emailUsuario = $resultUsuario->fetch_assoc()['email'];
            } else {
                echo "No se encontró el usuario con el ID especificado.";
                return; // Finaliza la ejecución si no se encuentra el usuario
            }

            $stmt->close();

            // Actualizar el registro PQR con la respuesta y fecha
            $fechaRespuesta = date('Y-m-d H:i:s'); // Define la fecha de respuesta
            $queryUpdate = "UPDATE pqr SET RESPUESTA = ?, FECHA_RESPUESTA = ?, ESTADO_ID = ? WHERE ID = ?";
            $stmtUpdate = $this->conexion->prepare($queryUpdate);
            $stmtUpdate->bind_param('ssii', $respuesta, $fechaRespuesta, $estadoId, $pqrId); // Actualiza con respuesta, fecha, estado, y ID de PQR
            $stmtUpdate->execute();

            // Envío de correo
            $mail = new PHPMailer(true);
            try {
                // Carga las variables de entorno
                $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
                $dotenv->load();

                // Configuración de PHPMailer
                $mail->isSMTP();
                $mail->Host = $_ENV['email.SMTPHost'];
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['email.SMTPUser'];
                $mail->Password = $_ENV['email.SMTPPass'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = $_ENV['email.SMTPPort'];

                // Remitente y destinatario
                $mail->setFrom($_ENV['email.SMTPUser'], 'Admired');
                $mail->addAddress($emailUsuario);

                // Cargar los estilos CSS
                $styles = file_get_contents(__DIR__ . '/../assets/css/email.css');

                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = "Respuesta a tu PQR";
                $mail->Body = '<html><head><style>' . $styles . '</style></head><body>';
                $mail->Body .= '<div class="container">';
                $mail->Body .= '<h1>Tu PQR ha sido respondida</h1>';
                $mail->Body .= '<p>Respuesta: ' . htmlspecialchars($respuesta) . '</p>';
                $mail->Body .= '<a href="#" class="button">Ver PQR</a>'; // Modifica el enlace según sea necesario
                $mail->Body .= '</div>';
                $mail->Body .= '</body></html>';

                // Enviar el correo
                $mail->send();

                // Redirigir a la página de PQR después de enviar el correo
                header("Location: ?c=pqr&m=pqr");
                exit(); // Asegúrate de detener la ejecución del script después de redirigir
            } catch (Exception $e) {
                echo "El correo no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
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

        $query = "DELETE FROM pqr WHERE ID = ?";

        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $userId);

        if ($stmt->execute()) {
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
