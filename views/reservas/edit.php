<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>

    <div class="container-fluid">
        <div class="container-show-1">
            <h1 class="page-title">Editar Reserva</h1>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="?c=reserva&m=update&id=<?php echo $reserva['ID']; ?>">
                        <div class="mb-3">
                            <label for="fecha_reserva" class="form-label">Fecha Reserva</label>
                            <input type="datetime-local" class="form-control" id="fecha_reserva" name="fecha_reserva"
                                value="<?php echo $reserva['FECHA_RESERVA']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin"
                                value="<?php echo $reserva['FECHA_FIN']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_area_comun" class="form-label">Área Común</label>
                            <select class="form-select" id="id_area_comun" name="id_area_comun" required>
                                <option value="<?php echo $reserva['ID_AREA_COMUN']; ?>" selected>
                                    <?php echo $reserva['Nombre Area']; ?>
                                </option>
                                <!-- Aquí deberías llenar el resto de las áreas comunes -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_estado_reserva" class="form-label">Estado Reserva</label>
                            <select class="form-select" id="id_estado_reserva" name="id_estado_reserva" required>
                                <option value="<?php echo $reserva['ID_ESTADO_RESERVA']; ?>" selected>
                                    <?php echo $reserva['Estado Reserva']; ?>
                                </option>
                                <option value="1">Pendiente</option>
                                <option value="2">Confirmada</option>
                                <option value="3">Cancelada</option>
                                <option value="4">Finalizada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="observacion_entrega" class="form-label">Observación Entrega</label>
                            <textarea class="form-control" id="observacion_entrega" name="observacion_entrega"
                                rows="3"><?php echo htmlspecialchars($reserva['OBSERVACION_ENTREGA']); ?></textarea>

                        </div>

                        <div class="mb-3">
                            <label for="observacion_recibe" class="form-label">Observación Recibe</label>
                            <textarea class="form-control" id="observacion_recibe" name="observacion_recibe"
                                rows="3"><?php echo $reserva['OBSERVACION_RECIBE']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="number" step="0.01" class="form-control" id="valor" name="valor"
                                value="<?php echo $reserva['VALOR']; ?>" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary boton1">Actualizar Reserva</button>
                            <a href="?c=reserva&m=index" class="btn btn-secondary boton2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>