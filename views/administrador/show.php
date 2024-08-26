<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/destroy.css">
    <title>Detalles de Usuario</title>
</head>

<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Detalles de Usuario</h4>
                            <a href="?c=administrador&m=index" class="btn btn-success">Volver</a>
                            <section class="form-register">
                                <form action="views/dashboard/editUser.php?userId=<?php echo $_GET['userId']; ?>"
                                    method="post" class="formulario__register">
                                    <input class="controls" type="text" name="nombre" id="nombre"
                                        placeholder="Ingrese su Nombre"
                                        value="<?php echo htmlspecialchars($user['NOMBRE']) ?>" disabled>
                                    <input class="controls" type="text" name="apellido" id="apellido"
                                        placeholder="Ingrese su Apellido"
                                        value="<?php echo htmlspecialchars($user['APELLIDO']) ?>" disabled>
                                    <select class="controls" name="tipo_documento" disabled>
                                        <option <?php echo $user['TIPO_DOCUMENTO_ID'] == 1 ? 'selected' : '' ?>
                                            value="1">C.C.</option>
                                        <option <?php echo $user['TIPO_DOCUMENTO_ID'] == 2 ? 'selected' : '' ?>
                                            value="2">C.E.</option>
                                        <option <?php echo $user['TIPO_DOCUMENTO_ID'] == 3 ? 'selected' : '' ?>
                                            value="3">NIT.</option>
                                    </select>
                                    <input class="controls" type="text" name="no_documento" id="no_documento"
                                        placeholder="Ingrese su Número de Documento"
                                        value="<?php echo htmlspecialchars($user['NO_DOCUMENTO']) ?>" disabled>
                                    <input class="controls" type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                        placeholder="Ingrese su Fecha de Nacimiento"
                                        value="<?php echo htmlspecialchars($user['FECHA_NACIMIENTO']) ?>" disabled>
                                    <input class="controls" type="text" name="email" id="email"
                                        placeholder="Ingrese su Correo Electrónico"
                                        value="<?php echo htmlspecialchars($user['EMAIL']) ?>" disabled>
                                    <input class="controls" type="password" name="contrasena" id="contrasena"
                                        placeholder="Ingrese su Contraseña"
                                        value="<?php echo htmlspecialchars($user['CONTRASENA']) ?>" disabled>
                                    <input class="controls" type="text" name="telefono" id="telefono"
                                        placeholder="Ingrese su Número de Teléfono"
                                        value="<?php echo htmlspecialchars($user['TELEFONO']) ?>" disabled>
                                    <select class="controls" name="rol_id" disabled>
                                        <option <?php echo $user['ROL_ID'] == 1 ? 'selected' : '' ?> value="1">
                                            Propietario</option>
                                        <option <?php echo $user['ROL_ID'] == 2 ? 'selected' : '' ?> value="2">Residente
                                        </option>
                                    </select>
                                    <input class="controls" type="text" name="torre" id="torre"
                                        placeholder="Ingrese su Torre"
                                        value="<?php echo htmlspecialchars($user['TORRE']) ?>" disabled>
                                    <input class="controls" type="text" name="apto" id="apto"
                                        placeholder="Ingrese su Apartamento"
                                        value="<?php echo htmlspecialchars($user['APTO']) ?>" disabled>
                                    <a href="?c=administrador&m=index" class="btn btn-success">Volver</a>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>