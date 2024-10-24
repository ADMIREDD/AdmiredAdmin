<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de PQR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/logo.png" rel="icon">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
    <script>
    // Función para buscar PQR por nombre de usuario
    function buscarPQR() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            const usuario = row.cells[3].textContent.toLowerCase(); // La celda del nombre de usuario
            row.style.display = usuario.includes(searchInput) ? "" : "none";
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
                            <h4 class="page-title">PQR</h4>
                            <div class="col-15">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive mt-2">
                                            <div class="d-flex justify-content-end mb-3">
                                                <input type="text" class="form-control search-input" id="search"
                                                    name="search" placeholder="Buscar por nombre de usuario"
                                                    oninput="buscarPQR()"
                                                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                            </div>
                                            <hr>
                                            <table class="table table-beige table-striped table-hover">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>ID</th>
                                                        <th>DETALLE</th>
                                                        <th>ESTADO</th>
                                                        <th>USUARIO</th>
                                                        <th>TIPO PQR</th>
                                                        <th>FECHA SOLICITUD</th>
                                                        <th>FECHA RESPUESTA</th>
                                                        <th>RESPUESTA</th>
                                                        <th>FUNCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($resultado) {
                                                        while ($rows = $resultado->fetch_assoc()) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $rows['ID']; ?></td>
                                                        <td><?php echo substr($rows['Detalle'], 0, 20) . '...'; ?></td>
                                                        <td><?php echo $rows['Estado']; ?></td>
                                                        <td><?php echo $rows['Usuario']; ?></td>
                                                        <td><?php echo $rows['Tipo de PQR']; ?></td>
                                                        <td><?php echo $rows['Fecha de Solicitud']; ?></td>
                                                        <td><?php echo $rows['Fecha de Respuesta']; ?></td>
                                                        <td><?php echo substr($rows['Respuesta'], 0, 20) . '...'; ?>
                                                        </td>
                                                        <td>
                                                            <a href="?c=pqr&m=show&id=<?php echo $rows['ID']; ?>"
                                                                class="submit boton1">Ver</a>
                                                            <a href="?c=pqr&m=delete&ID=<?php echo $rows['ID']; ?>"
                                                                class="submit boton3"
                                                                onclick="return confirm('¿Está seguro de eliminar esta PQR?');">Eliminar</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
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
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pb32HFr4npALxGLYPDnM/LoCz8MzOkXMy9QaFzHKIzZwVM28Osl7CTh5cFgq+LhS" crossorigin="anonymous">
    </script>
</body>

</html>