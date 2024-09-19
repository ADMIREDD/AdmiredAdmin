<?php

namespace App\Model;

use mysqli;

class UsuarioModel
{
    private $conexion;

    public function __construct()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $bd = "base_proyecto";
        $this->conexion = mysqli_connect($servidor, $usuario, $password, $bd);

        if (!$this->conexion) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM usuarios WHERE ID = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}