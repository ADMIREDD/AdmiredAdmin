<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cuotas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
    <script>
    // Función para buscar cuotas por unidad residencial
    function buscarCuota() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            const unidadResidencial = row.cells[6].textContent.toLowerCase(); // La celda de unidad residencial
            row.style.display = unidadResidencial.includes(searchInput) ? "" : "none";
        });
    }
    </script>
</head>

<body>

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
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="search-form d-flex justify-content-end mb-3">
                                    <button type="button" onclick="window.location.href = '?c=cuota&m=crear';"
                                        class="btn btn-success">
                                        <i class="fas fa-plus"></i> Crear Cuota Admin
                                    </button>
                                    <!-- Formulario de búsqueda -->
                                    <form method="GET" action="" class="search-form d-flex" onsubmit="return false;">
                                        <input type="text" class="form-control search-input" id="search" name="search"
                                            placeholder="Buscar por Unidad Residencial"
                                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                            onkeyup="buscarCuota()">
                                    </form>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-beige table-striped table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>FECHA MES</th>
                                                <th>ESTADO</th>
                                                <th>VALOR</th>
                                                <th>NO APTO</th>
                                                <th>FECHA DE PAGO</th>
                                                <th>UNI RESIDENCIAL</th>
                                                <th>FUNCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($rows = $resultado->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $rows['ID']; ?></td>
                                                <td><?php echo $rows['FECHA_MES']; ?></td>
                                                <td><?php echo $rows['ESTADO']; ?></td>
                                                <td><?php echo $rows['VALOR']; ?></td>
                                                <td><?php echo $rows['NO_APTO']; ?></td>
                                                <td><?php echo $rows['FECHA_PAGO']; ?></td>
                                                <td><?php echo $rows['UNIDAD_RESIDENCIAL_ID']; ?></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="?c=cuota&m=show&userId=<?php echo $rows['ID']; ?>"
                                                            class="submit boton1">Ver</a>
                                                        <a href="?c=cuota&m=edit&userId=<?php echo $rows['ID']; ?>"
                                                            class="submit boton2">Editar</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalApp" tabindex="-1" aria-labelledby="modalAppLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAppLabel">Registrar Cuota Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario para crear cuota -->
                                <form action="?c=cuota&m=crear" method="POST" id="formUser">
                                    <div class="mb-3">
                                        <label for="fecha_mes" class="form-label">Fecha Mes</label>
                                        <input type="date" class="form-control" id="fecha_mes" name="fecha_mes"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="estado" class="form-label">Estado</label>
                                        <input type="text" class="form-control" id="estado" name="estado"
                                            placeholder="Ingrese estado" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_limite" class="form-label">Fecha Límite</label>
                                        <input type="date" class="form-control" id="fecha_limite" name="fecha_limite"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="precio" class="form-label">Precio</label>
                                        <input type="text" class="form-control" id="precio" name="precio"
                                            placeholder="Precio" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" id="btnSubmit" form="formUser"
                                            class="btn btn-primary">Guardar</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--Container modal-->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <!--Script RFC4122-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>
        <!--Script my script-->
        <script src="./assets/js/FirebaseGame.js"></script>
        <!--Script my script-->
        <script src="./assets/js/main.js"></script>
    </div>
</body>

</html>