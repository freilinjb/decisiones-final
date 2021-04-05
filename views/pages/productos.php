<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adminiscación de Productos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Producto</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Registro de Productos
                        </h3>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn bg-blue fs-it-btn mb-2" data-toggle="modal" data-target="#modalRegistroProducto">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span class="fs-it-btn-vertical-line"></span>
                            Producto
                        </button>
                        <table id="empleados" class="table table-bordered table-striped table-hover">
                            <thead style="background-color:#6F747E; color:#FFFF">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Probabilidad de utilizacion</th>
                                    <th>creado</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $eventos = SimulacionController::getData('producto_v', null, null);
                                foreach ($eventos as $key => $value) {

                                    $estado = null;
                                    if ($value["estado"] == "activo") {
                                        $estado = "<span class='badge badge-success'>" . $value["estado"] . "</span>";
                                    } else {
                                        $estado = "<span class='badge badge-danger'>" . $value["estado"] . "</span>";
                                    }

                                    echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . strtoupper($value["producto"]) . '</td>
                                    <td>' . $value["probabilidad"] . '%</td>
                                    <td>' . $value["creado_en"] . '</td>
                                    <td>' . $value["estado"] . '</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btnEditarProducto" data-toggle="modal" data-target="#modalEditarProducto" idProducto="' . $value["idProducto"] . '"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-dark btnEliminarProducto" data-target="#editarProducto" idProducto="' . $value["idProducto"] . '"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>


<!-- MODAL REGISTRAR EMPLEADO-->
<div class="modal fade" id="modalRegistroProducto" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formProducto" method="POST">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Registro de Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <!-- Date dd/mm/yyyy -->
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="producto" id="producto" placeholder="Ingrese el nombre del producto" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                        <label>Probabilidad</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <input type="number" class="form-control" name="probabilidad" id="probabilidad" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control select2bs4" name="estado" id="estado">
                                                <option value="1" selected>Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END MODAL REGISTRAR EMPLEADO-->


<!-- SCRIPT PERSONAL -->
<script src="views/assets/js/productos.js"></script>
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
<script>
    $(function() {
        $("#empleados").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "info": true,
            "paging": true,
            "pageLength": 7,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#empleados_wrapper  .col-md-6:eq(0)');
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
</script>