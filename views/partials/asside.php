        <!-- Main Sidebar Container -->
        <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4" style="">
            <!-- Brand Logo -->
            <a href="views/assets/index3.html" class="brand-link">
                <img src="https://pbs.twimg.com/profile_images/1002942670233145345/EgCJ-JK1_400x400.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">ECOCISA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="home" <?php if($_GET['route']=="home") { ?> class="nav-link active" <?php }  else{ ?> class="nav-link" <?php } ?>>
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Admin estadistica
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="demandas" <?php if($_GET['route']=="demandas") { ?> class="nav-link active" <?php }  else{ ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registro de demanda</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="productos" <?php if($_GET['route']=="productos") { ?> class="nav-link active" <?php }  else{ ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Administrador de producto</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                <a href="eventos" <?php if($_GET['route']=="eventos") { ?> class="nav-link active" <?php }  else{ ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Administrador de eventos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    Simulacion digital
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a href="analisis" <?php if($_GET['route']=="analisis") { ?> class="nav-link active" <?php }  else{ ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Analisis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="conclusion" <?php if($_GET['route']=="conclusion") { ?> class="nav-link active" <?php }  else{ ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Conclusion</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    Logistica
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../UI/general.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../UI/icons.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Icons</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->

            <div class="sidebar-custom">
                <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
                <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
            </div>
            <!-- /.sidebar-custom -->
        </aside>

<!-- SPIN AL CARGAR LA PAGINA -->
    <div class="loader-page"></div>
