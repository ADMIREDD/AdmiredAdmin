<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
    <script>
        // Función para buscar reservas por nombre de usuario
        function buscarReservas() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                const nombreUsuario = row.cells[4].textContent.toLowerCase(); // La celda del nombre de usuario
                row.style.display = nombreUsuario.includes(searchInput) ? "" : "none";
            });
        }
    </script>
</head>

<body>

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Reservas</h4>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="search-form d-flex justify-content-end mb-3">
                                    <input type="text" id="searchInput" placeholder="Buscar por nombre de usuario"
                                        oninput="buscarReservas()" class="search-input" style="width: 300px;">
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th>ID</th>
                                                <th>FECHA RESERVA</th>
                                                <th>FECHA FIN</th>
                                                <th>ÁREA COMÚN</th>
                                                <th>USUARIO</th>
                                                <th>ESTADO RESERVA</th>
                                                <th>OBSERVACIÓN ENTREGA</th>
                                                <th>OBSERVACIÓN RECIBE</th>
                                                <th>VALOR</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($reservas as $reserva): ?>
                                                <tr class="text-center">
                                                    <td><?php echo $reserva['ID']; ?></td>
                                                    <td><?php echo $reserva['Fecha Reserva']; ?></td>
                                                    <td><?php echo $reserva['Fecha Fin']; ?></td>
                                                    <td><?php echo $reserva['Nombre Area']; ?></td>
                                                    <td><?php echo $reserva['Nombre Usuario']; ?></td>
                                                    <td><?php echo $reserva['Estado Texto']; ?></td>
                                                    <td><?php echo $reserva['Observación Entrega']; ?></td>
                                                    <td><?php echo $reserva['Observación Recibe']; ?></td>
                                                    <td><?php echo $reserva['Valor']; ?></td>
                                                    <td>
                                                        <a href="?c=reserva&m=show&id=<?php echo $reserva['ID']; ?>"
                                                            class="submit boton1">Ver</a>
                                                        <a href="?c=reserva&m=edit&id=<?php echo $reserva['ID']; ?>"
                                                            class="submit boton2">Editar</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>