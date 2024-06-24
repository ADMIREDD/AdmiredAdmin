<link rel="stylesheet" href="assets/css/destroy.css">

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">Registrar Nuevo Usuario</h2>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="?c=administrador&m=index" class="btn btn-success">Voler</a>
                                                <section class="form-register">
                                                    <form action="?c=administrador&m=index" method="post">
                                                        <div class="table-responsive mt-2">
                                                            <table class="table table-border table-hover striped">

                                                                <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre" required>
                                                                <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" required>
                                                                <select name="tipo_documento" required>
                                                                    <option value="1">C.C.</option>
                                                                    <option value="2">C.E.</option>
                                                                    <option value="3">NIT.</option>
                                                                </select>
                                                                <input class="controls" type="text" name="no_documento" id="no_documento" placeholder="Ingrese su Número de Documento" required>
                                                                <input class="controls" type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingrese su Fecha de Nacimiento" required>
                                                                <input class="controls" type="email" name="email" id="email" placeholder="Ingrese su Correo Electrónico" required>
                                                                <input type="password" name="contrasena" placeholder="Contraseña" required>
                                                                <input class="controls" type="text" name="telefono" id="telefono" placeholder="Ingrese su Número de Teléfono" required>
                                                                <select name="cargo" required>
                                                                    <option value="1">Empleado</option>
                                                                    <option value="3">Propietario</option>
                                                                    <option value="4">Residente</option>
                                                                </select>
                                                                <input class="controls" type="text" name="torre" id="torre" placeholder="Ingrese su Torre" required>
                                                                <input class="controls" type="text" name="apto" id="apto" placeholder="Ingrese su apto" required>

                                                                <input class="botons" type="submit" value="Crear">
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
            </div>
        </div>
    </div>
</div>