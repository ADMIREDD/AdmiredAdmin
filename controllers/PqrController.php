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
                WHERE ID = ?";

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

            // Priorizar respuesta personalizada si está definida
            if (isset($_POST['respuestaPersonalizada']) && !empty($_POST['respuestaPersonalizada'])) {
                $respuesta = $_POST['respuestaPersonalizada'];
            } elseif (isset($_POST['respuesta'])) {
                $respuesta = $_POST['respuesta'];
            } else {
                echo "Error: datos no válidos.";
                return;
            }

            // Obtener el correo del usuario
            $queryUsuario = "SELECT EMAIL FROM usuarios WHERE ID = ?";
            $stmt = $this->conexion->prepare($queryUsuario);
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $resultUsuario = $stmt->get_result();
            $emailUsuario = $resultUsuario->fetch_assoc()['EMAIL'] ?? null;

            $stmt->close();

            if ($emailUsuario) {
                // Envío de correo
                $mail = new PHPMailer(true);
                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'joserosellonl@gmail.com'; // Tu dirección de correo
                    $mail->Password = 'jeka plnp gluz hbiy'; // Tu contraseña
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // O PHPMailer::ENCRYPTION_SMTPS para SSL
                    $mail->Port = 587; // Cambia esto si es necesario

                    // Remitente y destinatario
                    $mail->setFrom('joserosellonl@gmail.com', 'admired'); // Cambia esto a tu dirección de correo
                    $mail->addAddress($emailUsuario); // El correo del destinatario

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = "Respuesta a tu PQR";
                    $mail->Body = "Hola,<br><br>Esta es la respuesta a tu PQR:<br><br>" . nl2br(htmlspecialchars($respuesta));

                    // Enviar el correo
                    $mail->send();

                    // Actualizar la PQR con la respuesta y la fecha de respuesta
                    $queryUpdate = "UPDATE pqr SET RESPUESTA = ?, FECHA_RESPUESTA = ? WHERE ID = ?";
                    $stmt = $this->conexion->prepare($queryUpdate);
                    $fechaRespuesta = date('Y-m-d H:i:s'); // Considera la fecha y hora
                    $stmt->bind_param('ssi', $respuesta, $fechaRespuesta, $pqrId);
                    $stmt->execute();
                    $stmt->close();

                    // Manejar archivos adjuntos
                    if (isset($_FILES['adjuntos']) && !empty($_FILES['adjuntos']['name'][0])) {
                        foreach ($_FILES['adjuntos']['tmp_name'] as $key => $tmp_name) {
                            $file_name = $_FILES['adjuntos']['name'][$key];
                            $file_tmp = $_FILES['adjuntos']['tmp_name'][$key];

                            // Aquí puedes establecer la ruta donde se guardarán los archivos
                            $uploadDir = "ruta/a/tu/directorio/"; // Cambia esto a tu ruta
                            move_uploaded_file($file_tmp, $uploadDir . $file_name);
                        }
                    }

                    header("Location: ?c=pqr&m=show&ID=$pqrId&success=1");
                    exit();
                } catch (Exception $e) {
                    echo "El correo no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "No se encontró un correo electrónico registrado para el usuario.";
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
