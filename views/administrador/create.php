<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<link rel="stylesheet" href="./assets/css/destroy.css">
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
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
                                                <a href="?c=administrador&m=index" class="btn btn-success">Volver</a>
                                                <section class="form-register">
                                                    <form action="?c=administrador&m=create" method="post">
                                                        <div class="table-responsive mt-2">
                                                            <table class="table table-border table-hover striped">
                                                                <tr>
                                                                    <td><input class="controls" type="text"
                                                                            name="nombre" id="nombre"
                                                                            placeholder="Ingrese su Nombre" required>
                                                                    </td>
                                                                    <td><input class="controls" type="text"
                                                                            name="apellido" id="apellido"
                                                                            placeholder="Ingrese su Apellido" required>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select class="controls" name="tipo_documento"
                                                                            required>
                                                                            <option value="1">C.C.</option>
                                                                            <option value="2">C.E.</option>
                                                                            <option value="3">NIT.</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input class="controls" type="text"
                                                                            name="no_documento" id="no_documento"
                                                                            placeholder="Ingrese su Número de Documento"
                                                                            required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="date"
                                                                            name="fecha_nacimiento"
                                                                            id="fecha_nacimiento" required></td>
                                                                    <td><input class="controls" type="email"
                                                                            name="email" id="email"
                                                                            placeholder="Ingrese su Correo Electrónico"
                                                                            required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="password"
                                                                            name="contrasena" placeholder="Contraseña"
                                                                            required></td>
                                                                    <td><input class="controls" type="text"
                                                                            name="telefono" id="telefono"
                                                                            placeholder="Ingrese su Número de Teléfono"
                                                                            required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <select class="controls" name="rol_id" required>
                                                                            <option value="1">Propietario</option>
                                                                            <option value="2">Residente</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input class="controls" type="text" name="torre"
                                                                            id="torre" placeholder="Ingrese su Torre"
                                                                            required></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input class="controls" type="text" name="apto"
                                                                            id="apto" placeholder="Ingrese su apto"
                                                                            required></td>
                                                                    <td><input class="botons" type="submit"
                                                                            value="Crear"></td>
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