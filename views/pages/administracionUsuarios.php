<?php
$employee = EmployeeController::showEmployee(null, null);
?>
<style>
    .btn-file:hover {
        cursor: pointer;
    }

    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }

    .profile-img {
        text-align: center;
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -30%;
        width: 60%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }

    .profile-head h5 {
        color: #333;
    }

    .profile-head h6 {
        color: #0062cc;
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc;
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%;
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }

    .profile-work ul {
        list-style: none;
    }

    .profile-tab label {
        font-weight: 600;
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users</h1>
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
                            <i class="fas fa-users"></i>
                            Gestion de usuarios
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="">
                        <button class="btn btn-info mb-3" data-toggle="modal" data-target="#registrarUsuario">
                            <i class="fa fa-plus"></i>
                                Nuevo Usuario
                            </button>
                        </div>
                        <table id="empleados" class="table table-bordered table-striped table-hover float-left float-right">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Departamento</th>
                                    <th>Puesto de trabajo</th>
                                    <th>Ultimo acceso</th>
                                    <th>Estado</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $usuarios = UserController::mostrarUsuarios(null, null);
                                $estado = null;
                                foreach ($usuarios as $key => $value) {

                                    if ($value["Estado"] == "activo") {
                                        $estado = "<span class='badge badge-success'>" . $value["Estado"] . "</span>";
                                    }

                                    $foto = null;
                                    if (strlen($value["foto_url"]) > 15) {
                                        $foto = $value["foto_url"];
                                    } else {
                                        $foto = "views/assets/img/empleados/foto_perfil_hombre.jpg";
                                    }

                                    echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td> <img src=' . $foto . ' alt="Product 1" class="img-circle img-size-32 mr-2">' . $value["nombre"]  . '</td>
                                    <td>' . $value["Correo"] . '</td>
                                    <td>' . $value["Departamento"] . '</td>
                                    <td>' . $value["PuestoTrabajo"] . '</td>
                                    <td>' . $value["ultimoAcceso"] . '</td>
                                    <td>' . $estado . '</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-info btnEditarUsuario" data-toggle="modal" data-target="#modalEditarUsuario" usuario="' . $value["usuario"] . '"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-light btnDesactivar" data-target="#modalEditarUsuario" usuario="' . $value["usuario"] . '"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-dark btnEliminarUsuario" data-target="#modalEditarUsuario" usuario="' . $value["usuario"] . '"><i class="fas fa-trash"></i></button>
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
<div class="modal fade" id="registrarUsuario" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formRegistrarUsuario" method="post">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Register of users</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                        <label>Empleado</label>
                                        <select class="form-control select2bs4" name="idEmpleado" id="idEmpleado">
                                            <option value="" disabled selected>Seleccione una opción</option>
                                            <?php
                                            foreach ($employee as $index => $valor) {
                                                echo "<option value=" . $valor["idEmpleado"] . ">" . $valor["nombre"] . " " . $valor["apellido"] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese el nombre de usuario" autocomplete="off">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Clave</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="clave" id="clave" placeholder="Ingrese la clave de acceso" autocomplete="off">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" name="idEstado" id="idEstado">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
                <?php
                $usuarios = UserController::registrarUsuario();
                ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- END MODAL REGISTRAR EMPLEADO-->

<!-- MODAL REGISTRAR EDITAR-->
<div class="modal fade" id="modalEditarUsuario" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Actualizacion de usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <form id="formEmployeeEditar" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" width="150px" height="150px" class="img-thumbnail previsualizar" alt="">
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
                        <div class="row">
                            <div class="12">
                                <div class="row  mt-3">
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
                                            <select class="form-control" name="idEstado" id="idEstado">
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
                                            <label for="">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" name="fechaIngresoEditar" id="fechaIngresoEditar">
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
<script src="views/assets/js/administracionUsuarios.js"></script>
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

<script>
    $(function() {
        $("#empleados").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "info": true,
            "paging": true,
            "pageLength": 7,
        });

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
</script>