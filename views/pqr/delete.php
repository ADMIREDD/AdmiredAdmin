<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar PQR</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery y Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Eliminar PQR</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="?c=pqr&m=pqr" class="btn btn-success">Volver</a>

                                <section class="form-register">
                                    <form id="deleteForm" action="?c=pqr&m=delete" method="get">
                                        <input type="hidden" name="userId" value="<?php echo $_GET['userId']; ?>">

                                        <div class="table-responsive mt-2">
                                            <table class="table table-border table-hover striped">
                                                <tr>
                                                    <td>Detalle</td>
                                                    <td><input class="controls" type="text" name="detalle"
                                                            id="detalle" placeholder="Ingrese el detalle"
                                                            value="<?php echo $user['DETALLE']; ?>" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Estado ID</td>
                                                    <td><input class="controls" type="text" name="estado_id"
                                                            id="estado_id" placeholder="Ingrese el estado id"
                                                            value="<?php echo $user['ESTADO_ID']; ?>" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>Usuario ID</td>
                                                    <td><input class="controls" type="text" name="usuario_id"
                                                            id="usuario_id" placeholder="Ingrese usuario id"
                                                            value="<?php echo $user['USUARIO_ID']; ?>" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>PQR Tipo</td>
                                                    <td><input class="controls" type="text" name="pqr_tipo"
                                                            id="pqr_tipo" placeholder="Ingrese pqr tipo"
                                                            value="<?php echo $user['PQR_TIPO']; ?>" readonly></td>
                                                </tr>
                                            </table>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#confirmModal">Eliminar</button>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas eliminar la PQR?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar la confirmación de eliminación -->
    <script>
        $(document).ready(function () {
            $('#confirmDelete').click(function () {
                $('#deleteForm').submit();
            });
        });
    </script>
</body>

</html>