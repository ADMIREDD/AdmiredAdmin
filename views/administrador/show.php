<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de PQR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Estilos generales -->
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Detalle de la PQR</h2>
        <div class="card mt-3">
            <div class="card-body">
                <h4>Información de la PQR</h4>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($user['ID']); ?></p>
                <p><strong>Detalle:</strong> <?php echo htmlspecialchars($user['Detalle']); ?></p>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($user['Estado']); ?></p>
                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($user['Usuario']); ?></p>
                <p><strong>Tipo de PQR:</strong> <?php echo htmlspecialchars($user['Tipo de PQR']); ?></p>
                <p><strong>Fecha de Solicitud:</strong> <?php echo htmlspecialchars($user['Fecha de Solicitud']); ?></p>
                <p><strong>Fecha de Respuesta:</strong> <?php echo htmlspecialchars($user['Fecha de Respuesta']); ?></p>
                <p><strong>Respuesta:</strong> <?php echo htmlspecialchars($user['Respuesta']); ?></p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h4>Responder a la PQR</h4>
                <form action="?c=pqr&m=respond" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user['ID']); ?>">

                    <!-- Botones de respuesta rápida -->
                    <div class="mb-3">
                        <button type="submit" name="respuesta" value="Solicitud aceptada" class="btn btn-success">
                            Solicitud aceptada
                        </button>
                        <button type="submit" name="respuesta" value="Estamos revisando tu solicitud"
                            class="btn btn-warning">
                            Estamos revisando tu solicitud
                        </button>
                    </div>

                    <!-- Respuesta personalizada -->
                    <div class="mb-3">
                        <label for="respuestaPersonalizada" class="form-label">Respuesta personalizada:</label>
                        <textarea id="respuestaPersonalizada" name="respuestaPersonalizada" class="form-control"
                            rows="3"></textarea>
                    </div>

                    <!-- Adjuntar archivos -->
                    <div class="mb-3">
                        <label for="adjuntos" class="form-label">Adjuntar archivos:</label>
                        <input type="file" id="adjuntos" name="adjuntos[]" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar respuesta</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>