<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>

    <div class="container-fluid">
        <div class="container-show-1">
            <h1 class="page-title">Detalles de la Reserva</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-responsive-1">
                        <tr>
                            <th>ID</th>
                            <td><?php echo $reserva['ID']; ?></td>
                        </tr>
                        <tr>
                            <th>Fecha Reserva</th>
                            <td><?php echo $reserva['FECHA_RESERVA']; ?></td>
                        </tr>
                        <tr>
                            <th>Fecha Fin</th>
                            <td><?php echo $reserva['FECHA_FIN']; ?></td>
                        </tr>
                        <tr>
                            <th>Área Común</th>
                            <td><?php echo $reserva['Nombre Area']; ?></td>
                        </tr>
                        <tr>
                            <th>Usuario</th>
                            <td><?php echo $reserva['Nombre Usuario'] . ' ' . $reserva['Apellido Usuario']; ?></td>
                        </tr>
                        <tr>
                            <th>Estado Reserva</th>
                            <td><?php echo $reserva['Estado Reserva']; ?></td>
                        </tr>
                        <tr>
                            <th>Observación Entrega</th>
                            <td><?php echo $reserva['OBSERVACION_ENTREGA']; ?></td>
                        </tr>
                        <tr>
                            <th>Observación Recibe</th>
                            <td><?php echo $reserva['OBSERVACION_RECIBE']; ?></td>
                        </tr>
                        <tr>
                            <th>Valor</th>
                            <td><?php echo $reserva['VALOR']; ?></td>
                        </tr>
                    </table>
                    <div class="text-center mt-4">
                        <a href="?c=reserva&m=index" class="btn btn-primary">Volver a la lista de reservas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>