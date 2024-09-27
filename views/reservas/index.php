<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
</head>

<body>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Reservas</h4>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-end mb-3">

                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>FECHA RESERVA</th>
                                                <th>AREA COMUN</th>
                                                <th>ESTADO RESERVA</th>
                                                <th>USUARIO</th>
                                                <th>OBSERVACION ENTREGA</th>
                                                <th>OBSERVACION RECIBE</th>
                                                <th>VALOR</th>
                                                <th>FUNCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($reservas)) { ?>
                                                <tr>
                                                    <td colspan="8">No se encontraron reservas.</td>
                                                </tr>
                                                <?php } else {
                                                foreach ($reservas as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row['ID']; ?></td>
                                                        <td><?php echo $row['Fecha Reserva']; ?></td>
                                                        <td><?php echo $row['Área Común']; ?></td>
                                                        <td><?php echo $row['Estado Reserva']; ?></td>
                                                        <td><?php echo $row['Usuario']; ?></td>
                                                        <td><?php echo $row['Observación Entrega']; ?></td>
                                                        <td><?php echo $row['Observación Recibe']; ?></td>
                                                        <td><?php echo $row['Valor']; ?></td>
                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                <a href="?c=reserva&m=show&userId=<?php echo $row['ID']; ?>"
                                                                    class="submit boton1">Ver</a>
                                                                <a href="?c=reserva&m=edit&userId=<?php echo $row['ID']; ?>"
                                                                    class="submit boton2">Editar</a>
                                                                <a href="?c=reserva&m=delete&userId=<?php echo $row['ID']; ?>"
                                                                    class="submit boton3">Eliminar</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="./assets/js/main.js"></script>
    </div>
</body>

</html>