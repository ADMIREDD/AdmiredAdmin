
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Tus estilos específicos para los botones -->
    <link href="./assets/css/style.css" rel="stylesheet">

    <!-- Estilos generales -->
    <link rel="stylesheet" href="assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/logo.png" rel="icon">
</head>

<!--Container preload-->
<div class="preload" id="preload">
    <div class="spinner-grow text-primary position-absolute top-50 start-50" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>
<!--Container preload-->

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Listado</h4>
                        <div class="col-15">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive mt-2">
                                        <!--btn add-->
                                        <div class="d-flex">
                                            <button type="button" onclick="createUser()" class="btn btn-success"><img class="img img-fluid" src="assets/img/icons/plus-square-fill.svg">Crear usuario</button>
                                        </div>
                                        <hr>
                                        <table class="table table-dark table-striped table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>NOMBRE</th>
                                                    <th>APELLIDO</th>
                                                    <th>TIPO_DOCUMENTO_ID</th>
                                                    <th>NO_DOCUMENTO</th>
                                                    <th>FECHA_NACIMIENTO</th>
                                                    <th>EMAIL</th>
                                                    <th>CONTRASENA</th>
                                                    <th>TELEFONO</th>
                                                    <th>CARGO_ID</th>
                                                    <th>TORRE</th>
                                                    <th>APTO</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                // LOOP TILL END OF DATA
                                                while ($rows = $resultado->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                                                        <td><?php echo $rows['ID']; ?></td>
                                                        <td><?php echo $rows['NOMBRE']; ?></td>
                                                        <td><?php echo $rows['APELLIDO']; ?></td>
                                                        <td><?php echo $rows['TIPO_DOCUMENTO_ID']; ?></td>
                                                        <td><?php echo $rows['NO_DOCUMENTO']; ?></td>
                                                        <td><?php echo $rows['FECHA_NACIEMIENTO']; ?></td>
                                                        <td><?php echo $rows['EMAIL']; ?></td>
                                                        <td><?php echo $rows['CONTRASENA']; ?></td>
                                                        <td><?php echo $rows['TELEFONO']; ?></td>
                                                        <td><?php echo $rows['CARGO_ID']; ?></td>
                                                        <td><?php echo $rows['TORRE']; ?></td>
                                                        <td><?php echo $rows['APTO']; ?></td>
                                                        <td>
                                                            <a href="?c=administrador&m=show&userId=<?php echo $rows['ID']; ?>" class="submit boton1">Ver</a>
                                                            <a href="?c=administrador&m=edit&userId=<?php echo $rows['ID']; ?>" class="submit boton2">Editar</a>
                                                            <a href="?c=administrador&m=destroy&userId=<?php echo $rows['ID']; ?>" class="submit boton3">Eliminar</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            <tbody id="tbody">

                                                <thead>
                                                    <tr class="text-center">
                                                        <th>ID</th>
                                                        <th>NOMBRE</th>
                                                        <th>APELLIDO</th>
                                                        <th>TIPO_DOCUMENTO_ID</th>
                                                        <th>NO_DOCUMENTO</th>
                                                        <th>FECHA_NACIMIENTO</th>
                                                        <th>EMAIL</th>
                                                        <th>CONTRASENA</th>
                                                        <th>TELEFONO</th>
                                                        <th>CARGO_ID</th>
                                                        <th>TORRE</th>
                                                        <th>APTO</th>
                                                    </tr>
                                                </thead>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->

        </div> <!-- end container-fluid -->


        <div class="modal fade" id="modalApp" tabindex="-1" aria-labelledby="modalAppLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAppLabel">Crear usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form -->
                        <form action="views/dashboard/DB2.php" method="post" id="formUser">
                            <input type="hidden" class="form-control" id="id" name="id" value="">
                            <div class="form-floating mb-3">
                                <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="controls" type="text" name="apellido" id="apellido" placeholder="Ingrese su Apellido" required>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-control" name="tipo_documento" id="tipo_documento" required>
                                    <option value="">Seleccione el tipo de documento</option>
                                    <option value="1">C.C.</option>
                                    <option value="2">C.E.</option>
                                    <option value="3">NIT</option>
                                </select>

                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="no_documento" id="no_documento" placeholder="Ingrese su Documento" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="controls" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingrese su Fecha de Nacimiento" required>
                                <label for="fecha_nacimiento"></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese su Correo" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese su Contraseña" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese su Teléfono" required>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-control" name="cargo" id="cargo" required>
                                    <option value="">Seleccione el cargo</option>
                                    <option value="1">Empleado</option>
                                    <option value="2">Propietario</option>
                                    <option value="3">Residente</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="torre" id="torre" placeholder="Ingrese su Torre" required>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="apto" id="apto" placeholder="Ingrese su Apartamento" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                        <button type="submit" id="btnSubmit" form="formUser" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Container modal-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!--Script RFC4122-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
        <!--Script my script-->
        <script src="./assets/js/FirebaseGame.js"></script>
        <!--Script my script-->
        <script src="./assets/js/main.js"></script>