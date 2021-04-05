<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Simulacion</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Simulacion</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Tabs Custom Content Examples
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="formProcesar">
                            <div class="form-group">
                                <label>Tanda</label>
                                <select class="form-control select2bs4" name="tanda" id="tanda">
                                    <!-- <option value="" disabled selected>Seleccione una tanda</option> -->
                                    <?php
                                    $sexo =  SimulacionController::getData('tanda', null, null);
                                    foreach ($sexo as $index => $valor) {
                                        echo "<option value=" . $valor["idTanda"] . ">" . $valor["tanda"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Numero de ordenes entrantes</label>
                                <input type="number" class="form-control" name="numOrdenes" id="numOrdenes" placeholder="Ingrese los numeros de ordenes entrantes" min="0" autocomplete="off" value="30">
                            </div>
                            <div class="form-group">
                                <label>Promedio de duración del proceso de produccion (horas)</label>
                                <input type="number" class="form-control" name="numPromedioDuracion" id="numPromedioDuracion" placeholder="Ingrese los numeros de ordenes entrantes" min="0" autocomplete="off" value="5">
                            </div>
                            <div class="form-group">
                                <label>Tiempo objetivo de cumplimiento (horas)</label>
                                <input type="number" class="form-control" name="tiempoObjetivo" id="tiempoObjetivo" placeholder="Ingrese los numeros de ordenes entrantes" min="0" autocomplete="off" value="3">
                            </div>
                            <button type="submit" class="btn btn-primary float-right ml-2" id="btnConsultar">Consultar</button>
                            <button type="button" class="btn btn-primary float-right" id="btnProcesar">Procesar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            RESEUMEN
                        </h3>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Datos generales </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Informacion a procesar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-messages-tab" data-toggle="pill" href="#custom-content-above-messages" role="tab" aria-controls="custom-content-above-messages" aria-selected="false">Procesamiento</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-above-settings-tab" data-toggle="pill" href="#custom-content-above-settings" role="tab" aria-controls="custom-content-above-settings" aria-selected="false">Conclusion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-recomendacion-settings-tab" data-toggle="pill" href="#custom-content-recomendacion-settings" role="tab" aria-controls="custom-content-recomendacion-settings" aria-selected="false">Recomendacion</a>
                            </li>
                        </ul>
                        <div class="tab-custom-content">
                            <p class="lead mb-0">Calidad del servicio</p>
                        </div>
                        <div class="tab-content" id="custom-content-above-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-6">
                                            <!-- GRAFICO -->
                                            <p class="lead mb-0">Fases del sistema de produccion</p>
                                            <div id="donut-chart-fase" style="height: 300px;"></div>
                                            <hr>
                                            <p>Tiempo total del servicio servicio: <span id="faseTiempo"></span></p>
                                            <!-- GRAFICO -->
                                        </div>
                                        <div class="col-6">
                                            <!-- GRAFICO -->
                                            <p class="lead mb-0">Productos disponible y porcentaje utilizacion</p>
                                            <div id="donut-chart-producto" style="height: 300px;"></div>
                                            <hr>
                                            <!-- GRAFICO -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped table-hover" id="tablaFases">

                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped table-hover" id="tablaEventos">

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-above-messages" role="tabpanel" aria-labelledby="custom-content-above-messages-tab">
                            <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped table-hover" id="tablaProcesadaProducto">

                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-bordered table-striped table-hover" id="tablaProcesadaEventos">

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-above-settings" role="tabpanel" aria-labelledby="custom-content-above-settings-tab">
                            <div id="conclusion">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        CONCLUSION
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">Probabilidad de que haya órdenes  en espera. <span id="conclusion1"></span></a>
                                    <a href="#" class="list-group-item list-group-item-action">Longitud media de la línea de producción. <span id="conclusion2"></span></a>
                                    <a href="#" class="list-group-item list-group-item-action">Tiempo medio de espera de la linea de producción. <span id="conclusion3"></span></a>
                                    <a href="#" class="list-group-item list-group-item-action">Probabilidad de que el cliente pueda ser atendido inmediatamente. <span id="conclusion4"></span></a>
                                    <a href="#" class="list-group-item list-group-item-action">Probabilidad de que haya por lo menos dos órdenes  en cola. <span id="conclusion5"></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-recomendacion-settings" role="tabpanel" aria-labelledby="custom-content-recomendacion-settings-tab">
                                <div id="recomendacion">
                                    <p>Se recomiendoa realizar una mayor supervision de las operaciones para mitigar mas los errores humanos que se den</p>
                                    <p>Se recomiendoa realizar implementar una nueva linea de produccion para satisfacer la demanda del mercado</p>
                                </div> 
                            </div>      
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</section>




<!-- SCRIPT PERSONAL -->
<script src="views/assets/js/analisis.js"></script>
<!-- DataTables  & Plugins -->

<link rel="stylesheet" href="views/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="views/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="views/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<script src="views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="views/assets/plugins/jszip/jszip.min.js"></script>
<script src="views/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="views/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="views/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- jquery-validation -->
<script src="views/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="views/assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- sweetalert2 -->

<script src="views/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- sweetalert2-theme-bootstrap-4 -->
<link rel="stylesheet" href="views/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- SELECT -->
<link rel="stylesheet" href="views/assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="views/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Select2 -->
<script src="views/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Page specific script -->


<!-- FLOT CHARTS -->
<script src="views/assets/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="views/assets/plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="views/assets/plugins/flot/plugins/jquery.flot.pie.js"></script>

<script>
    $(function() {
        // $("#tablaEventos").DataTable({
        //         "responsive": true,
        //         "lengthChange": false,
        //         "autoWidth": false,
        //         "info": true,
        //         "paging": true,
        //         "pageLength": 7,
        //     }).buttons().container().appendTo('#empleados_wrapper  .col-md-6:eq(7)');

        //     $("#tablaEventos").DataTable({
        //         "responsive": true,
        //         "lengthChange": false,
        //         "autoWidth": false,
        //         "info": true,
        //         "paging": true,
        //         "pageLength": 7,
        //     }).buttons().container().appendTo('#empleados_wrapper  .col-md-6:eq(7)');

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
</script>