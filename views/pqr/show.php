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
    <title>Detalle de PQR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <div class="container-show text-center">

        <div class="card-body_pqr mx-auto mt-4" style="max-width: 600px;">
            <div class="card-body">
                <h4>Detalles del PQR</h4>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($user['ID'] ?? 'ID no disponible'); ?></p>
                <p><strong>Detalle:</strong> <?php echo htmlspecialchars($user['Detalle'] ?? 'Sin detalles'); ?></p>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($user['Estado'] ?? 'Estado no disponible'); ?>
                </p>
                <p><strong>Usuario:</strong>
                    <?php echo htmlspecialchars($user['UsuarioNombre'] ?? 'Usuario desconocido'); ?></p>
                <p><strong>Tipo de PQR:</strong>
                    <?php echo htmlspecialchars($user['Tipo de PQR'] ?? 'Tipo no disponible'); ?></p>
                <p><strong>Fecha de Solicitud:</strong>
                    <?php echo htmlspecialchars($user['Fecha de Solicitud'] ?? 'Fecha no disponible'); ?></p>
                <p><strong>Fecha de Respuesta:</strong>
                    <?php echo htmlspecialchars($user['Fecha de Respuesta'] ?? 'No hay respuesta aún'); ?></p>
                <p><strong>Archivo Adjunto:</strong>
                    <?php if (!empty($user['Archivo'])): ?>
                    <a href="/SENA/AdmiredLanding/<?php echo $user['Archivo']; ?>" target="_blank"
                        class="btn btn-primary">Descargar</a>
                    <?php else: ?>
                    Sin archivo
                    <?php endif; ?>
                </p>




                <p><strong>Respuesta:</strong>
                    <?php echo htmlspecialchars($user['Respuesta'] ?? 'No hay respuesta aún'); ?></p>




            </div>
        </div>

        <div class="card-body_pqr mt-4 mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h4>Responder a la PQR</h4>
                <form id="responseForm" action="?c=pqr&m=respond" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['ID']); ?>">


                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user['ID']); ?>">




                    <div class="mb-3">
                        <button type="submit" name="estado" value="Solicitud aceptada" class="btn btn-success">
                            Solicitud aceptada
                        </button>
                        <button type="submit" name="estado" value="Estamos revisando tu solicitud"
                            class="btn btn-warning">
                            Estamos revisando tu solicitud
                        </button>
                    </div>

                    <div class="mb-3">
                        <label for="respuestaPersonalizada" class="form-label">Respuesta personalizada:</label>
                        <textarea id="respuestaPersonalizada" name="respuestaPersonalizada" class="form-control"
                            rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="adjuntos" class="form-label">Adjuntar archivos:</label>
                        <input type="file" id="adjuntos" name="adjuntos[]" multiple class="form-control">
                    </div>

                    <button type="submit" id="btnEnviar" name="submitType" value="customResponse"
                        class="btn btn-primary">
                        Enviar respuesta
                    </button>
                    <a href="?c=pqr&m=pqr" class="btn btn-primary">Volver</a>
                </form>

            </div>
        </div>
    </div>

    <script>
    document.getElementById('responseForm').addEventListener('submit', function(event) {
        var isEnviarRespuesta = event.submitter && event.submitter.value === 'customResponse';
        var respuestaPersonalizada = document.getElementById('respuestaPersonalizada').value.trim();

        // Validar solo si es el botón "Enviar respuesta" el que se presionó
        if (isEnviarRespuesta) {
            if (!respuestaPersonalizada) {
                // Mostrar un mensaje de alerta y evitar el envío
                alert('Por favor, escribe tu respuesta personalizada antes de enviar.');
                event.preventDefault(); // Evita el envío del formulario
                return; // Salir de la función
            } else {
                // Asignar la respuesta personalizada para enviar
                document.getElementById('respuestaPersonalizada').value = respuestaPersonalizada;
            }
        }
    });
    </script>

</body>

</html>