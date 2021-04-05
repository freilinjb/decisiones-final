<?php

require_once "../Controllers/employeeController.php";
require_once "../Models/EmployeeModel.php";

class EmpleadoAjax
{
    public $idEmpleado;
    public $idSexo;
    public $idDepartamento;
    public $datosEmpleado;

    public function listarEstadosCiviles()
    {

        $item = "idSexo";
        $valor = $this->idSexo;

        $respusta = EmployeeController::listarEstadoCiviles($item, $valor);
        echo json_encode($respusta);
    }

    public function listarPuestroTrabajo()
    {

        $item = "idDepartamento";
        $valor = $this->idDepartamento;

        $respusta = EmployeeController::listarPuestroTrabajo($item, $valor);
        echo json_encode($respusta);
    }

    public function registrarEmpleado()
    {
        $valor = $this->datosEmpleado;
        $respuesta  = EmployeeModel::registrarEmpleado($valor);

        echo json_encode($respuesta);
    }

    public function editarEmplado()
    {
        $valor = $this->datosEmpleado;
        $respuesta  = EmployeeModel::actualizarEmpleado($valor);

        echo json_encode($respuesta);
    }

    public function consultarEmpleado()
    {
        $item = "idEmpleado";
        $valor = $this->idEmpleado;

        $respuesta = EmployeeController::showEmployee($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
CONSEGUIR LISTA DE ESTADOS CIVILES POR SEXO
=============================================*/
if (isset($_POST["idSexo"]) && count($_POST) == 1) {

    $categoria = new EmpleadoAjax();
    $categoria->idSexo = $_POST["idSexo"];
    $categoria->listarEstadosCiviles();
}

/*=============================================
CONSEGUIR LISTA DE PUESTOS DE TRABAJO POR DEPARTAMENTO
=============================================*/
if (isset($_POST["idDepartamento"]) && count($_POST) == 1) {

    $departamento = new EmpleadoAjax();
    $departamento->idDepartamento = $_POST["idDepartamento"];
    $departamento->listarPuestroTrabajo();
}

//REGISTRAR EMPLEADO
if (isset($_POST["nombre"]) && !isset($_POST["idEmpleado"])) {


    if (isset($_FILES['foto']['tmp_name']) && !empty($_FILES['foto']['tmp_name'])) {
        //echo $_FILES['foto']['tmp_name'] . " HOLA ";
        //Crear nuevo array
        list($ancho, $alto) = getimagesize($_FILES['foto']['tmp_name']);
        //Redimencionar
        $nuevoAncho = 500;
        $nuevoAlto = 500;

        $directorio = '../views/assets/img/empleados/' . trim($_POST["Identificacion"]);

        /**
         * PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN EL DB
         */
        //0755 permiso de lectura y estricura
        //echo $directorio;
        mkdir($directorio, 0777, true);

        /*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

        if ($_FILES["foto"]["type"] == "image/jpeg") {

            /*=============================================
			GUARDAMOS LA IMAGEN EN EL DIRECTORIO
			=============================================*/

            $aleatorio = mt_rand(100, 999);

            $ruta = "../views/assets/img/empleados/" . $_POST["Identificacion"] . "/" . $aleatorio . ".jpg";

            $origen = imagecreatefromjpeg($_FILES["foto"]["tmp_name"]);

            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

            imagejpeg($destino, $ruta);

            $ruta = "views/assets/img/empleados/" . $_POST["Identificacion"] . "/" . $aleatorio . ".jpg";

        }

        if($_FILES["foto"]["type"] == "image/png"){

            /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

            $aleatorio = mt_rand(100,999);

            $ruta = "../views/assets/img/empleados/".$_POST["Identificacion"]."/".$aleatorio.".png";

            $origen = imagecreatefrompng($_FILES["foto"]["tmp_name"]);						

            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

            imagepng($destino, $ruta);

            $ruta = "/views/assets/img/empleados/".$_POST["Identificacion"]."/".$aleatorio.".png";


        }
    }

    $empleado = new EmpleadoAjax();

    $datos = array(
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "idSexo" => $_POST["idSexo"],
        "idEstadoCivil" => $_POST["idEstadoCivil"],
        "idTipoIdentificacion" => $_POST["idTipoIdentificacion"],
        "Identificacion" => $_POST["Identificacion"],
        "telefono" => $_POST["telefono"],
        "celular" => $_POST["celular"],
        "correo" => $_POST["correo"],
        "fechaNacimiento" => $_POST["fechaNacimiento"],
        "idCentro" => $_POST["idCentro"],
        "idDepartamento" => $_POST["idDepartamento"],
        "idPuestoTrabajo" => $_POST["idPuestoTrabajo"],
        "fechaIngreso" => $_POST["fechaIngreso"],
        "foto" => $ruta
    );

    $empleado->datosEmpleado = $datos;
    $empleado->registrarEmpleado();
}

if (isset($_POST['idEmpleado']) && count($_POST) == 1) {

    $empleado = new EmpleadoAjax();
    $empleado->idEmpleado = $_POST['idEmpleado'];
    $empleado->consultarEmpleado();
}

//EDITAR EMPLEADO
if (isset($_POST['idEmpleado']) && count($_POST) > 1) {

    $empleado = new EmpleadoAjax();
    $datos = array(
        "idEmpleado" => $_POST["idEmpleado"],
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "idSexo" => $_POST["idSexo"],
        "idEstadoCivil" => $_POST["idEstadoCivil"],
        "idTipoIdentificacion" => $_POST["idTipoIdentificacion"],
        "Identificacion" => $_POST["Identificacion"],
        "telefono" => $_POST["telefono"],
        "celular" => $_POST["celular"],
        "correo" => $_POST["correo"],
        "fechaNacimiento" => $_POST["fechaNacimiento"],
        "idCentro" => $_POST["idCentro"],
        "idDepartamento" => $_POST["idDepartamento"],
        "idPuestoTrabajo" => $_POST["idPuestoTrabajo"],
        "fechaIngreso" => $_POST["fechaIngreso"]
    );

    $empleado->datosEmpleado = $datos;
    $empleado->editarEmplado();
}
