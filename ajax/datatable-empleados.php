<?php

require_once "../Controllers/employeeController.php";
require_once "../Models/EmployeeModel.php";

class TablaEmpleados
{

    /*=============================================
 	 MOSTRAR LA TABLA DE LOS EMPLEADOS
      =============================================*/

    public function mostrarTablaEmpleados()
    {

        $item = null;
        $valor = null;

        $empleados = EmployeeController::showEmployee($item, $valor);   
 
            $datosJson = '{
                "data": [';
    
            foreach($empleados as $index => $key) {
                $estado = null;
                if ($key["Estado"] == "activo") {
                    $estado = "<span class='badge badge-success'>" . $key["Estado"] . "</span>";
                }

               $botones = "<button class='btn btn-info btnEditEmployee' data-toggle='modal' data-target='#modalEditarEmpleado' idEmployee='" . $key["idEmpleado"] . "'><i class='fas fa-eye'></i></button>";
               
               //$foto = $key["foto_url"];
                $foto = null;
               if(strlen($key["foto_url"]) > 10) {
                   $foto_temp = str_replace($key["foto_url"],'',"");
                   $foto ="<img src='". $foto_temp. "'  class='img-circle img-size-32 mr-2'>";
               } else {
                   $foto ="<img src='views/assets/img/empleados/foto_perfil_hombre.jpg' class='img-circle img-size-32 mr-2'>";
               }


                $datosJson .= '[
                    "'.($index+1).'",
                    "'. $foto . $key["nombre"]. ' '.$key["apellido"]. '",
                    "'.$key["Correo"].'",
                    "'.$key["telefono"].'",
                    "'.$key["celular"].'",
                    "'.$key["PuestoTrabajo"].'",
                    "'.$key["Departamento"].'",
                    "'.$key["Centro"].'",
                    "'.$estado.'",
                    "'.$botones.'"
                ],';
            }

            // for($i = 0; $i < $length; $i++) {

            //     $estado = null;
            //     if ($empleados[$i]["Estado"] == "activo") {
            //         $estado = "<span class='badge badge-success'>" . $empleados[$i]["Estado"] . "</span>";
            //     }

            //    $botones = "<button class='btn btn-info btnEditEmployee' data-toggle='modal' data-target='#modalEditarEmpleado' idEmployee='" . $empleados[$i]["idEmpleado"] . "'><i class='fas fa-eye'></i></button>";
               
            //    $foto = null;

            //    if(strlen($empleados[$i]["foto_url"]) > 10) {
            //        $foto ="<img src='".$empleados[$i]["foto_url"]."'  class='img-circle img-size-32 mr-2'>";
            //    } else {
            //        $foto ="<img src='views/assets/img/empleados/foto_perfil_hombre.jpg' class='img-circle img-size-32 mr-2'>";
            //    }

            //     $datosJson .= '[
            //         "'.($i+1).'",
            //         "'. $foto .$empleados[$i]["nombre"]. ' '.$empleados[$i]["apellido"]. '",
            //         "'.$empleados[$i]["Correo"].'",
            //         "'.$empleados[$i]["telefono"].'",
            //         "'.$empleados[$i]["celular"].'",
            //         "'.$empleados[$i]["PuestoTrabajo"].'",
            //         "'.$empleados[$i]["Departamento"].'",
            //         "'.$empleados[$i]["Centro"].'",
            //         "'.$estado.'",
            //         "'.$botones.'"
            //     ],';
            // }
    
            $datosJson = substr($datosJson, 0, -1);
    
            $datosJson .= ']
                }';
              

            echo $datosJson;
            //echo json_encode($empleados);
    }
}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaEmpleados();
$activarProductos->mostrarTablaEmpleados();