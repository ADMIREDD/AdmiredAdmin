
<link rel="stylesheet" href="../../assets/css/index.css">
=======
<!-- <head>-->
<link type="image/x-icon" href="../assets/img/logos/logo.png" rel="icon">
<!--Bootstrap css-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--My style css-->
<link href="./assets/css/style.css" rel="stylesheet">
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
                                            <button type="button" onclick="createUser()" class="btn btn-success"><img
                                                    class="img img-fluid" src="./assets/img/icons/plus-square-fill.svg">
                                                Crear usuario</button>
                                        </div>
                                        <hr>
                                        <table class="table table-dark table-striped table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>NOMBRE</th>
                                                    <th>APELLIDO</th>
                                                    <th>USUARIO</th>
                                                    <th>TIPO_DOCUMENTO_ID</th>
                                                    <th>NO_DOCUMENTO</th>
                                                    <th>FECHA_NACIMIENTO</th>
                                                    <th>EMAIL</th>                                
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
                                                        <td><?php echo $rows['USUARIO']; ?></td>
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
                                                        <a href="?c=administrador&m=edit&userId=<?php echo $rows['ID']; ?>" class="boton2">Editar</a>
                                                        <a href="?c=administrador&m=destroy&userId=<?php echo $rows['ID']; ?>" class="boton3">Eliminar</a>



                                            <tbody id="tbody">

                                            
                                            <thead>
                                                <tr class="text-center">
                                                    <th>ID</th>
                                                    <th>NOMBRE</th>
                                                    <th>APELLIDO</th>
                                                    <th>USUARIO</th>
                                                    <th>TIPO_DOCUMENTO_ID</th>
                                                    <th>NO_DOCUMENTO</th>
                                                    <th>FECHA_NACIMIENTO</th>
                                                    <th>EMAIL</th> 
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

        <!--Container modal-->
        <!-- Modal -->
        <div class="modal fade" id="modalApp" tabindex="-1" 
          aria-labelledby="modalAppLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAppLabel">USER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" 
                          aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form -->
                        <form action id="formUser">
                        <input type="hidden" class="form-control" id="id" value>
                            <div class="form-floating mb-3">
                            <input class="controls" type="text" name="nombre" id="nombre"
                                placeholder="Ingrese su nombre">
                            </div>
                            <div class="form-floating mb-3">
                            <input class="controls" type="text" name="apellido" id="apellido"
                                placeholder="Ingrese su Apellido">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="usuario" placeholder="usuario" required>
                                <label for="name">Ingrese su usuario</label>
                            </div>
                            <div class="form-floating mb-3" id="tipo_documento_id">
                                <select name="tipo_documento">
                                <option value="1">C.C.</option>
                                <option value="2">C.E.</option>
                                <option value="3">NIT.</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="no_documento" placeholder="documento" required>
                                <label for="name">ingrese su documento</label>
                            </div>
                            <div class="form-floating mb-3">
                            <input type="date" class="controls" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Ingrese su Fecha de Nacimiento">
                            </div>
                                <input type="text" class="form-control" id="email" placeholder="ingrese su correo" required>

                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="telefono" placeholder="in grese su telefono" required>
                                <label for="name">ingrese su telefono</label>
                            </div>
                            <div class="form-floating mb-3" id="cargo_id">
                                <select name="cargo">
                                <option value="1">Empleado</option>                             
                                <option value="3">Propietario</option>
                                <option value="3">Residente</option>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="torre" placeholder="torre" required>
                                <label for="name">torre</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="apto" placeholder="apto" required>
                                <label for="name">apto</label>
                            </div>
                            </div>
                        </form>
                        <!-- End Form -->
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="btnSubmit" form="formUser" class="btn btn-primary">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
<!--Container modal-->

</div> <!-- end content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<!--Script RFC4122-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
<!--Script my script-->
<script src="./assets/js/FirebaseGame.js"></script>
<!--Script my script-->
<script src="./assets/js/main.js"></script>
</div>