<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adminiscación de Evento</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                    <li class="breadcrumb-item active">Fixed Layout</li>
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
                            Registro de Evento
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalRegistroEvento">
                                Evento
                            </button>
                        </div>
                        <table id="empleados" class="table table-bordered table-striped table-hover">
                            <thead style="background-color:#6F747E; color:#FFFF">
                                <tr>
                                    <th>#</th>
                                    <th>Evento</th>
                                    <th>Fase</th>
                                    <th>Distribucion</th>
                                    <th>Tipo de distribucion</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $eventos = SimulacionController::getData('evento_v', null, null);
                                foreach ($eventos as $key => $value) {

                                    $estado = null;
                                    if ($value["estado"] == "activo") {
                                        $estado = "<span class='badge badge-success'>" . $value["estado"] . "</span>";
                                    } else {
                                        $estado = "<span class='badge badge-danger'>" . $value["estado"] . "</span>";
                                    }

                                    echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . strtoupper($value["evento"]) . '</td>
                                    <td>' . strtoupper($value["fase"]) . '</td>
                                    <td>' . strtoupper($value["distribucion"]) . '</td>
                                    <td>' . strtoupper($value["tipo"]) . '</td>
                                    <td>' . strtoupper($estado) . '</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary btnEditarEvento" data-toggle="modal" data-target="#modalEditarEvento" idEvento="' . $value["idEvento"] . '"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-dark btnEliminarEvento" data-target="#editarProducto" idEvento="' . $value["idEvento"] . '"><i class="fas fa-trash"></i></button>
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
<div class="modal fade" id="modalRegistroEvento" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEvento" method="POST">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Registro de Evento</h4>
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
                                        <label>Evento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="evento" id="evento" placeholder="Ingrese el nombre del evento" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Fase</label>
                                        <select class="form-control select2bs4" name="fase" id="fase">
                                            <option value="" disabled selected>Seleccione una fase</option>
                                            <?php
                                            $fase = SimulacionController::getData('fase', null, null);
                                            foreach ($fase as $index => $valor) {
                                                echo "<option value=" . $valor["idFase"] . ">" . $valor["fase"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Distribucion</label>
                                        <select class="form-control select2bs4" name="distribucion" id="distribucion">
                                            <option value="" disabled selected>Seleccione una distribucion</option>
                                            <?php
                                            $fase = SimulacionController::getData('distribucion', null, null);
                                            foreach ($fase as $index => $valor) {
                                                echo "<option value=" . $valor["idDistribucion"] . ">" . $valor["distribucion"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control select2bs4" name="estado" id="estado">
                                            <option value="1" selected>Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese la descripcion del evento" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <hr>
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

<!-- MODAL REGISTRAR EDITAR-->
<div class="modal fade" id="modalEditarEmpleado" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Register Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <form id="formEmployeeEditar">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" width="150px" height="150px" class="img-thumbnail previsualizar" alt="">
                                    <div class="file btn btn-lg btn-primary">
                                        Cambiar foto
                                        <input type="file" name="file" class="nuevaImagen" name="nuevaImagen">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                    <h2 id="nombreP">
                                        Kshiti Ghelani
                                    </h2>
                                    <h6 id="departamentoP">
                                        Web Developer and Designer
                                    </h6>

                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Info. personal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Info. laboral</a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="12">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <!-- Date dd/mm/yyyy -->
                                                <div class="form-group">
                                                    <label>Nombre</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="nombreEditar" id="nombreEditar" placeholder="Ingrese el nombre" autocomplete="off">
                                                        <input type="hidden" id="idEmpleado" name="idEmpleado">

                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <!-- Date dd/mm/yyyy -->
                                                <div class="form-group">
                                                    <label>Apellido</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="apellidoEditar" id="apellidoEditar" placeholder="Ingrese el apellido" autocomplete="off">
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Sexo</label>
                                                    <select class="form-control" name="sexoEditar" id="sexoEditar">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <?php
                                                        $sexo = EmployeeController::listarSexo();
                                                        foreach ($sexo as $index => $valor) {
                                                            echo "<option value=" . $valor["idSexo"] . ">" . $valor["Sexo"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Estado Civil</label>
                                                    <select class="form-control" name="estadoCivilEditar" id="estadoCivilEditar">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Tipo de Identificacion</label>
                                                    <div class="input-group">
                                                        <select class="form-control" name="tipoIdentificacionEditar" id="tipoIdentificacionEditar">
                                                            <option value="" disabled selected>Seleccione una opción</option>
                                                            <?php
                                                            $tipoIdentificacion = EmployeeController::listarTipoIdentificacion();
                                                            foreach ($tipoIdentificacion as $index => $valor) {
                                                                echo "<option value=" . $valor["idTipoIdentificacion"] . ">" . $valor["TipoIdentificacion"] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Identificacion</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="identificacionEditar" id="identificacionEditar" placeholder="Ingrese el numero de ducumento" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Telefono fijo</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="telefonoEditar" id="telefonoEditar" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-mobile"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="celularEditar" id="celularEditar" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Correo</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control" name="correoEditar" id="correoEditar" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <!-- Date dd/mm/yyyy -->
                                                <div class="form-group">
                                                    <label>Fecha de nacimiento:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" name="fechaNacimientoEditar" id="fechaNacimientoEditar">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Centro de operación</label>
                                                    <select class="form-control" name="centroEditar" id="centroEditar">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <?php
                                                        $centro = EmployeeController::listarCentro();
                                                        foreach ($centro as $index => $valor) {
                                                            echo "<option value=" . $valor["idCentro"] . ">" . $valor["Centro"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Departamento</label>
                                                    <select class="form-control" name="departamentoEditar" id="departamentoEditar">
                                                        <option value="" disabled selected>Seleccione una opción</option>
                                                        <?php
                                                        $departamento = EmployeeController::listarDepartamento();
                                                        foreach ($departamento as $index => $valor) {
                                                            echo "<option value=" . $valor["idDepartamento"] . ">" . $valor["Departamento"] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Puesto de trabajo</label>
                                                    <select class="form-control" name="puestoTrabajoEditar" id="puestoTrabajoEditar">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6-lg col-xl-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Fecha de Ingreso</label>
                                                    <input type="date" class="form-control" name="fechaIngresoEditar" id="fechaIngresoEditar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" id="closeEditar" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- END MODAL REGISTRAR EMPLEADO-->

<!-- SCRIPT PERSONAL -->
<script src="views/assets/js/eventos.js"></script>
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