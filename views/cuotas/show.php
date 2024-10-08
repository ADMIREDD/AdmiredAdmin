<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/destroy.css">
    <title>Detalles Cuota Admin</title>
</head>

<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Detalles Cuota Admin</h4>
                        </div>
                        <section class="form-register">
                            <form method="post" class="formulario__register">
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha Mes</label>
                                    <input type="text" class="form-control" id="fecha"
                                        value="<?php echo htmlspecialchars($cuota['FECHA_MES']); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <input type="text" class="form-control" id="estado"
                                        value="<?php echo htmlspecialchars($cuota['ESTADO']); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha_limite" class="form-label">Fecha de Pago</label>
                                    <input type="text" class="form-control" id="fecha_limite"
                                        value="<?php echo htmlspecialchars(date('d-m-Y', strtotime($cuota['FECHA_PAGO']))); ?>"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="text" class="form-control" id="precio"
                                        value="<?php echo htmlspecialchars(number_format($cuota['VALOR'], 2, ',', '.')); ?> COP"
                                        readonly>
                                </div>
                                <a href="?c=cuota&m=index" class="btn btn-success">Volver</a>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>