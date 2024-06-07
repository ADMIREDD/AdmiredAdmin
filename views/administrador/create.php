<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./assets/img/logos/logo.png" />
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/logos/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./assets/css/style.css" rel="stylesheet">
    <title>CREATE USER - LOGIN FIREBASE</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto mt-5 p-2 container-form">
                <h3 class="text-center mt-1">CREATE USER</h3>

                <form id="formUser" class="mt-5 p-2 mb-5 ">
                    <div class="form-floating mb-3">
                        <input type="email" minlength="6" maxlength="30" title="Validate the data entered" class="form-control" id="user" placeholder="Enter User" required>
                        <label for="user">User</label>
                    </div>
                    <label for="password">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" minlength="6" maxlength="12" title="Validate the data entered" class="form-control" id="password" data-type="password" placeholder="Enter Password" required>
                        <button class="btn btn-outline-secondary" type="button" id="btn-password"><img src="./assets/img/icons/eye-slash-fill.svg" alt></button>
                    </div>
                    <label for="repeatPassword">Repeat Password</label>
                    <div class="input-group mb-3">
                        <input type="password" minlength="6" maxlength="12" title="Validate the data entered" class="form-control" id="repeatPassword" data-type="password" placeholder="Repeat Password" required>
                        <button class="btn btn-outline-secondary" type="button" id="btn-passwordRP"><img src="./assets/img/icons/eye-slash-fill.svg" alt></button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">SEND</button>
                        <a href="./login.html" class="btn btn-secondary w-100">SIGN IN</button>
                            <a href="./recoverPassword.html" class="link-success">Recover your password</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="./assets/js/user/main.js" type="module"></script>

</body>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/destroy.css">
    <title>Crear Usuario</title>
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
