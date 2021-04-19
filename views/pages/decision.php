<!-- daterange picker -->
<link rel="stylesheet" href="views/assets/plugins/daterangepicker/daterangepicker.css">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reporte para el apoyo a la toma de decisiones</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">decision</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<div class="col-12">
    <div class="card card-default shadow-lg">
        <div class="card-header  bg-secondary">
            <h3 class="card-title">Reporte de analisis de senbilidad</h3>
        </div>
        <div class="card-body">
            <form class="row" id="formulario">
                <div class="form-group col-3">
                    <label>Date range:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="fechaRango">

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Sector</label>
                        <select class="select2bs4" id="sector" multiple="multiple" data-placeholder="Seleccionar el sector" style="width: 100%;">
                            <?php
                            $sector = DecisionController::sectores(null, null);
                            foreach ($sector as $value) {
                                echo "<option value=" . $value["idSector"] . ">" . $value["descripcion"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Planta</label>
                        <select class="select2bs4" id="planta" multiple="multiple" data-placeholder="Seleccionar la Plata" style="width: 100%;">
                            <?php
                            $sector = DecisionController::plantas(null, null);
                            foreach ($sector as $value) {
                                echo "<option value=" . $value["idPlanta"] . ">" . $value["descripcion"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- /.form-group -->
                <div class="col-3" style="margin-top: 32px">
                    <div class="btn-group float-right" role="group" aria-label="Button group">
                        <button type="button" id="btnBuscar" class="btn btn-primary float-right">
                            <li class="fa fa-search"></li> Buscar
                        </button>
                        <button type="button" class="btn btn-secondary float-right">
                            <li class="fa fa-print"></li> Imprimir
                        </button>
                        <button type="button" class="btn btn-warning float-right">
                            <li class="fa fa-trash"></li> Limpiar
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <hr>
        <div class="col-12 text-center p-2 bg-secondary shadow">
            <h3>Informacion para el apoyo a la toma de decisiones</h3>
            <h5>Analisis y causa</h5>
        </div>
        <!-- Info boxes -->
        <div class="row mt-3 p-3">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Plantas procesadoras activas</span>
                        <span class="info-box-number">
                            10
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Atrasos registrados</span>
                        <span class="info-box-number">41</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ventas</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clientes</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <h3 class="bg-dark p-2 text-center">Rendimiento de producción segmentada por sector</h3>
                <p class="text-center text-center">
                    <strong>Rango de fechas: </strong>
                    <span id="fechaGrafico"></span>
                </p>

                <div class="chart" style="height:380px;">
                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                </div>
            </div>

            <div class="col-md-6">
                <h3 class="bg-dark p-2 text-center">Cumplimiento por Sector</h3>
                <div id="cumplimiento">
                </div>
                <!-- /.progress-group -->
            </div>

            <h2 class="bg-dark p-1 text-center col-12 shadow-lg m-2">Problemas encontrados en la producción</h2>

            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header border-transparent">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 row">
                        <div class="col-6">
                            <h3 class="bg-dark p-2 text-center">Porcentaje de incumplimiento por cada incidente</h3>
                            <div id="tableProblema">

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h3 class="bg-dark p-2 text-center">Resumen de eventos registrados en la producción</h3>
                            <div class="row">

                                <div class="col-lg-12 col-md-12">
                                    <div id="chartContainerProblemas" style="width: 100%; height: 300px"></div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div id="chartContainerCausas" style="width: 100%; height: 300px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h3 class="p-3 bg-dark m-2">Reporte compatarivo de incidentes de las plantas </h3>
                            <div id="pivotgrid-chart"></div>
                            <div id="pivotgrid"></div>
                        </div>
                    </div>
                    <div class="card-footer clearfix row m-5">
                        <h5 class="col-auto">Tiempo total de paros: <span class="badge badge-danger" id="totalParo">#</span></h5>
                        <h5 class="col-auto">Tiempo medio de arranque: <span class="badge badge-danger" id="tiempoMedioArranque">#</span></h5>
                        <h5 class="col-auto">Meta promedio: <span class="badge badge-warning" id="metaPromedio">#</span></h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

<!-- SCRIPT PERSONAL -->
<script src="views/assets/js/decision.js"></script>
<!-- ChartJS -->
<script src="views/assets/plugins/chart.js/Chart.min.js"></script>

<!-- PIVOT -->
<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.6/css/dx.common.css" />
<link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/20.2.6/css/dx.light.css" />
<script src="https://cdn3.devexpress.com/jslib/20.2.6/js/dx.all.js"></script>


<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#fechaRango').daterangepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>