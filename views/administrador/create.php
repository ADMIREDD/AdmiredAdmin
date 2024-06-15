<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/destroy.css">
    <title>Crear Usuarios</title>
</head>
<body>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Registrar nuevo usuario</h4>
                            <a href="?c=administrador&m=index" class="btn btn-success">Volver</a>
                            <section class="form-register">
                                <form action="views/dashboard/DB2.php" method="post" class="formulario__register">
                                    <h3>Crear Usuario</h3>
                                    <label for="nombre">Nombre</label>
                                    <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre" required>
                                    <label for="apellido">Apellido</label>
                                    <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" required>
                                    <label for="tipo_documento">Tipo de Documento</label>
                                    <select name="tipo_documento" id="tipo_documento" required>
                                        <option value="1">C.C.</option>
                                        <option value="2">C.E.</option>
                                        <option value="3">NIT</option>
                                    </select>
                                    <label for="no_documento">Número de Documento</label>
                                    <input class="controls" type="text" name="no_documento" id="no_documento" placeholder="Ingrese su Número de Documento" required>
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input class="controls" type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingrese su Fecha de Nacimiento" required>
                                    <label for="email">Correo Electrónico</label>
                                    <input class="controls" type="email" name="email" id="email" placeholder="Ingrese su Correo Electrónico" required>
                                    <label for="contrasena">Contraseña</label>
                                    <input class="controls" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su Contraseña" required>
                                    <label for="telefono">Teléfono</label>
                                    <input class="controls" type="text" name="telefono" id="telefono" placeholder="Ingrese su Número de Teléfono" required>
                                    <label for="cargo">Cargo</label>
                                    <select name="cargo" id="cargo" required>
                                        <option value="1">Empleado</option>
                                        <option value="3">Propietario</option>
                                        <option value="4">Residente</option>
                                    </select>
                                    <label for="torre">Torre</label>
                                    <input class="controls" type="text" name="torre" id="torre" placeholder="Ingrese su Torre" required>
                                    <label for="apto">Apartamento</label>
                                    <input class="controls" type="text" name="apto" id="apto" placeholder="Ingrese su Apartamento" required>
                                    <input class="botons" type="submit" value="Crear">
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
