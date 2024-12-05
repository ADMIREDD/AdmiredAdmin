<?php if (isset($error_message)): ?>
<div class="alert alert-danger">
    <?php echo htmlspecialchars($error_message); ?>
</div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cuota Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <div class="container-fluid">
        <div class="container-show-1">
            <h1 class="page-title">Actualizar Cuota Admin</h1>
            <div class="card">
                <div class="card-body">
                    <form action="?c=cuota&m=update&userId=<?php echo htmlspecialchars($_GET['userId']); ?>"
                        method="post">

                        <!-- Campo Fecha (solo lectura) -->
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input class="form-control" type="text" name="fecha" id="fecha"
                                value="<?php echo htmlspecialchars($cuota['FECHA_MES']); ?>" readonly>
                        </div>

                        <!-- Campo Estado (editable) -->
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <input class="form-control" type="text" name="estado" id="estado"
                                placeholder="Ingrese el estado"
                                value="<?php echo htmlspecialchars($cuota['ESTADO']); ?>" required>
                        </div>

                        <!-- Campo Fecha de Pago -->
                        <div class="mb-3">
                            <label for="fecha_pago" class="form-label">Fecha de Pago:</label>
                            <input class="form-control" type="date" name="fecha_pago" id="fecha_pago"
                                value="<?php echo isset($cuota['FECHA_PAGO']) ? htmlspecialchars($cuota['FECHA_PAGO']) : ''; ?>">
                            <?php if (empty($cuota['FECHA_PAGO'])): ?>
                            <small class="text-muted">No se ha registrado una fecha de pago.</small>
                            <?php endif; ?>
                        </div>

                        <!-- Campo Valor (editable) -->
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor:</label>
                            <input type="number" step="0.01" class="form-control" id="valor" name="valor"
                                placeholder="Ingrese el valor" value="<?php echo htmlspecialchars($cuota['VALOR']); ?>"
                                required>
                        </div>

                        <!-- Botones -->
                        <div class="text-center mt-4">
                            <input class="btn btn-primary boton1" type="submit" value="Actualizar">
                            <a href="?c=cuota&m=index" class="btn btn-secondary boton2">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>