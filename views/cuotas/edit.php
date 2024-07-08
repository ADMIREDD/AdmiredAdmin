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
                            <h4 class="page-title">Actualiza Cuota Admin</h4>
                            
                            <section class="form-register">
                                <form action="views/dashboard/editUser.php?userId=<?php echo $_GET['userId']; ?>" method="post" class="formulario__register">
                                    <div class="form-group">
                                        <label for="fecha">Fecha:</label>
                                        <input class="controls" type="text" name="fecha" id="fecha" placeholder="Ingrese la fecha" value="<?php echo htmlspecialchars($user['FECHA']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="estado">Estado:</label>
                                        <input class="controls" type="text" name="estado" id="estado" placeholder="Ingrese el estado" value="<?php echo htmlspecialchars($user['ESTADO']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_limite">Fecha Límite:</label>
                                        <input class="controls" type="date" name="fecha_limite" id="fecha_limite" placeholder="Ingrese la fecha límite" value="<?php echo htmlspecialchars($user['FECHA_LIMITE']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input class="controls" type="text" name="precio" id="precio" placeholder="Ingrese el precio" value="<?php echo htmlspecialchars($user['PRECIO']) ?>">
                                    </div>
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