<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de PQR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Estilos generales -->
    <link rel="stylesheet" href="./assets/css/index.css">
    <link type="image/x-icon" href="assets/img/logos/logo.png" rel="icon">
    <link type="image/x-icon" href="assets/img/logos/favicon.png" rel="icon">
</head>

<body>
    <div class="container mt-5">
        <h2>Detalles de la PQR</h2>
        <div class="card">
            <div class="card-body">
                <p>ID: <?php echo htmlspecialchars($user['ID'] ?? ''); ?></p>

                <p>Estado: <?php echo htmlspecialchars($user['Estado'] ?? ''); ?></p>
                <p>Usuario: <?php echo htmlspecialchars($user['Usuario'] ?? ''); ?></p>
                <p>Tipo de PQR: <?php echo htmlspecialchars($user['Tipo de PQR'] ?? ''); ?></p>
                <p>Fecha de Solicitud: <?php echo htmlspecialchars($user['Fecha de Solicitud'] ?? ''); ?></p>
                <p>Fecha de Respuesta: <?php echo htmlspecialchars($user['Fecha de Respuesta'] ?? ''); ?></p>
                <p>Respuesta: <?php echo htmlspecialchars($user['Respuesta'] ?? ''); ?></p>
                <p>Detalle: <?php echo htmlspecialchars($user['Detalle'] ?? ''); ?></p>
            </div>
        </div>

        <h3 class="mt-4">Responder PQR</h3>
        <form action="?c=pqr&m=respond" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['ID'] ?? ''); ?>">
            <div class="mb-3">
                <button type="submit" name="response" value="Solicitud aceptada" class="btn btn-success">Solicitud
                    aceptada</button>
                <button type="submit" name="response" value="Estamos revisando tu solicitud"
                    class="btn btn-warning">Estamos revisando tu solicitud</button>
            </div>
            <div class="mb-3">
                <label for="customResponse" class="form-label">Respuesta personalizada:</label>
                <textarea id="customResponse" name="customResponse" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="attachments" class="form-label">Adjuntar archivos:</label>
                <input type="file" id="attachments" name="attachments[]" class="form-control" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
        </form>

        <a href="?c=pqr&m=pqr" class="btn btn-primary mt-3">Volver al listado</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="./assets/js/main.js"></script>
</body>

</html>