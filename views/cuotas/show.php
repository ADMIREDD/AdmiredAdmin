<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Cuota Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <div class="container-fluid">
        <div class="container-show-1">
            <h1 class="page-title">Detalles de la Cuota Admin</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-responsive-1">
                        <tr>
                            <th>Fecha Mes</th>
                            <td><?php echo htmlspecialchars($cuota['FECHA_MES']); ?></td>
                        </tr>
                        <tr>
                            <th>Estado</th>
                            <td><?php echo htmlspecialchars($cuota['ESTADO']); ?></td>
                        </tr>
                        <tr>
                            <th>Fecha de Pago</th>
                            <td>
                                <?php
                                echo isset($cuota['FECHA_PAGO']) && !empty($cuota['FECHA_PAGO'])
                                    ? htmlspecialchars(date('Y-m-d', strtotime($cuota['FECHA_PAGO'])))
                                    : 'Fecha no disponible';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Valor</th>
                            <td><?php echo htmlspecialchars(number_format($cuota['VALOR'], 2, ',', '.')); ?> COP</td>
                        </tr>
                    </table>
                    <div class="text-center mt-4">
                        <a href="?c=cuota&m=index" class="btn btn-primary">Volver a la lista de cuotas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>