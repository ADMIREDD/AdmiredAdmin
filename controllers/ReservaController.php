<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ReservaController
{
    private $conexion;

    public function __construct()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $this->conexion = new mysqli($servidor, $usuario, $password, $bd);

        if ($this->conexion->connect_error) {
            die("Connection failed: " . $this->conexion->connect_error);
        }
    }

    private function ejecutarConsulta($sql, $params = [])
    {
        $stmt = $this->conexion->prepare($sql);
        if ($params) {
            $stmt->bind_param(...$params);
        }
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getNombreAreaComun($idAreaComun)
    {
        $sql = "SELECT NOMBRE FROM areas_comunes WHERE ID = ?";
        $resultado = $this->ejecutarConsulta($sql, ["i", $idAreaComun]);

        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row['NOMBRE'];
        }
        return "Desconocido";
    }

    public function getEstadoReserva($idEstadoReserva)
    {
        $sql = "SELECT DESCRIPCION FROM estados_reserva WHERE ID = ?";
        $resultado = $this->ejecutarConsulta($sql, ["i", $idEstadoReserva]);

        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row['DESCRIPCION'];
        }
        return "Desconocido";
    }

    public function getNombreUsuario($idUsuario)
    {
        if (empty($idUsuario)) {
            return "Usuario Desconocido";
        }

        $sql = "SELECT CONCAT(NOMBRE, ' ', APELLIDO) AS NOMBRE_COMPLETO FROM usuarios WHERE ID = ?";
        $resultado = $this->ejecutarConsulta($sql, ["i", $idUsuario]);

        if ($resultado && $resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row['NOMBRE_COMPLETO'];
        }
        return "Usuario Desconocido";
    }

    public function index()
    {
        $reservas = [];
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT 
            r.ID, 
            r.FECHA_RESERVA AS 'Fecha Reserva', 
            r.FECHA_FIN AS 'Fecha Fin', 
            r.ID_AREA_COMUN AS 'Área Común', 
            r.ID_ESTADO_RESERVA AS 'Estado Reserva', 
            r.ID_USUARIO AS 'Usuario', 
            r.OBSERVACION_ENTREGA AS 'Observación Entrega', 
            r.OBSERVACION_RECIBE AS 'Observación Recibe', 
            r.VALOR AS 'Valor'
        FROM reservas r
        JOIN usuarios u ON r.ID_USUARIO = u.ID 
        WHERE u.NOMBRE LIKE '%$search%' OR u.APELLIDO LIKE '%$search%'
        ORDER BY r.ID DESC";

        $resultado = $this->conexion->query($sql);

        if ($resultado === FALSE) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        while ($row = $resultado->fetch_assoc()) {
            $row['Nombre Area'] = $this->getNombreAreaComun($row['Área Común']);
            $row['Estado Texto'] = $this->getEstadoReserva($row['Estado Reserva']);
            $row['Nombre Usuario'] = $this->getNombreUsuario($row['Usuario']);
            $reservas[] = $row;
        }

        $data['reservas'] = $reservas;
        $data['search'] = $search;

        require_once('views/components/layout/head.php');
        require_once('views/reservas/index.php');
        require_once('views/components/layout/footer.php');
    }

    public function show($id)
    {
        $sql = "SELECT 
            r.ID, 
            r.FECHA_RESERVA, 
            r.FECHA_FIN, 
            r.ID_AREA_COMUN, 
            r.ID_USUARIO, 
            r.OBSERVACION_ENTREGA, 
            r.OBSERVACION_RECIBE, 
            r.VALOR, 
            r.ID_ESTADO_RESERVA,
            a.NOMBRE AS 'Nombre Area',
            u.NOMBRE AS 'Nombre Usuario', 
            u.APELLIDO AS 'Apellido Usuario', 
            e.DESCRIPCION AS 'Estado Reserva'
        FROM reservas r
        JOIN areas_comunes a ON r.ID_AREA_COMUN = a.ID
        JOIN usuarios u ON r.ID_USUARIO = u.ID
        JOIN estados_reserva e ON r.ID_ESTADO_RESERVA = e.ID
        WHERE r.ID = ?";

        $resultado = $this->ejecutarConsulta($sql, ["i", $id]);

        if ($resultado->num_rows === 0) {
            die("Reserva no encontrada.");
        }

        $reserva = $resultado->fetch_assoc();

        require_once('views/components/layout/head.php');
        require_once('views/reservas/show.php');
        require_once('views/components/layout/footer.php');
    }


    public function edit($id)
    {
        $sql = "SELECT 
                r.ID, 
                r.FECHA_RESERVA, 
                r.FECHA_FIN, 
                r.ID_AREA_COMUN, 
                r.ID_USUARIO, 
                r.OBSERVACION_ENTREGA, 
                r.OBSERVACION_RECIBE, 
                r.VALOR, 
                r.ID_ESTADO_RESERVA,
                a.NOMBRE AS 'Nombre Area',
                u.NOMBRE AS 'Nombre Usuario', 
                u.APELLIDO AS 'Apellido Usuario',
                e.DESCRIPCION AS 'Estado Reserva'
            FROM reservas r
            JOIN areas_comunes a ON r.ID_AREA_COMUN = a.ID
            JOIN usuarios u ON r.ID_USUARIO = u.ID
            JOIN estados_reserva e ON r.ID_ESTADO_RESERVA = e.ID
            WHERE r.ID = ?";

        $resultado = $this->ejecutarConsulta($sql, ["i", $id]);
        if ($resultado->num_rows === 0) {
            die("Reserva no encontrada.");
        }

        $reserva = $resultado->fetch_assoc();

        require_once('views/components/layout/head.php');
        require_once('views/reservas/edit.php');
        require_once('views/components/layout/footer.php');
    }

    public function update()
    {
        $id = $_GET['id'];
        $fechaReserva = $_POST['fecha_reserva'];
        $fechaFin = $_POST['fecha_fin'];
        $idAreaComun = $_POST['id_area_comun'];
        $idEstadoReserva = $_POST['id_estado_reserva'];
        $observacionEntrega = $this->conexion->real_escape_string(trim($_POST['observacion_entrega'] ?? ''));
        $observacionRecibe = $this->conexion->real_escape_string(trim($_POST['observacion_recibe'] ?? ''));
        $valor = $_POST['valor'];

        // Confirma los valores que están siendo recibidos
        var_dump("Valor recibido de observacion_entrega:", $observacionEntrega);
        var_dump("Valor recibido de observacion_recibe:", $observacionRecibe);

        // Crear la consulta directamente
        $queryActualizar = "UPDATE reservas SET 
        FECHA_RESERVA = '$fechaReserva', 
        FECHA_FIN = '$fechaFin', 
        ID_AREA_COMUN = $idAreaComun, 
        ID_ESTADO_RESERVA = $idEstadoReserva, 
        OBSERVACION_ENTREGA = '$observacionEntrega', 
        OBSERVACION_RECIBE = '$observacionRecibe', 
        VALOR = $valor 
        WHERE ID = $id";

        if ($this->conexion->query($queryActualizar) === TRUE) {
            if ($this->conexion->affected_rows > 0) {
                echo "Actualización realizada correctamente.";
            } else {
                echo "No se realizaron cambios. Verifica que los datos a actualizar sean diferentes.";
            }
        } else {
            echo "Error en la actualización: " . $this->conexion->error;
        }


        // Obtener el correo y el nombre completo del usuario que hizo la reserva
        $queryUsuario = "SELECT u.email, concat(usu.NOMBRE, ' ', usu.APELLIDO) as nombre_completo
                        FROM users u
                        JOIN usuarios usu ON u.usuario_id = usu.ID
                        JOIN reservas r ON r.ID_USUARIO = u.ID
                        WHERE r.ID = ?";
        $resultadoUsuario = $this->ejecutarConsulta($queryUsuario, ["i", $id]);

        if ($resultadoUsuario->num_rows > 0) {
            $usuario = $resultadoUsuario->fetch_assoc();
            $emailUsuario = $usuario['email'];
            $nombreUsuario = $usuario['nombre_completo'];
        } else {
            die("No se encontró el usuario de la reserva.");
        }

        // Enviar correo de confirmación de actualización
        $mail = new PHPMailer(true);

        try {
            // Cargar variables de entorno
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
            $mail->Subject = "Actualización de Reserva";
            $mail->Body = '<html><head><style>' . $styles . '</style></head><body>';
            $mail->Body .= '<div class="container">';
            $mail->Body .= '<h1>Actualización de Reserva</h1>';
            $mail->Body .= '<p>Estimado ' . htmlspecialchars($nombreUsuario) . ',</p>';
            $mail->Body .= '<p>Su reserva ha sido actualizada con éxito. A continuación, encontrará los detalles de su reserva:</p>';
            $mail->Body .= '<p><strong>Fecha de Inicio:</strong> ' . htmlspecialchars($fechaReserva) . '</p>';
            $mail->Body .= '<p><strong>Fecha de Fin:</strong> ' . htmlspecialchars($fechaFin) . '</p>';
            $mail->Body .= '<p><strong>Área Común:</strong> ' . $this->getNombreAreaComun($idAreaComun) . '</p>';
            $mail->Body .= '<p><strong>Observación Entrega:</strong> ' . htmlspecialchars($observacionEntrega ?: 'No disponible') . '</p>';
            $mail->Body .= '<p><strong>Observación Recibe:</strong> ' . htmlspecialchars($observacionRecibe ?: 'No disponible') . '</p>';
            $mail->Body .= '<p><strong>Valor:</strong> ' . htmlspecialchars($valor) . '</p>';
            $mail->Body .= '<p><strong>Estado de Reserva:</strong> ' . $this->getEstadoReserva($idEstadoReserva) . '</p>';
            $mail->Body .= '<p>Gracias por utilizar nuestro servicio.</p>';
            $mail->Body .= '<p>Atentamente,<br>El equipo de Admired</p>';
            $mail->Body .= '</div>';
            $mail->Body .= '</body></html>';

            // Enviar el correo
            $mail->send();
        } catch (Exception $e) {
            echo "El correo no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }

        // Redirigir a la lista de reservas
        header("Location: ?c=reserva&m=index");
        exit();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM reservas WHERE ID = ?";
        $this->ejecutarConsulta($sql, ["i", $id]);
        header("Location: /reservas");
    }
}
