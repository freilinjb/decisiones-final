<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include "partials/header.php" ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php

    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == true) {
        echo '<div class="wrapper">';

        include "partials/navbar.php";
        include "partials/asside.php";

        echo '<div class="content-wrapper">';

        if (isset($_GET['route'])) {
            if (file_exists(dirname(__FILE__) . "/pages/" . $_GET["route"] . ".php")) {

                include "pages/" . $_GET["route"] . ".php";
            } else {
                include "pages/404.php";
            }
        } else {

            include "pages/home.php";
        }
        echo '</div>';

        echo '</div>';

        include "partials/footer.php";

    } else {
        include "pages/auth/logIn.php";
    }

    ?>

   

    <!-- ./wrapper -->

    <!-- Bootstrap 4 -->
    <script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="views/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/assets/dist/js/adminlte.min.js"></script>
    <!-- sweetalert2 -->
    <script src="views/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>