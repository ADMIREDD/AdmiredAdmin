<link rel="stylesheet" href="assets/css/destroy.css">
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">Modificar Usuario</h2>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="?c=administrador&m=index" class="btn btn-success">Volver</a>
                                                <section class="form-register">
                                                    <form action="?c=administrador&m=update" method="post">
                                                        <div class="table-responsive mt-2">
                                                            <table class="table table-border table-hover striped">
                                                                <input type="hidden" name="userId"
                                                                    value="<?php echo htmlspecialchars($user['ID']); ?>">
                                                                <tr>
                                                                    <td><input class="controls" type="text"
                                                                            name="nombre"
                                                                            value="<?php echo htmlspecialchars($user['NOMBRE']); ?>"
                                                                            placeholder="Ingrese su Nombre" required>
                                                                    </td>
                                                                    <td><input class="controls" type="text"
                                                                            name="apellido"
                                                                            value="<?php echo htmlspecialchars($user['APELLIDO']); ?>"
                                                                            placeholder="Ingrese su Apellido" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select class="controls" name="tipo_documento"
                                                                            required>
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
                                                                            name="no_documento"
                                                                            value="<?php echo htmlspecialchars($user['NO_DOCUMENTO']); ?>"
                                                                            placeholder="Ingrese su Número de Documento"
                                                                            required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="date"
                                                                            name="fecha_nacimiento"
                                                                            value="<?php echo htmlspecialchars($user['FECHA_NACIMIENTO']); ?>"
                                                                            required></td>
                                                                    <td><input class="controls" type="email"
                                                                            name="email"
                                                                            value="<?php echo htmlspecialchars($user['EMAIL']); ?>"
                                                                            placeholder="Ingrese su Correo Electrónico"
                                                                            required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="password"
                                                                            name="contrasena"
                                                                            value="<?php echo htmlspecialchars($user['CONTRASENA']); ?>"
                                                                            placeholder="Contraseña"></td>
                                                                    <td><input class="controls" type="text"
                                                                            name="telefono"
                                                                            value="<?php echo htmlspecialchars($user['TELEFONO']); ?>"
                                                                            placeholder="Ingrese su Número de Teléfono"
                                                                            required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select class="controls" name="rol_id" required>
                                                                            <option value="1"
                                                                                <?php if ($user['ROL_ID'] == 3) echo 'selected'; ?>>
                                                                                Propietario</option>
                                                                            <option value="2"
                                                                                <?php if ($user['ROL_ID'] == 4) echo 'selected'; ?>>
                                                                                Residente</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input class="controls" type="text" name="torre"
                                                                            value="<?php echo htmlspecialchars($user['TORRE']); ?>"
                                                                            placeholder="Ingrese su Torre" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="text" name="apto"
                                                                            value="<?php echo htmlspecialchars($user['APTO']); ?>"
                                                                            placeholder="Ingrese su apto" required></td>
                                                                    <td><input class="botons" type="submit"
                                                                            value="Actualizar"></td>
                                                                </tr>
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