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
        <a href="?c=pqr&m=pqr" class="btn btn-primary">Volver</a>
        <div class="card-body_pqr mx-auto mt-4" style="max-width: 600px;">
            <div class="card-body">
                <h4>Información de la PQR</h4>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($user['ID']); ?></p>
                <p><strong>Mensaje: <br> </strong> <?php echo nl2br(htmlspecialchars($user['Detalle'])); ?></p>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars($user['Estado']); ?></p>
                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($user['Usuario']); ?></p>
                <p><strong>Tipo de PQR:</strong> <?php echo htmlspecialchars($user['Tipo de PQR']); ?></p>
                <p><strong>Fecha de Solicitud:</strong> <?php echo htmlspecialchars($user['Fecha de Solicitud']); ?></p>
                <p><strong>Fecha de Respuesta:</strong> <?php echo htmlspecialchars($user['Fecha de Respuesta']); ?></p>
                <p><strong>Respuesta:</strong> <?php echo nl2br(htmlspecialchars($user['Respuesta'])); ?></p>
            </div>
        </div>

        <div class="card-body_pqr mt-4 mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h4>Responder a la PQR</h4>
                <form id="responseForm" action="?c=pqr&m=respond" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['ID']); ?>">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user['Usuario']); ?>">
                    <input type="hidden" name="respuesta" id="respuesta" value="PQR RESUELTA">
                    <!-- Cambiado a "PQR RESUELTA" -->

                    <div class="mb-3">
                        <button type="submit" name="respuesta" value="Solicitud aceptada" class="btn btn-success"
                            id="btnSolicitudAceptada">Solicitud aceptada</button>
                        <button type="submit" name="respuesta" value="Estamos revisando tu solicitud"
                            class="btn btn-warning" id="btnRevisandoSolicitud">Estamos revisando tu solicitud</button>
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
                    <button type="submit" id="btnEnviar" class="button btn-primary">Enviar respuesta</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('responseForm').addEventListener('submit', function(event) {
            // Verifica si el botón que se presiona es el botón de "Enviar respuesta"
            var isEnviarRespuesta = event.submitter && event.submitter.id === 'btnEnviar';
            var respuestaPersonalizada = document.getElementById('respuestaPersonalizada').value.trim();

            // Si el botón es "Enviar respuesta" y el campo está vacío, muestra el mensaje de alerta
            if (isEnviarRespuesta && !respuestaPersonalizada) {
                alert('Por favor, escribe tu respuesta personalizada antes de enviar.');
                event.preventDefault(); // Evita el envío del formulario
            } else if (!isEnviarRespuesta) {
                // Bloquea los botones de "Solicitud aceptada" y "Estamos revisando tu solicitud"
                document.getElementById('btnSolicitudAceptada').disabled = true;
                document.getElementById('btnRevisandoSolicitud').disabled = true;
            }
        });
    </script>
</body>

</html>