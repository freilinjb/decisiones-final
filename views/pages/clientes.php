

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adminiscación de Clientes</h1>
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
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Registro de Cliente
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalEmployeeRegister">
                                Cliente
                            </button>
                        </div>
                        <table id="empleados" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>CellPhone</th>
                                    <th>Puesto de trabajo</th>
                                    <th>Departamento</th>
                                    <th>Centro</th>
                                    <th>Estado</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $employee = EmployeeController::showEmployee(null, null);
                                $clase = null;
                                foreach ($employee as $key => $value) {

                                    if ($value["Estado"] == "activo") {
                                        $clase = "<span class='badge badge-success'>" . $value["Estado"] . "</span>";
                                    }

                                    echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $value["nombre"] . '</td>
                                    <td>' . $value["Correo"] . '</td>
                                    <td>' . $value["telefono"] . '</td>
                                    <td>' . $value["celular"] . '</td>
                                    <td>' . $value["PuestoTrabajo"] . '</td>
                                    <td>' . $value["Departamento"] . '</td>             
                                    <td>' . $value["Centro"] . '</td>
                                    <td>' . $clase . '</td>
                                    <td>
                                        <button class="btn btn-info btnEditEmployee" data-toggle="modal" data-target="#modalEditarEmpleado" idEmployee="' . $value["idEmpleado"] . '"><i class="fas fa-eye"></i></button>
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
<div class="modal fade" id="modalEmployeeRegister" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formEmployee">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Register Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <!-- Date dd/mm/yyyy -->
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <!-- Date dd/mm/yyyy -->
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese el apellido" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select class="form-control" name="sexo" id="sexo">
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
                                        <select class="form-control" name="estadoCivil" id="estadoCivil">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Tipo de Identificacion</label>
                                        <div class="input-group">
                                            <select class="form-control" name="tipoIdentificacion" id="tipoIdentificacion">
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
                                            <input type="text" class="form-control" name="identificacion" id="identificacion" placeholder="Ingrese el numero de ducumento" autocomplete="off">
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
                                            <input type="text" class="form-control" name="telefono" id="telefono" autocomplete="off">
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
                                            <input type="text" class="form-control" name="celular" id="celular" autocomplete="off">
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
                                            <input type="email" class="form-control" name="correo" id="correo" autocomplete="off">
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
                                            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="nuevaImagen">
                                            <label class="custom-file-label" for="nuevaImagen">Eliga una foto</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Centro de operación</label>
                                        <select class="form-control" name="centro" id="centro">
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
                                        <select class="form-control" name="departamento" id="departamento">
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
                                        <select class="form-control" name="puestoTrabajo" id="puestoTrabajo">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="">Fecha de Ingreso</label>
                                        <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
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
            <div class="modal-header bg-info">
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
                            <button type="submit" class="btn btn-info">Save changes</button>
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
<script src="views/assets/js/empleado.js"></script>
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
</script>