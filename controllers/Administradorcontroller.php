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
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }
        return $conexion;
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
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        require_once('views/components/layout/head.php');
        require_once('views/administrador/show.php');
        require_once('views/components/layout/footer.php');
    }

    public function update()
    {
        // Obtener los datos del formulario
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

        // Encriptar la contraseña
        $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

        // Crear la consulta SQL para actualizar el usuario
        $query = "UPDATE usuarios SET NOMBRE = ?, APELLIDO = ?, TIPO_DOCUMENTO_ID = ?, NO_DOCUMENTO = ?, FECHA_NACIMIENTO = ?, EMAIL = ?, CONTRASENA = ?, TELEFONO = ?, ROL_ID = ?, TORRE = ?, APTO = ? WHERE ID = ?";
        $stmt = mysqli_prepare($this->conexion, $query);

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
        }

        // Bind de parámetros
        mysqli_stmt_bind_param($stmt, 'ssiissssissi', $nombre, $apellido, $tipo_documento_id, $no_documento, $fecha_nacimiento, $email, $contrasena_hash, $telefono, $rol_id, $torre, $apto, $userId);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Redirigir al listado de usuarios después de la actualización exitosa
            header("Location: ?c=administrador&m=index");
            exit();
        } else {
            die("Error al actualizar el usuario: " . mysqli_error($this->conexion));
        }
    }


    public function edit()
    {
        // Obtener el ID del usuario desde la URL
        $userId = (int) $_GET['userId'];

        // Crear la consulta SQL para obtener los datos del usuario
        $query = "SELECT * FROM usuarios WHERE ID = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        // Verificar si el usuario existe
        if (!$user) {
            die("Usuario no encontrado");
        }

        // Incluir la vista de edición
        require_once('views/components/layout/head.php');
        require_once('views/administrador/edit.php');
        require_once('views/components/layout/footer.php');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Captura y sanitiza los datos del formulario
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

            // Encriptar la contraseña
            $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);

            // Crear la consulta SQL
            $query = "INSERT INTO usuarios (NOMBRE, APELLIDO, TIPO_DOCUMENTO_ID, NO_DOCUMENTO, FECHA_NACIMIENTO, EMAIL, CONTRASENA, TELEFONO, ROL_ID, TORRE, APTO) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($this->conexion, $query);

            if (!$stmt) {
                die("Error en la preparación de la consulta: " . mysqli_error($this->conexion));
            }

            // Enlazar los parámetros
            mysqli_stmt_bind_param($stmt, 'ssissssssss', $nombre, $apellido, $tipo_documento_id, $no_documento, $fecha_nacimiento, $email, $contrasena_hash, $telefono, $rol_id, $torre, $apto);

            // Ejecutar la consulta
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


    public function destroy()
    {
        $userId = (int) $_GET['userId'];
        $query = "SELECT * FROM usuarios WHERE ID = ?";
        $stmt = mysqli_prepare($this->conexion, $query);
        mysqli_stmt_bind_param($stmt, 'i', $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        require_once('views/components/layout/head.php');
        require_once('views/administrador/destroy.php');
        require_once('views/components/layout/footer.php');
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
                die("Error en la ejecución de la consulta: " . mysqli_stmt_error($stmt));
            }
        } else {
            // Si no es una solicitud POST, redirigir o mostrar un error.
            header("Location: ?c=administrador&m=index");
            exit();
        }
    }
}
