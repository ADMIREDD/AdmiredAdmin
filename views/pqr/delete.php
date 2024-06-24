<link rel="stylesheet" href="./assets/css/destroy.css">

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Elimina pqr</h4>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="?c=pqr&m=pqr" class="btn btn-success">Volver</a>
                                                <section class="form-register">
                                                    <form action="views/dashboard/deleteUser.php" method="post">
                                                        <input type="hidden" name="userId" value="<?php echo $_GET['userId']; ?>">

                                                        <div class="table-responsive mt-2">
                                                            <table class="table table-border table-hover striped">                                                       
                                                                <input class="controls" type="text" name="detalle" id="detalle" placeholder="Ingrese el detalle" value="<?php echo $user['DETALLE'] ?>" readonly>
                                                                <input class="controls" type="text" name="estado_id" id="estado_id" placeholder="Ingrese el estado id" value="<?php echo $user['ESTADO_ID'] ?>" readonly>
                                                                <input class="controls" type="text" name="usuario_id" id="usuario_id" placeholder="Ingrese usuario id" value="<?php echo $user['USUARIO_ID'] ?>" readonly>
                                                                <input class="controls" type="text" name="pqr_tipo" id="pqr_tipo" placeholder="Ingrese pqr tipo" value="<?php echo $user['PQR_TIPO'] ?>" readonly>
                                                                <input class="botons" type="submit" value="Eliminar">
                                                            </table>
                                                        </div>
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
            
