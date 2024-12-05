<?php
// Mostrar mensaje de error si existe
if (isset($error_message)) {
    echo "<div class='alert alert-danger'>" . htmlspecialchars($error_message) . "</div>";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cuota Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/destroy.css">
</head>

<body>
    <div class="container-fluid">
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- Start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h2 class="page-title">Registrar Cuota Admin</h2>
                                <div class="card">
                                    <div class="card-body">
                                        <a href="?c=cuota&m=index" class="btn btn-success mb-3">Volver</a>
                                        <section class="form-register">
                                            <form action="?c=cuota&m=crear" method="post">
                                                <div class="table-responsive mt-2">
                                                    <table class="table table-border table-hover striped">
                                                        <tr>
                                                            <td>
                                                                <input class="form-control" type="date" name="fecha"
                                                                    id="fecha" placeholder="Ingrese la fecha" required>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text" name="estado"
                                                                    id="estado" placeholder="Ingrese el estado"
                                                                    required>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input class="form-control" type="date"
                                                                    name="fecha_pago" id="fecha_pago"
                                                                    placeholder="Ingrese la fecha de pago">
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="number" step="0.01"
                                                                    name="valor" id="valor"
                                                                    placeholder="Ingrese el valor" required>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input class="form-control" type="text" name="no_apto"
                                                                    id="no_apto"
                                                                    placeholder="Ingrese el número de apartamento"
                                                                    required>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="unidad_residencial_id"
                                                                    id="unidad_residencial_id"
                                                                    placeholder="Ingrese la unidad residencial"
                                                                    required>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="usuario_id" id="usuario_id"
                                                                    placeholder="Ingrese el ID del usuario" required>
                                                            </td>
                                                            <td>
                                                                <input class="btn btn-primary" type="submit"
                                                                    value="Crear">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End container-fluid -->
            </div> <!-- End content -->
        </div> <!-- End content-page -->
    </div> <!-- End container-fluid -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>