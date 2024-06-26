<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de PQR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Estilos generales -->
    <link rel="stylesheet" href="assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
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
                        <h4 class="page-title">Liquidar Cuota</h4>
                        <div class="col-15">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive mt-2">
                                        <!--btn add-->
                                        <div class="d-flex">
                                            <button type="button" onclick="window.location.href = '?c=cuota&m=crear';" class="btn btn-success">
                                                <i class="fas fa-plus"></i> Crear Cuota Admin
                                            </button>
                                        </div>
                                        <hr>
                                        <table class="table table-dark table-striped table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>FECHA</th>
                                                    <th>ESTADO</th>
                                                    <th>FECHA_LIMITE</th>
                                                    <th>PRECIO</th>
                                                    <th>FUNCION</th>
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
                                                        <td><?php echo $rows['FECHA']; ?></td>
                                                        <td><?php echo $rows['ESTADO']; ?></td>
                                                        <td><?php echo $rows['FECHA_LIMITE']; ?></td>
                                                        <td><?php echo $rows['PRECIO']; ?></td>
                                                        <td>
                                                            <a href="?c=cuota&m=show&userId=<?php echo $rows['ID']; ?>" class="submit boton1">Ver</a>
                                                            <a href="?c=cuota&m=edit&userId=<?php echo $rows['ID']; ?>" class="submit boton2">Editar</a>
                                                            <a href="?c=cuota&m=delete&userId=<?php echo $cuota['ID']; ?>" class="submit boton3">Eliminar</a>


                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            <tbody id="tbody">

                                                <thead>
                                                    <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>FECHA</th>
                                                    <th>ESTADO</th>
                                                    <th>FECHA_LIMITE</th>
                                                    <th>PRECIO</th>
                                                    <th>FUNCION</th>
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


        <!-- Modal -->
        <div class="modal fade" id="modalApp" tabindex="-1" aria-labelledby="modalAppLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAppLabel">Registrar Cuota Admin/h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para crear usuario -->
                        <form action="?c=cuota&m=crear" method="POST" id="formUser">
                        <div class="mb-3">
                                <label for="fecha" class="form-label">fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" placeholder="Ingrese estado" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_limite" class="form-label">fecha_limite</label>
                                <input type="date" class="form-control" id="fecha_limite" name="fecha_limite" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">precio</label>
                                <input type="email" class="form-control" id="precio" name="precio" placeholder="precio" required>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="submit" id="btnSubmit" form="formUser" class="btn btn-primary">Guardar</button>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
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