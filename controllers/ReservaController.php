<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ReservaController
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
        // Inicializar el array de reservas
        $reservas = [];

        // Comprobar si hay una búsqueda
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Consulta para obtener las reservas
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

        // Recoger los resultados
        while ($row = $resultado->fetch_assoc()) {
            $row['Nombre Area'] = $this->getNombreAreaComun($row['Área Común']);
            $row['Estado Texto'] = $this->getEstadoReserva($row['Estado Reserva']);
            $row['Nombre Usuario'] = $this->getNombreUsuario($row['Usuario']);
            $reservas[] = $row;
        }

        // Pasar los datos a la vista
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
                    u.APELLIDO AS 'Apellido Usuario'
                FROM reservas r
                JOIN areas_comunes a ON r.ID_AREA_COMUN = a.ID
                JOIN usuarios u ON r.ID_USUARIO = u.ID
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
        $id = $_GET['id']; // Obtener el ID de la reserva de los parámetros de la URL

        // Recoger los datos del formulario
        $fechaReserva = $_POST['fecha_reserva'];
        $fechaFin = $_POST['fecha_fin'];
        $idAreaComun = $_POST['id_area_comun'];
        $idEstadoReserva = $_POST['id_estado_reserva'];
        $observacionEntrega = $_POST['observacion_entrega'];
        $observacionRecibe = $_POST['observacion_recibe'];
        $valor = $_POST['valor'];

        // Validar si ya existe una reserva en el área común en la misma fecha y hora
        $queryVerificar = "SELECT * FROM reservas 
                   WHERE (FECHA_RESERVA BETWEEN ? AND ?) 
                   AND ID_AREA_COMUN = ? 
                   AND ID_ESTADO_RESERVA IN (1, 2) 
                   AND ID != ?"; // Ignorar la reserva actual

        $resultadoVerificacion = $this->ejecutarConsulta($queryVerificar, ["ssii", $fechaReserva, $fechaFin, $idAreaComun, $id]);

        if ($resultadoVerificacion && $resultadoVerificacion->num_rows > 0) {
            die("Error: Ya existe una reserva en esta fecha y hora para el área común seleccionada.");
        }

        // Actualizar la reserva en la base de datos
        $queryActualizar = "UPDATE reservas SET 
                   FECHA_RESERVA = ?, 
                   FECHA_FIN = ?, 
                   ID_AREA_COMUN = ?, 
                   ID_ESTADO_RESERVA = ?, 
                   OBSERVACION_ENTREGA = ?, 
                   OBSERVACION_RECIBE = ?, 
                   VALOR = ? 
                   WHERE ID = ?";

        $this->ejecutarConsulta($queryActualizar, ["ssiiisdi", $fechaReserva, $fechaFin, $idAreaComun, $idEstadoReserva, $observacionEntrega, $observacionRecibe, $valor, $id]);

        header("Location: /reservas"); // Redirigir a la lista de reservas
    }

    public function delete($id)
    {
        $sql = "DELETE FROM reservas WHERE ID = ?";
        $this->ejecutarConsulta($sql, ["i", $id]);
        header("Location: /reservas"); // Redirigir a la lista de reservas
    }
}
