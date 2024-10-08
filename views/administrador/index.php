<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de PQR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Estilos generales -->
    <link rel="stylesheet" href="./assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
</head>

<body>
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
                                                <button type="button"
                                                    onclick="window.location.href = '?c=administrador&m=create';"
                                                    class="btn btn-success">
                                                    <i class="fas fa-plus"></i> Crear usuario
                                                </button>
                                                <!-- Formulario de búsqueda -->
                                                <form method="GET" action="" class="search-form d-flex"
                                                    onsubmit="return false;">
                                                    <input type="text" class="form-control search-input" id="search"
                                                        name="search" placeholder="Buscar por Documento o Apellido"
                                                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                                        onkeyup="fetchResults()">

                                                </form>
                                            </div>
                                            <hr>
                                            <table class="table table-beige table-striped table-hover">
                                                <thead>
                                                    <tr class="text-center" font-weight="bold">
                                                        <th>ID</th>
                                                        <th>NOMBRE</th>
                                                        <th>APELLIDO</th>
                                                        <th>TIPO DC</th>
                                                        <th>NO DOC</th>
                                                        <th>FECHA NAC</th>
                                                        <th>EMAIL</th>
                                                        <th>CONTRASEÑA</th>
                                                        <th>TELEFONO</th>
                                                        <th>ROL</th>
                                                        <th>TORRE</th>
                                                        <th>APTO</th>
                                                        <th>FUNCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    <?php
    // LOOP TILL END OF DATA
    while ($rows = $resultado->fetch_assoc()) {
        // Usamos las funciones del controlador para convertir los IDs en sus valores de texto
        $tipoDocumento = $this->getTipoDocumento($rows['TIPO_DOCUMENTO_ID']);
        $rol = $this->getRol($rows['ROL_ID']);
    ?>
                                                    <tr class="text-center">
                                                        <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                                                        <td><?php echo $rows['ID']; ?></td>
                                                        <td><?php echo $rows['NOMBRE']; ?></td>
                                                        <td><?php echo $rows['APELLIDO']; ?></td>
                                                        <td><?php echo $tipoDocumento; ?></td>
                                                        <!-- Aquí mostramos el tipo de documento en texto -->
                                                        <td><?php echo $rows['NO_DOCUMENTO']; ?></td>
                                                        <td><?php echo isset($rows['FECHA_NACIMIENTO']) ? $rows['FECHA_NACIMIENTO'] : ''; ?>
                                                        </td>
                                                        <td><?php echo $rows['EMAIL']; ?></td>
                                                        <td><?php echo substr($rows['CONTRASENA'], 0, 20) . '...'; ?>
                                                        </td>
                                                        <td><?php echo $rows['TELEFONO']; ?></td>
                                                        <td><?php echo $rol; ?></td>
                                                        <!-- Aquí mostramos el rol en texto -->
                                                        <td><?php echo $rows['TORRE']; ?></td>
                                                        <td><?php echo $rows['APTO']; ?></td>
                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                <a href="?c=administrador&m=show&userId=<?php echo $rows['ID']; ?>"
                                                                    class="submit boton1">Ver</a>
                                                                <a href="?c=administrador&m=edit&userId=<?php echo $rows['ID']; ?>"
                                                                    class="submit boton2">Editar</a>
                                                                <a href="?c=administrador&m=destroy&userId=<?php echo $rows['ID']; ?>"
                                                                    class="submit boton3">Eliminar</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
    }
    ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            </div> <!-- end container-fluid -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalApp" tabindex="-1" aria-labelledby="modalAppLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAppLabel">Registrar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para crear usuario -->
                    <form action="?c=administrador&m=create" method="POST" id="formUser">
                        <div class="table-responsive mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Ingrese su Nombre" required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido"
                                placeholder="Ingrese su Apellido" required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                            <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                                <option value="1">C.C.</option>
                                <option value="2">C.E.</option>
                                <option value="3">NIT</option>
                            </select>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="no_documento" class="form-label">Número de Documento</label>
                            <input type="text" class="form-control" id="no_documento" name="no_documento"
                                placeholder="Ingrese su Número de Documento" required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Ingrese su Correo Electrónico" required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena"
                                placeholder="Ingrese su Contraseña" required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                placeholder="Ingrese su Número de Teléfono" required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="cargo" class="form-label">Cargo</label>
                            <select class="table-responsive mb-2" id="cargo" name="cargo" required>
                                <option value="1">Propietario</option>
                                <option value="2">Residente</option>
                            </select>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="torre" class="form-label">Torre</label>
                            <input type="text" class="form-control" id="torre" name="torre"
                                placeholder="Ingrese su Torre" required>
                        </div>
                        <div class="table-responsive mb-2">
                            <label for="apto" class="form-label">Apartamento</label>
                            <input type="text" class="form-control" id="apto" name="apto"
                                placeholder="Ingrese su Apartamento" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Preloader -->
    <script>
    window.onload = function() {
        document.getElementById("preload").style.display = "none";
    };
    </script>

    <!-- Lógica de búsqueda -->
    <script>
    function fetchResults() {
        const searchQuery = document.getElementById("search").value.toLowerCase();
        const rows = document.querySelectorAll("#tbody tr");

        rows.forEach(row => {
            const cells = row.querySelectorAll("td");
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(" ");
            row.style.display = rowText.includes(searchQuery) ? "" : "none";
        });
    }
    </script>
</body>

</html>