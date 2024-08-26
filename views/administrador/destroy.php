<link rel="stylesheet" href="assets/css/destroy.css">
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">Eliminar Usuario</h2>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="?c=administrador&m=index" class="btn btn-success">Volver</a>
                                                <section class="form-register">
                                                    <h3>¿Está seguro de que desea eliminar el usuario
                                                        <?php echo htmlspecialchars($user['NOMBRE'] . ' ' . $user['APELLIDO']); ?>?
                                                    </h3>
                                                    <form action="?c=administrador&m=delete" method="post">
                                                        <input type="hidden" name="userId"
                                                            value="<?php echo htmlspecialchars($user['ID']); ?>">
                                                        <input class="botons" type="submit" value="Eliminar">
                                                    </form>
                                                </section>
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
    </div>
</div>