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


    public function index()
    {
        $sql = "SELECT 
                    ID, 
                    FECHA_RESERVA AS 'Fecha Reserva', 
                    ID_AREA_COMUN AS 'Área Común', 
                    ESTADO_RESERVA AS 'Estado Reserva', 
                    ID_USUARIO AS 'Usuario', 
                    OBSERVACION_ENTREGA AS 'Observación Entrega', 
                    OBSERVACION_RECIBE AS 'Observación Recibe', 
                    VALOR AS 'Valor'
                FROM reservas";
        $resultado = $this->conexion->query($sql);

        if ($resultado === FALSE) {
            die("Error en la consulta: " . $this->conexion->error);
        }

        // Pasar el resultado a la vista
        $reservas = $resultado->fetch_all(MYSQLI_ASSOC);

        require_once('views/components/layout/head.php');
        require_once('views/reservas/index.php');
        require_once('views/components/layout/footer.php');
    }

    public function show()
    {
        if (!isset($_GET['ID']) || empty($_GET['ID'])) {
            die("El parámetro ID no está definido.");
        }

        $reservaId = (int)$_GET['ID'];

        $query = "SELECT 
                    ID, 
                    FECHA_RESERVA AS 'Fecha Reserva', 
                    ID_AREA_COMUN AS 'Área Común', 
                    ESTADO_RESERVA AS 'Estado Reserva', 
                    ID_USUARIO AS 'Usuario', 
                    OBSERVACION_ENTREGA AS 'Observación Entrega', 
                    OBSERVACION_RECIBE AS 'Observación Recibe', 
                    VALOR AS 'Valor'
                FROM reservas 
                WHERE ID = $reservaId";

        $result = $this->conexion->query($query);

        if (!$result) {
            die("Error en la consulta SQL: " . $this->conexion->error);
        }

        if ($result->num_rows == 0) {
            die("No se encontró ninguna reserva con el ID especificado.");
        }

        $reserva = $result->fetch_assoc();

        require_once('views/components/layout/head.php');
        require_once('views/reservas/show.php'); // Asegúrate de tener esta vista
        require_once('views/components/layout/footer.php');
    }

    public function delete()
    {
        if (!isset($_GET['ID']) || empty($_GET['ID'])) {
            die("El parámetro ID no está definido.");
        }

        $reservaId = (int)$_GET['ID'];

        $query = "DELETE FROM reservas WHERE ID = $reservaId";

        if ($this->conexion->query($query)) {
            header("Location: ?c=reserva&m=index");
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
