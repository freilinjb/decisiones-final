<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Administracion de Cobro</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Administración</a></li>
                    <li class="breadcrumb-item active">Reportes de </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6 mb-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Pagos de facturas pendientes
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form row justify-content-lg-between">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="numeroDocumento">Numero de Documento: &nbsp &nbsp </label>
                                    <input type="text" name="numeroDocumento" id="numeroDocumento" class="form-control" placeholder="Ingrese el numero de documento">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="numeroDocumento">Fecha: </label>
                                    <input type="date" name="" id="" class="form-control">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="my-select">Cliente</label>
                                    <select id="my-select" class="form-control" name="">
                                        <option> == </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-9">
                            <div class="form-group">
                                    <label for="my-select"> &nbsp  </label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="my-select">Empleado </label>
                                    <select id="my-select" class="form-control" name="">
                                        <option> == </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-9">
                            <div class="form-group">
                                    <label for="my-select"> &nbsp  </label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="numeroDocumento">Balance Pendiente: </label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="numeroDocumento">Valor Recibido: </label>
                                    <input type="text" name="" id="" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-12">

                                <div class="btn-group float-right" role="group" aria-label="Button group">
                                    <button class="btn btn-primary btn btn-secondary float-right">Cancelar</button>
                                    <button class="btn btn-primary btn btn-info float-right">Subir pagos</button>                            
                                    <button class="btn btn-primary btn btn-primary float-right">Guardar</button>                            
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Reportes de cobros pendientes</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Numero de prestamo</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Dias atrasado</th>
                                    <th>Valor a cobrar</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>183</td>
                                    <td>546546</td>
                                    <td>Miguel Rojas Silverio</td>
                                    <td>15-12-2019</td>
                                    <td>56 dias</td>
                                    <td> RD$ 500.00</td>
                                    <td><span class="badge bg-success">Pendiente</span></td>
                                </tr>

                                <tr>
                                    <td>183</td>
                                    <td>456456</td>
                                    <td>Miguel Rojas Silverio</td>
                                    <td>15-12-2019</td>
                                    <td>6 dias</td>
                                    <td> RD$ 745.00</td>
                                    <td><span class="badge bg-success">Pendiente</span></td>
                                </tr>

                                <tr>
                                    <td>183</td>
                                    <td>4564</td>
                                    <td>Albert Acevedo</td>
                                    <td>15-12-2019</td>
                                    <td>7 dias</td>
                                    <td> RD$ 700.00</td>
                                    <td><span class="badge bg-danger">Atrasado</span></td>
                                </tr>

                                <tr>
                                    <td>183</td>
                                    <td>546546</td>
                                    <td>Pedro Aguilar Silverio</td>
                                    <td>15-12-2020</td>
                                    <td>10 dias</td>
                                    <td> RD$ 356.00</td>
                                    <td><span class="badge bg-primary">Cobrado</span></td>
                                </tr>

                                <tr>
                                    <td>183</td>
                                    <td>546546</td>
                                    <td>Miguel Rojas Silverio</td>
                                    <td>15-12-2019</td>
                                    <td>56 dias</td>
                                    <td> RD$ 500.00</td>
                                    <td><span class="badge bg-warning">Atrasado</span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
</body>

</html>