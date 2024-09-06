<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Estilos generales -->
    <link rel="stylesheet" href="assets/css/destroy.css">
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
                            <h2 class="page-title">Detalles del Usuario</h2>
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <a href="?c=administrador&m=index"
                                                        class="btn btn-success">Volver</a>
                                                    <section class="form-register">
                                                        <div class="table-responsive mt-2">
                                                            <table class="table table-border table-hover striped">
                                                                <tr>
                                                                    <td><input class="controls" type="text"
                                                                            value="<?php echo htmlspecialchars($user['NOMBRE']); ?>"
                                                                            readonly></td>
                                                                    <td><input class="controls" type="text"
                                                                            value="<?php echo htmlspecialchars($user['APELLIDO']); ?>"
                                                                            readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select class="controls" disabled>
                                                                            <option value="1"
                                                                                <?php if ($user['TIPO_DOCUMENTO_ID'] == 1) echo 'selected'; ?>>
                                                                                C.C.</option>
                                                                            <option value="2"
                                                                                <?php if ($user['TIPO_DOCUMENTO_ID'] == 2) echo 'selected'; ?>>
                                                                                C.E.</option>
                                                                            <option value="3"
                                                                                <?php if ($user['TIPO_DOCUMENTO_ID'] == 3) echo 'selected'; ?>>
                                                                                NIT.</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input class="controls" type="text"
                                                                            value="<?php echo htmlspecialchars($user['NO_DOCUMENTO']); ?>"
                                                                            readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="date"
                                                                            value="<?php echo htmlspecialchars($user['FECHA_NACIMIENTO']); ?>"
                                                                            readonly></td>
                                                                    <td><input class="controls" type="email"
                                                                            value="<?php echo htmlspecialchars($user['EMAIL']); ?>"
                                                                            readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="password"
                                                                            value="<?php echo htmlspecialchars($user['CONTRASENA']); ?>"
                                                                            readonly></td>
                                                                    <td><input class="controls" type="text"
                                                                            value="<?php echo htmlspecialchars($user['TELEFONO']); ?>"
                                                                            readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select class="controls" disabled>
                                                                            <option value="1"
                                                                                <?php if ($user['ROL_ID'] == 3) echo 'selected'; ?>>
                                                                                Propietario</option>
                                                                            <option value="2"
                                                                                <?php if ($user['ROL_ID'] == 4) echo 'selected'; ?>>
                                                                                Residente</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input class="controls" type="text"
                                                                            value="<?php echo htmlspecialchars($user['TORRE']); ?>"
                                                                            readonly></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="text"
                                                                            value="<?php echo htmlspecialchars($user['APTO']); ?>"
                                                                            readonly></td>
                                                                    <td></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="assets/js/main.js"></script>
</body>

</html>