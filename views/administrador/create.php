implementando-login-crud-firebase
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicons-->
    <link rel="icon" type="image/x-icon" href="./assets/img/logos/logo.png" />
    <link rel="shortcut icon" type="image/x-icon" href="./assets/img/logos/logo.png" />
    <!--Css Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--Css App-->
    <link href="./assets/css/style.css" rel="stylesheet">

    <title>CREATE USER - LOGIN FIREBASE</title>
</head>

<body>

    <!--Container-->
    <div class="container">
        <!--Container Form-->
        <div class="row">
            <div class="col-6 mx-auto mt-5 p-2 container-form">
                <h3 class="text-center mt-1">CREATE USER</h3>

                <form id="formUser" class="mt-5 p-2 mb-5 ">
                    <div class="form-floating mb-3">
                        <input type="email" minlength="6" maxlength="30" title="Validate the data entered"
                            class="form-control" id="user" placeholder="Enter User" required>
                        <label for="user">User</label>
                    </div>
                    <label for="password">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" minlength="6" maxlength="12" title="Validate the data entered"
                            class="form-control" id="password" data-type="password" placeholder="Enter Password"
                            required>
                        <button class="btn btn-outline-secondary" type="button" id="btn-password"><img
                                src="./assets/img/icons/eye-slash-fill.svg" alt></button>
                    </div>
                    <label for="repeatPassword">Repeat Password</label>
                    <div class="input-group mb-3">
                        <input type="password" minlength="6" maxlength="12" title="Validate the data entered"
                            class="form-control" id="repeatPassword" data-type="password" placeholder="Repeat Password"
                            required>
                        <button class="btn btn-outline-secondary" type="button" id="btn-passwordRP"><img
                                src="./assets/img/icons/eye-slash-fill.svg" alt></button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">SEND</button>
                        <a href="./login.html" class="btn btn-secondary w-100">SIGN IN</button>
                            <a href="./recoverPassword.html" class="link-success">Recover your password</a>
                    </div>
                </form>

            </div>
        </div>
        <!--End Container Form-->
    </div>
    <!--End Container-->

    <!--Script bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>

    <!--Script module-->
    <script src="./assets/js/user/main.js" type="module"></script>

</body>

</html>
<link rel="stylesheet" href="./assets/css/destroy.css">
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Crear Usuario</h4>
                        <div class="page-title-box"><a href="?c=administrador&m=index"
                                class="btn btn-success">Volver</a>
                            <section class="form-register">
                                <form action="views/dashboard/DB2.php" method="post" class="formulario__register">
                                <form id="formCreateUser" method="POST" action="?c=user&m=store">

                                    <h3>Crear Usuario</h3>
                                    <input class="controls" type="text" name="nombre" id="nombre"
                                        placeholder="Ingrese su nombre">
                                    <input class="controls" type="text" name="apellido" id="apellido"
                                        placeholder="Ingrese su Apellido">
                                    <select name="tipo_documento">
                                        <option value="1">C.C.</option>
                                        <option value="2">C.E.</option>
                                        <option value="3">NIT.</option>
                                    </select>
                                    <input class="controls" type="text" name="no_documento" id="no_documento"
                                        placeholder="Ingrese su Nuemero de Documento">
                                    <input class="controls" type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                        placeholder="Ingrese su Fecha de Nacimiento">
                                    <input class="controls" type="text" name="email" id="email"
                                        placeholder="Ingrese su Correo Electronico">
                                    <input class="controls" type="char" name="contrasena" id="contrasena"
                                        placeholder="Ingrese su Contrasena">
                                    <input class="controls" type="text" name="telefono" id="telefono"
                                        placeholder="Ingrese su Numero de telefono">
                                    <select name="cargo">
                                        <option value="1">empleado</option>
                                        <option value="3">propietario</option>
                                        <option value="3">residente</option>
                                    </select>
                                    <input class="controls" type="text" name="torre" id="torre"
                                        placeholder="Ingrese su torre">
                                    <input class="controls" type="text" name="apto" id="apto"
                                        placeholder="Ingrese su apto">
                                    <input class="botons" type="submit" value="Crear">
                            </section>
                        </div>
                    </div>
                </div>
            </div>


            <!-- end row -->

        </div> <!-- end container-fluid -->

    </div> <!-- end content -->