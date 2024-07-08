<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/destroy.css">
    <title>Detalles Pqr</title>
</head>

<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Detalles Pqr</h4>
                            <a href="?c=pqr&m=pqr" class="btn btn-success">Volver</a>
                            <section class="form-register">
                                <form action="views/dashboard/editUser.php?userId=<?php echo $_GET['userId']; ?>"
                                    method="post" class="formulario__register">
                                    <div class="form-group">
                                        <label for="detalle">Mensaje:</label>
                                        <input class="controls" type="text" name="detalle" id="detalle"
                                            placeholder="Ingrese el detalle"
                                            value="<?php echo htmlspecialchars($user['DETALLE']) ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado_id">Estado de la peticion:</label>
                                        <input class="controls" type="text" name="estado_id" id="estado_id"
                                            placeholder="Ingrese el estado id"
                                            value="<?php echo htmlspecialchars($user['ESTADO_ID']) ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="usuario_id">Usuario:</label>
                                        <input class="controls" type="text" name="usuario_id" id="usuario_id"
                                            placeholder="Ingrese el usuario id"
                                            value="<?php echo htmlspecialchars($user['USUARIO_ID']) ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="pqr_tipo">Tipo de peticion:</label>
                                        <input class="controls" type="text" name="pqr_tipo" id="pqr_tipo"
                                            placeholder="Ingrese pqr tipo"
                                            value="<?php echo htmlspecialchars($user['PQR_TIPO']) ?>" disabled>
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