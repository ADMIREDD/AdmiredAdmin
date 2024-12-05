<?php

class CuotaController
{
    private function conectarBD()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $conexion = mysqli_connect($servidor, $usuario, $password, $bd);

        if (mysqli_connect_error()) {
            // Maneja el error de conexión sin mostrar detalles
            return null;
        }

        return $conexion;
    }

    public function index()
    {
        $conexion = $this->conectarBD();
        if (!$conexion) {
            $this->loadView('views/cuotas/index.php', ['error_message' => "No se pudo conectar a la base de datos."]);
            return;
        }

        $query = "SELECT * FROM cuotas_administracion";
        $resultado = mysqli_query($conexion, $query);
        if (!$resultado) {
            $this->loadView('views/cuotas/index.php', ['error_message' => "Error al recuperar las cuotas."]);
            return;
        }

        require_once('views/components/layout/head.php');
        require_once('views/cuotas/index.php');
        require_once('views/components/layout/footer.php');

        mysqli_close($conexion);
    }

    public function show()
    {
        $conexion = $this->conectarBD();
        if (!$conexion) {
            $this->loadView('views/cuotas/show.php', ['error_message' => "No se pudo conectar a la base de datos."]);
            return;
        }

        $cuotaId = mysqli_real_escape_string($conexion, $_GET['userId']);
        $query = "SELECT * FROM cuotas_administracion WHERE ID = $cuotaId";

        $result = mysqli_query($conexion, $query);
        if (!$result) {
            $this->loadView('views/cuotas/show.php', ['error_message' => "Error al buscar la cuota."]);
            return;
        }

        $cuota = $result->fetch_assoc();

        if ($cuota) {
            $this->loadView('views/cuotas/show.php', ['cuota' => $cuota]);
        } else {
            $this->loadView('views/cuotas/show.php', ['error_message' => "Cuota no encontrada."]);
        }

        mysqli_close($conexion);
    }

    public function edit()
    {
        $conexion = $this->conectarBD();
        if (!$conexion) {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "No se pudo conectar a la base de datos."]);
            return;
        }

        if (!isset($_GET['userId'])) {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "ID de cuota no proporcionado."]);
            return;
        }

        $cuotaId = mysqli_real_escape_string($conexion, $_GET['userId']);
        $query = "SELECT * FROM cuotas_administracion WHERE ID = $cuotaId";

        $result = mysqli_query($conexion, $query);
        if (!$result) {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "Error en la consulta."]);
            return;
        }

        $cuota = $result->fetch_assoc();
        if ($cuota) {
            $this->loadView('views/cuotas/edit.php', ['cuota' => $cuota]);
        } else {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "Cuota no encontrada."]);
        }

        mysqli_close($conexion);
    }

    public function update()
    {
        $conexion = $this->conectarBD();
        if (!$conexion) {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "No se pudo conectar a la base de datos."]);
            return;
        }

        if (!isset($_GET['userId'])) {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "ID de cuota no proporcionado."]);
            return;
        }

        $cuotaId = mysqli_real_escape_string($conexion, $_GET['userId']);
        $estado = mysqli_real_escape_string($conexion, $_POST['estado']);
        $valor = mysqli_real_escape_string($conexion, $_POST['valor']);
        $fecha_pago = mysqli_real_escape_string($conexion, $_POST['fecha_pago']);

        // Validar que los datos no estén vacíos
        if (empty($estado) || empty($valor)) {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "Los campos Estado y Valor son obligatorios.", 'cuota' => $_POST]);
            return;
        }

        // Actualizar la cuota
        $query = "UPDATE cuotas_administracion SET ESTADO = '$estado', VALOR = '$valor', FECHA_PAGO = " . ($fecha_pago ? "'$fecha_pago'" : "NULL") . " WHERE ID = $cuotaId";

        if (mysqli_query($conexion, $query)) {
            header("Location: ?c=cuota&m=index");
            exit();
        } else {
            $this->loadView('views/cuotas/edit.php', ['error_message' => "Error al actualizar la cuota.", 'cuota' => $_POST]);
        }

        mysqli_close($conexion);
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conexion = $this->conectarBD();
            if (!$conexion) {
                $this->loadView('views/cuotas/crear.php', ['error_message' => "No se pudo conectar a la base de datos."]);
                return;
            }

            $fecha_mes = mysqli_real_escape_string($conexion, $_POST['fecha']);
            $estado = mysqli_real_escape_string($conexion, $_POST['estado']);
            $valor = mysqli_real_escape_string($conexion, $_POST['valor']);
            $fecha_pago = isset($_POST['fecha_pago']) ? mysqli_real_escape_string($conexion, $_POST['fecha_pago']) : null;
            $no_apto = mysqli_real_escape_string($conexion, $_POST['no_apto']);
            $unidad_residencial_id = mysqli_real_escape_string($conexion, $_POST['unidad_residencial_id']);
            $usuario_id = mysqli_real_escape_string($conexion, $_POST['usuario_id']);

            // Validar que los datos no estén vacíos excepto fecha_pago
            if (empty($fecha_mes) || empty($estado) || empty($valor) || empty($no_apto) || empty($unidad_residencial_id) || empty($usuario_id)) {
                $this->loadView('views/cuotas/crear.php', ['error_message' => "Todos los campos son obligatorios excepto la fecha de pago."]);
                return;
            }

            // Verificar si UNIDAD_RESIDENCIAL_ID existe en la tabla unidades_residenciales
            $checkUnidadQuery = "SELECT COUNT(*) as count FROM unidades_residenciales WHERE ID = '$unidad_residencial_id'";
            $checkResult = mysqli_query($conexion, $checkUnidadQuery);
            $row = mysqli_fetch_assoc($checkResult);

            if ($row['count'] == 0) {
                $this->loadView('views/cuotas/crear.php', ['error_message' => "El ID de la unidad residencial no existe."]);
                return;
            }

            // Construir la consulta de inserción
            $query = "INSERT INTO cuotas_administracion (FECHA_MES, ESTADO, VALOR, NO_APTO, FECHA_PAGO, UNIDAD_RESIDENCIAL_ID, USUARIO_ID) 
                  VALUES ('$fecha_mes', '$estado', '$valor', '$no_apto', " . ($fecha_pago ? "'$fecha_pago'" : "NULL") . ", '$unidad_residencial_id', '$usuario_id')";

            if (mysqli_query($conexion, $query)) {
                header("Location: ?c=cuota&m=index");
                exit();
            } else {
                $this->loadView('views/cuotas/crear.php', ['error_message' => "Error al crear la cuota."]);
            }

            mysqli_close($conexion);
        } else {
            $this->loadView('views/cuotas/crear.php');
        }
    }


    private function loadView($view, $data = [])
    {
        extract($data);
        require_once('views/components/layout/head.php');
        require_once($view);
        require_once('views/components/layout/footer.php');
    }
}
