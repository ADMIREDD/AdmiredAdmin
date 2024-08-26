<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de PQR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Estilos generales -->
    <link rel="stylesheet" href="./assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/logo.png" rel="icon">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
</head>

<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">PQR</h4>
                            <div class="col-15">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive mt-2">
                                            <hr>
                                            <table class="table table-beige table-striped table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>ID</th>
                                                        <th>DETALLE</th>
                                                        <th>ESTADO</th>
                                                        <th>USUARIO</th>
                                                        <th>TIPO PQR</th>
                                                        <th>FECHA SOLICITUD</th>
                                                        <th>FECHA RESPUESTA</th>
                                                        <th>RESPUESTA</th>
                                                        <th>FUNCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Verificar si $resultado no es nulo
                                                    if ($resultado) {
                                                        // LOOP TILL END OF DATA
                                                        while ($rows = $resultado->fetch_assoc()) {
                                                    ?>
                                                            <tr>
                                                                <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                                                                <td><?php echo $rows['ID']; ?></td>
                                                                <td><?php echo $rows['Detalle']; ?></td>
                                                                <td><?php echo $rows['Estado']; ?></td>
                                                                <td><?php echo $rows['Usuario']; ?></td>
                                                                <td><?php echo $rows['Tipo de PQR']; ?></td>
                                                                <td><?php echo $rows['Fecha de Solicitud']; ?></td>
                                                                <td><?php echo $rows['Fecha de Respuesta']; ?></td>
                                                                <td><?php echo $rows['Respuesta']; ?></td>
                                                                <td>
                                                                    <div class="d-flex gap-1">
                                                                        <a href="?c=pqr&m=show&userId=<?php echo $rows['ID']; ?>"
                                                                            class="submit boton1">Ver</a>
                                                                        <a href="?c=pqr&m=delete&userId=<?php echo $rows['ID']; ?>"
                                                                            class="submit boton3">Eliminar</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6' class='text-center'>No se encontraron registros.</td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>ID</th>
                                                        <th>DETALLE</th>
                                                        <th>ESTADO</th>
                                                        <th>USUARIO</th>
                                                        <th>TIPO PQR</th>
                                                        <th>FECHA SOLICITUD</th>
                                                        <th>FECHA RESPUESTA</th>
                                                        <th>RESPUESTA</th>
                                                        <th>FUNCIONES</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            </div> <!-- end container-fluid -->
        </div>
    </div>
    <!--Container modal-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!--Script RFC4122-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
    <!--Script my script-->
    <script src="./assets/js/FirebaseGame.js"></script>
    <!--Script my script-->
    <script src="./assets/js/main.js"></script>
</body>

</html>