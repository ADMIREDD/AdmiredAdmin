<link rel="stylesheet" href="assets/css/destroy.css">

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h2 class="page-title">Registrar Cuota Admin</h2>
                        <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="?c=cuotas&m=index" class="btn btn-success">Voler</a>
                                                <section class="form-register">
                                                    <form action="?c=cuota&m=crear" method="post">
                                                        <div class="table-responsive mt-2">
                                                            <table class="table table-border table-hover striped">
                                                                <input class="controls" type="date" name="fecha" id="fecha" placeholder="Ingrese la fecha" required>
                                                                <input class="controls" type="text" name="estado" id="estado" placeholder="Ingrese el estado" required>
                                                                <input class="controls" type="date" name="fecha_limite" id="fecha_limite" placeholder="Ingrese la fecha limite" required>
                                                                <input class="controls" type="text" name="precio" id="precio" placeholder="Ingrese el precio" required>
                                                                <input class="botons" type="submit" value="Crear">
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
            </div>
        </div>
    </div>
</div>