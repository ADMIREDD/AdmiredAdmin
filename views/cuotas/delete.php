<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cuota de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/destroy.css">
</head>
<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Eliminar Cuota de Administración</h4>
                            <div class="card">
                                <div class="card-body">
                                    <a href="?c=cuota&m=index" class="btn btn-success mb-3">Volver</a>
                                    <section class="form-register">
                                    <form action="?c=cuota&m=delete" method="POST">
    <input type="hidden" name="cuota_id" value="<?php echo $_GET['cuota_id']; ?>">

    <div class="table-responsive mt-2">
        <table class="table table-border table-hover striped">
            <!-- Mostrar los detalles de la cuota -->
            <tr>
                <td>Fecha:</td>
                <td><input class="controls" type="text" name="fecha" id="fecha" value="<?php echo $user['FECHA']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><input class="controls" type="text" name="estado" id="estado" value="<?php echo $user['ESTADO']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Fecha Límite:</td>
                <td><input class="controls" type="date" name="fecha_limite" id="fecha_limite" value="<?php echo $user['FECHA_LIMITE']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Precio:</td>
                <td><input class="controls" type="text" name="precio" id="precio" value="<?php echo $user['PRECIO']; ?>" readonly></td>
            </tr>
            <tr>
                <td colspan="2"><input class="botons" type="submit" value="Eliminar"></td>
            </tr>
        </table>
    </div>
</form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            </div> <!-- end container-fluid -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
