<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class AdministradorController
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = $this->connect();
    }

    private function connect()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $conexion = mysqli_connect($servidor, $usuario, $password, $bd);
        if (mysqli_connect_errno()) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }
        return $conexion;
    }

    // Convertir TIPO_DOCUMENTO_ID a texto
    private function getTipoDocumento($tipoDocumentoId)
    {
        switch ($tipoDocumentoId) {
            case 1:
                return 'C.C.';
            case 2:
                return 'C.E.';
            case 3:
                return 'NIT';
            default:
                return 'Desconocido';
        }
    }

    // Convertir ROL_ID a texto
    private function getRol($rolId)
    {
        switch ($rolId) {
            case 1:
                return 'Propietario';
            case 2:
                return 'Residente';
            default:
                return 'Desconocido';
        }
    }

    public function index()
    {
        $query = "SELECT * FROM usuarios";
        $resultado = mysqli_query($this->conexion, $query);
        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($this->conexion));
        }
        require_once('views/components/layout/head.php');
        require_once('views/administrador/index.php');
        require_once('views/components/layout/footer.php');
    }

    public function show()
    {
        $userId = (int) $_GET['userId'];
        $query = "SELECT * FROM usuarios WHERE ID = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
        }
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            die("Usuario no encontrado");
        }

        require_once('views/components/layout/head.php');
        require_once('views/administrador/show.php');
        require_once('views/components/layout/footer.php');
    }

    public function update()
    {
        $userId = (int) $_POST['userId'];
        $nombre = mysqli_real_escape_string($this->conexion, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($this->conexion, $_POST['apellido']);
        $tipo_documento_id = (int) $_POST['tipo_documento'];
        $no_documento = mysqli_real_escape_string($this->conexion, $_POST['no_documento']);
        $fecha_nacimiento = mysqli_real_escape_string($this->conexion, $_POST['fecha_nacimiento']);
        $email = mysqli_real_escape_string($this->conexion, $_POST['email']);
        $contrasena = mysqli_real_escape_string($this->conexion, $_POST['contrasena']);
        $telefono = mysqli_real_escape_string($this->conexion, $_POST['telefono']);
        $rol_id = (int) $_POST['rol_id'];
        $torre = mysqli_real_escape_string($this->conexion, $_POST['torre']);
        $apto = mysqli_real_escape_string($this->conexion, $_POST['apto']);

        $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

        $query = "UPDATE usuarios SET NOMBRE = ?, APELLIDO = ?, TIPO_DOCUMENTO_ID = ?, NO_DOCUMENTO = ?, FECHA_NACIMIENTO = ?, EMAIL = ?, CONTRASENA = ?, TELEFONO = ?, ROL_ID = ?, TORRE = ?, APTO = ? WHERE ID = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
        }
        mysqli_stmt_bind_param($stmt, 'ssiissssissi', $nombre, $apellido, $tipo_documento_id, $no_documento, $fecha_nacimiento, $email, $contrasena_hash, $telefono, $rol_id, $torre, $apto, $userId);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ?c=administrador&m=index");
            exit();
        } else {
            die("Error al actualizar el usuario: " . mysqli_error($this->conexion));
        }
    }

    public function edit()
    {
        $userId = (int) $_GET['userId'];

        $query = "SELECT * FROM usuarios WHERE ID = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
        }
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            die("Usuario no encontrado");
        }

        require_once('views/components/layout/head.php');
        require_once('views/administrador/edit.php');
        require_once('views/components/layout/footer.php');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = mysqli_real_escape_string($this->conexion, $_POST['nombre']);
            $apellido = mysqli_real_escape_string($this->conexion, $_POST['apellido']);
            $tipo_documento_id = (int) $_POST['tipo_documento'];
            $no_documento = mysqli_real_escape_string($this->conexion, $_POST['no_documento']);
            $fecha_nacimiento = mysqli_real_escape_string($this->conexion, $_POST['fecha_nacimiento']);
            $email = mysqli_real_escape_string($this->conexion, $_POST['email']);
            $contrasena = mysqli_real_escape_string($this->conexion, $_POST['contrasena']);
            $telefono = mysqli_real_escape_string($this->conexion, $_POST['telefono']);
            $rol_id = (int) $_POST['rol_id'];
            $torre = mysqli_real_escape_string($this->conexion, $_POST['torre']);
            $apto = mysqli_real_escape_string($this->conexion, $_POST['apto']);

            // Verificar si el número de documento ya existe
            $query = "SELECT * FROM usuarios WHERE NO_DOCUMENTO = ?";
            $stmt = mysqli_prepare($this->conexion, $query);
            if (!$stmt) {
                die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 's', $no_documento);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $error_message = "El número de documento ya está registrado. Por favor, use otro número.";
                require_once('views/components/layout/head.php');
                require_once('views/administrador/create.php');
                require_once('views/components/layout/footer.php');
                return;
            }

            // Verificar si el correo ya existe
            $query = "SELECT * FROM usuarios WHERE EMAIL = ?";
            $stmt = mysqli_prepare($this->conexion, $query);
            if (!$stmt) {
                die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $error_message = "El correo electrónico ya está registrado. Por favor, use otro correo.";
                require_once('views/components/layout/head.php');
                require_once('views/administrador/create.php');
                require_once('views/components/layout/footer.php');
                return;
            }

            // Verificar si el número de teléfono ya existe
            $query = "SELECT * FROM usuarios WHERE TELEFONO = ?";
            $stmt = mysqli_prepare($this->conexion, $query);
            if (!$stmt) {
                die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 's', $telefono);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $error_message = "El número de teléfono ya está registrado. Por favor, use otro número.";
                require_once('views/components/layout/head.php');
                require_once('views/administrador/create.php');
                require_once('views/components/layout/footer.php');
                return;
            }

            // Si no hay duplicados, proceder con la inserción
            $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

            $query = "INSERT INTO usuarios (NOMBRE, APELLIDO, TIPO_DOCUMENTO_ID, NO_DOCUMENTO, FECHA_NACIMIENTO, EMAIL, CONTRASENA, TELEFONO, ROL_ID, TORRE, APTO) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->conexion, $query);
            if (!$stmt) {
                die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 'ssissssssss', $nombre, $apellido, $tipo_documento_id, $no_documento, $fecha_nacimiento, $email, $contrasena_hash, $telefono, $rol_id, $torre, $apto);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ?c=administrador&m=index");
                exit();
            } else {
                die("Error en la ejecución de la consulta: " . mysqli_stmt_error($stmt));
            }
        } else {
            require_once('views/components/layout/head.php');
            require_once('views/administrador/create.php');
            require_once('views/components/layout/footer.php');
        }
    }



    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = (int) $_POST['userId'];

            $query = "DELETE FROM usuarios WHERE ID = ?";
            $stmt = mysqli_prepare($this->conexion, $query);
            if (!$stmt) {
                die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 'i', $userId);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ?c=administrador&m=index");
                exit();
            } else {
                die("Error al eliminar el usuario: " . mysqli_stmt_error($stmt));
            }
        } else {
            die("Método no permitido");
        }
    }
}
