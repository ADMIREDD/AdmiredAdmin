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

    // Obtener el nombre del área común
    public function getNombreAreaComun($idAreaComun)
    {
        $idAreaComun = $this->conexion->real_escape_string($idAreaComun);
        $sql = "SELECT NOMBRE FROM areas_comunes WHERE ID = $idAreaComun";
        $result = $this->conexion->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['NOMBRE'];
        }
        return "Desconocido";
    }

    // Obtener el estado de la reserva
    public function getEstadoReserva($idEstadoReserva)
    {
        $sql = "SELECT DESCRIPCION FROM estados_reserva WHERE ID = $idEstadoReserva";
        $result = $this->conexion->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['DESCRIPCION'];
        }
        return "Desconocido";
    }

    // Obtener el nombre del usuario
    public function getNombreUsuario($idUsuario)
    {
        if (empty($idUsuario)) {
            return "Usuario Desconocido";
        }

        $idUsuario = $this->conexion->real_escape_string($idUsuario);
        $sql = "SELECT CONCAT(NOMBRE, ' ', APELLIDO) AS NOMBRE_COMPLETO FROM usuarios WHERE ID = $idUsuario";
        $result = $this->conexion->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['NOMBRE_COMPLETO'];
        }
        return "Usuario Desconocido";
    }

    // Crear una nueva reserva
    public function createReserva($fechaReserva, $fechaFin, $idAreaComun, $idEstadoReserva, $idUsuario, $observacionEntrega, $observacionRecibe, $valor)
    {
        // Validar si ya existe una reserva en el área común en la misma fecha y hora
        $queryVerificar = "SELECT * FROM reservas 
                           WHERE (FECHA_RESERVA BETWEEN '$fechaReserva' AND '$fechaFin') 
                           AND ID_AREA_COMUN = $idAreaComun 
                           AND ID_ESTADO_RESERVA IN (1, 2)"; // 1 = Pendiente, 2 = Confirmada

        $resultadoVerificacion = $this->conexion->query($queryVerificar);

        // Si existe una reserva en esa fecha y hora para la misma área común, mostrar error
        if ($resultadoVerificacion && $resultadoVerificacion->num_rows > 0) {
            return "Ya existe una reserva en esta fecha y hora para el área común seleccionada.";
        }

        // Si no hay reservas en conflicto, procede a crear la nueva reserva
        $queryInsertar = "INSERT INTO reservas (FECHA_RESERVA, FECHA_FIN, ID_AREA_COMUN, ID_USUARIO, OBSERVACION_ENTREGA, OBSERVACION_RECIBE, VALOR, ID_ESTADO_RESERVA) 
                          VALUES ('$fechaReserva', '$fechaFin', $idAreaComun, $idUsuario, '$observacionEntrega', '$observacionRecibe', $valor, $idEstadoReserva)";

        if ($this->conexion->query($queryInsertar)) {
            return "Reserva creada exitosamente.";
        } else {
            return "Error al crear la reserva: " . $this->conexion->error;
        }
    }

    public function index()
    {
        $sql = "SELECT 
                    ID, 
                    FECHA_RESERVA AS 'Fecha Reserva', 
                    FECHA_FIN AS 'Fecha Fin', 
                    ID_AREA_COMUN AS 'Área Común', 
                    ID_ESTADO_RESERVA AS 'Estado Reserva', 
                    ID_USUARIO AS 'Usuario', 
                    OBSERVACION_ENTREGA AS 'Observación Entrega', 
                    OBSERVACION_RECIBE AS 'Observación Recibe', 
                    VALOR AS 'Valor'
                FROM reservas";
        $resultado = $this->conexion->query($sql);

        if ($resultado === FALSE) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        $reservas = [];
        while ($row = $resultado->fetch_assoc()) {
            $row['Nombre Area'] = $this->getNombreAreaComun($row['Área Común']);
            $row['Estado Texto'] = $this->getEstadoReserva($row['Estado Reserva']);
            $row['Nombre Usuario'] = $this->getNombreUsuario($row['Usuario']);
            $reservas[] = $row;
        }

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
            WHERE r.ID = $id";

        $resultado = $this->conexion->query($sql);
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
                WHERE r.ID = $id";

        $resultado = $this->conexion->query($sql);
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
                       WHERE (FECHA_RESERVA BETWEEN '$fechaReserva' AND '$fechaFin') 
                       AND ID_AREA_COMUN = $idAreaComun 
                       AND ID_ESTADO_RESERVA IN (1, 2) 
                       AND ID != $id"; // Ignorar la reserva actual

        $resultadoVerificacion = $this->conexion->query($queryVerificar);

        if ($resultadoVerificacion && $resultadoVerificacion->num_rows > 0) {
            die("Error: Ya existe una reserva en esta fecha y hora para el área común seleccionada.");
        }

        // Actualizar la reserva en la base de datos
        $queryActualizar = "UPDATE reservas 
                        SET FECHA_RESERVA = '$fechaReserva', 
                            FECHA_FIN = '$fechaFin', 
                            ID_AREA_COMUN = $idAreaComun, 
                            ID_ESTADO_RESERVA = $idEstadoReserva, 
                            OBSERVACION_ENTREGA = '$observacionEntrega', 
                            OBSERVACION_RECIBE = '$observacionRecibe', 
                            VALOR = $valor 
                        WHERE ID = $id";

        if ($this->conexion->query($queryActualizar)) {
            header("Location: ?c=reserva&m=index"); // Redirigir a la lista de reservas
        } else {
            die("Error al actualizar la reserva: " . $this->conexion->error);
        }
    }


    public function __destruct()
    {
        $this->conexion->close();
    }
}
