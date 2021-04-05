<?php
    $employee = EmployeeController::showEmployee(null, null);
    $categorias = ProductoModel::getData("categoria", null, null);
    $productos = ProductoController::getProductos(null, null);

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Productos</h1>
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
                            Administracion de Productos
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <button class="btn btn-info mb-3" data-toggle="modal" data-target="#registrarProducto">
                                <i class="fa fa-plus"></i>
                                Nuevo Producto
                            </button>
                        </div>
                        <table id="empleados" class="table table-bordered table-striped table-hover float-left float-right">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>TIpo</th>
                                    <th>Sub tipo</th>
                                    <th>Ultimo acceso</th>
                                    <th>Creacion</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $usuarios = UserController::mostrarUsuarios(null, null);
                                $estado = null;
                                foreach ($productos as $key => $value) {

                                    if ($value["Estado"] == "activo") {
                                        $estado = "<span class='badge badge-success'>" . $value["Estado"] . "</span>";
                                    } else {
                                        $estado = "<span class='badge badge-danger'>" . $value["Estado"] . "</span>";
                                    }


                                    echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $value["producto"] . '</td>
                                    <td>' . $value["categoria"] . '</td>
                                    <td>' . $value["tipo"] . '</td>
                                    <td>' . $value["subtipo"] . '</td>
                                    <td>' . $value["creado_en"] . '</td>
                                    <td>' . $estado . '</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-info btnEditarProducto" data-toggle="modal" data-target="#editarProducto" idProducto="' . $value["idProducto"] . '"><i class="fas fa-eye"></i></button>
                                            <button type="button" class="btn btn-light btnDesactivarProducto" data-target="#editarProducto" idProducto="' . $value["idProducto"] . '"><i class="fas fa-edit"></i></button>
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


<!-- MODAL REGISTRAR PRODUCTO-->
<div class="modal fade" id="registrarProducto" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formRegistrarUsuario" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Registro de producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class="form-control select2bs4" name="idCategoria" id="idCategoria">
                                            <option value="" disabled selected>Seleccione una categoria</option>
                                            <?php 
                                                foreach($categorias as $valor) {
                                                    echo "<option value=" . $valor["idCategoria"] . ">" . $valor["Categoria"] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Tipo de producto</label>
                                        <select class="form-control select2bs4" name="idTipoProducto" id="idTipoProducto">
                                            <option value="" disabled selected>Seleccione el tipo de producto</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Sub tipo</label>
                                        <select class="form-control select2bs4" name="idSubTipo" id="idSubTipo">
                                            <option value="" disabled selected>Seleccione subtipo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="producto" id="producto" placeholder="Ingrese el nombre del producto" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <div class="input-group mb-3">
                                            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese una descripcion del producto" cols="30" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customFile">Custom File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="imagenes" id="customFile" multiple>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
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
            </form>
            <?php
                    $producto = new ProductoController();
                    $producto->registrarProducto();
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END MODAL REGISTRAR EMPLEADO-->


<!-- MODAL EDITAR PRODUCTO-->
<div class="modal fade" id="editarProducto" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formEditarProducto" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Actualizar de producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class="form-control select2bs4" name="idCategoria" id="idEditarCategoria">
                                            <option value="" disabled selected>Seleccione una categoria</option>
                                            <?php 
                                                foreach($categorias as $valor) {
                                                    echo "<option value=" . $valor["idCategoria"] . ">" . $valor["Categoria"] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Tipo de producto</label>
                                        <select class="form-control select2bs4" name="idTipoProducto" id="idEditarTipoProducto">
                                            <option value="" disabled selected>Seleccione el tipo de producto</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Sub tipo</label>
                                        <select class="form-control select2bs4" name="idSubTipo" id="idEditarSubTipo">
                                            <option value="" disabled selected>Seleccione subtipo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="producto" id="Editarproducto" placeholder="Ingrese el nombre del producto" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <div class="input-group mb-3">
                                            <textarea name="descripcion" id="Editardescripcion" class="form-control" placeholder="Ingrese una descripcion del producto" cols="30" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customFile">Custom File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="imagenes" id="EditarcustomFile" multiple>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" name="idEstado" id="EditaridEstado">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
            </form>
            <?php
                    $producto = new ProductoController();
                    $producto->registrarProducto();
            ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    <?php 
        $eliminarProducto = new ProductoController();
        $eliminarProducto -> eliminarProducto();
    ?>
<!-- END MODAL REGISTRAR EMPLEADO-->

<!-- SCRIPT PERSONAL -->
<script src="views/assets/js/administracionProductos.js"></script>
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
<!-- dropzonejs -->
<script src="views/assets/plugins/dropzone/min/dropzone.min.js"></script>
<!-- dropzonejs -->
<link rel="stylesheet" href="views/assets/plugins/dropzone/min/dropzone.min.css">

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