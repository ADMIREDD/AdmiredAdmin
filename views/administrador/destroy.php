<link rel="stylesheet" href="./assets/css/destroy.css">

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Elimina este usuario</h4>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="?c=administrador&m=index" class="btn btn-success">Volver</a>
                                                <section class="form-register">
                                                    <form action="views/dashboard/deleteUser.php" method="post">
                                                        <input type="hidden" name="userId" value="<?php echo $_GET['userId']; ?>">

                                                        <div class="table-responsive mt-2">
                                                            <table class="table table-border table-hover striped">
                                                           
                                                                <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre" value="<?php echo $user['NOMBRE'] ?>" readonly>
                                                                <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" value="<?php echo $user['APELLIDO'] ?>" readonly>
                                                                <select name="tipo_documento" disabled>
                                                                    <option <?php echo $user['TIPO_DOCUMENTO_ID'] == 1 ? 'selected' : '' ?> value="1">C.C.</option>
                                                                    <option <?php echo $user['TIPO_DOCUMENTO_ID'] == 2 ? 'selected' : '' ?> value="2">C.E.</option>
                                                                    <option <?php echo $user['TIPO_DOCUMENTO_ID'] == 3 ? 'selected' : '' ?> value="3">NIT.</option>
                                                                </select>
                                                                <input class="controls" type="text" name="no_documento" id="no_documento" placeholder="Ingrese su Nuemero de Documento" value="<?php echo $user['NO_DOCUMENTO'] ?>" readonly>
                                                                <input class="controls" type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingrese su Fecha de Nacimiento" value="<?php echo $user['FECHA_NACIMIENTO'] ?>" readonly>
                                                                <input class="controls" type="email" name="email" id="email" placeholder="Ingrese su Correo Electronico" value="<?php echo $user['EMAIL'] ?>" readonly>
                                                                <input class="controls" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su Contrasena" value="<?php echo $user['CONTRASENA'] ?>" readonly>
                                                                <input class="controls" type="text" name="telefono" id="telefono" placeholder="Ingrese su Numero de telefono" value="<?php echo $user['TELEFONO'] ?>" readonly>
                                                                <select name="cargo" disabled>
                                                                    <option <?php echo $user['CARGO_ID'] == 1 ? 'selected' : '' ?> value="1">empleado</option>
                                                                    <option <?php echo $user['CARGO_ID'] == 2 ? 'selected' : '' ?> value="2">administrador</option>
                                                                    <option <?php echo $user['CARGO_ID'] == 3 ? 'selected' : '' ?> value="3">propietario</option>
                                                                    <option <?php echo $user['CARGO_ID'] == 4 ? 'selected' : '' ?> value="4">residente</option>
                                                                </select>
                                                                <input class="controls" type="text" name="torre" id="torre" placeholder="Ingrese su Torre" value="<?php echo $user['TORRE'] ?>" readonly>
                                                                <input class="controls" type="text" name="apto" id="apto" placeholder="Ingrese su apto" value="<?php echo $user['APTO'] ?>" readonly>

                                                                <input class="botons" type="submit" value="Eliminar" onclick="confirmarEliminacion()">
                                                                <script>
                                                                    function confirmarEliminacion() {
                                                                        if (confirm('¿Estás seguro que quieres eliminar este usuario?')) {
                                                                            // Si el usuario confirma la eliminación, el formulario se enviará
                                                                            document.querySelector('form').submit();
                                                                        } else {
                                                                            // Si el usuario cancela, no se hace nada
                                                                            return false;
                                                                        }
                                                                    }
                                                                </script>
                                                            </table>
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
                </div>
            
