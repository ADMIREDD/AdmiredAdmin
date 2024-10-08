<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/destroy.css">
    <title>Actualizar Cuota Admin</title>
</head>

<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Actualizar Cuota Admin</h4>

                            <section class="form-register">
                                <form action="?c=cuota&m=update&userId=<?php echo $_GET['userId']; ?>" method="post"
                                    class="formulario__register">

                                    <!-- Campo Fecha (solo lectura) -->
                                    <div class="form-group">
                                        <label for="fecha">Fecha:</label>
                                        <input class="controls" type="text" name="fecha" id="fecha"
                                            value="<?php echo htmlspecialchars($cuota['FECHA']); ?>" readonly>
                                    </div>

                                    <!-- Campo Estado (editable) -->
                                    <div class="form-group">
                                        <label for="estado">Estado:</label>
                                        <input class="controls" type="text" name="estado" id="estado"
                                            placeholder="Ingrese el estado"
                                            value="<?php echo htmlspecialchars($cuota['ESTADO']); ?>">
                                    </div>

                                    <!-- Campo Fecha Límite (solo lectura) -->
                                    <div class="form-group">
                                        <label for="fecha_limite">Fecha Límite:</label>
                                        <input class="controls" type="text" name="fecha_limite" id="fecha_limite"
                                            value="<?php echo htmlspecialchars($cuota['FECHA_LIMITE']); ?>" readonly>
                                    </div>

                                    <!-- Campo Precio (editable) -->
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input class="controls" type="text" name="precio" id="precio"
                                            placeholder="Ingrese el precio"
                                            value="<?php echo htmlspecialchars(number_format($cuota['PRECIO'], 2, ',', '.')); ?>">
                                    </div>

                                    <!-- Botones -->
                                    <div class="form-group">
                                        <input class="botons" type="submit" value="Actualizar">
                                        <a href="?c=cuota&m=index" class="btn btn-success">Volver</a>
                                    </div>
                                </form>
                            </section>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>