<?php

namespace App\Model;

use mysqli;

class PqrModel
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

    public function updatePqr($id, $data)
    {
        $query = "UPDATE pqr SET RESPUESTA = ?, FECHA_RESPUESTA = ? WHERE ID = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param('ssi', $data['RESPUESTA'], $data['FECHA_RESPUESTA'], $id);
        $stmt->execute();
    }
}
