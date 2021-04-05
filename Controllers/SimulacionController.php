<?php

class SimulacionController
{

    static public function getData($table,$item, $value)
    {
        // $table = "evento";
        $request = SimulacionModel::getData($table, $item, $value);
        // print_r($request);

        return $request;
    }

    
    static public function registrarEvento()
    {

        if (isset($_POST["evento"]) && !empty($_POST["evento"])) {

            if (
                preg_match('/^[0-9]+$/', $_POST["idFase"]) &&
                preg_match('/^[0-9]+$/', $_POST["idDistribucion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["evento"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["estado"])
            ) {

                if (isset($_POST["idEvento"])) {

                    $datos = array(
                        "idProducto" => $_POST["idProducto"],
                        "idCategoria" => $_POST["idCategoria"],
                        "idTipoProducto" => $_POST["idTipoProducto"],
                        "idSubTipo" => $_POST["idSubTipo"],
                        "producto" => $_POST["producto"],
                        "descripcion" => $_POST["descripcion"],
                        "producto" => $_POST["idEstado"]
                    );
                } else {

                    $datos = array(
                        "idCategoria" => $_POST["idCategoria"],
                        "idTipoProducto" => $_POST["idTipoProducto"],
                        "idSubTipo" => $_POST["idSubTipo"],
                        "producto" => $_POST["producto"],
                        "descripcion" => $_POST["descripcion"],
                        "idEstado" => $_POST["idEstado"]
                    );
                }


                $respuesta = ProductoModel::registrarProducto($datos);

                // print_r($respuesta["status"] == 200);

                if ($respuesta["status"] == 200) {
                    echo '<script>
                        jQuery(document).ready(function () {
                                Swal.fire(
                                    "Ok!",
                                    "Se ha registro correctamente!",
                                    "success"
                                );
                            });
                        </script>';
                }
            }
        }
    }

    static public function eliminarEvento()
    {

        if (isset($_GET["idProducto"])) {

            $tabla = "producto";
            $datos = $_GET["idProducto"];

            // if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {

            //     unlink($_GET["imagen"]);
            //     rmdir('vistas/img/productos/' . $_GET["codigo"]);
            // }

            $respuesta = ProductoModel::eliminarProducto($tabla, $datos);

            if ($respuesta == true) {

                echo '<script>
                jQuery(document).ready(function () {
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado.",
                        text: "El producto ha sido borrado correctamente!"
                      }).then(function(result) {
                                if (result.value) {
                                    window.location = "administracionProductos";
                                }
                            });
                });

				</script>';
            } else {
                echo "<script>
                jQuery(document).ready(function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    });
                })
				</script>";
            }
        }
    }
}
