<?php

require_once "../Controllers/employeeController.php";
require_once "../Models/EmployeeModel.php";

class PuestroTrabajoAjax {
    public $idDepartamento;

    public function listarPuestroTrabajo() {

        $item = "idDepartamento";
        $valor = $this->idDepartamento;

        $respusta = EmployeeController::listarPuestroTrabajo($item, $valor);
        echo json_encode($respusta);
    }
}

/*=============================================
CONSEGUIR LISTA DE SEXO
=============================================*/	
if(isset($_POST["idDepartamento"])){
	$departamento = new PuestroTrabajoAjax();
	$departamento -> idDepartamento = $_POST["idDepartamento"];
    $departamento -> listarPuestroTrabajo();
}
