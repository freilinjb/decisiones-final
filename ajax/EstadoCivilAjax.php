<?php

require_once "../Controllers/employeeController.php";
require_once "../Models/EmployeeModel.php";

class EstadoCivilAjax {
    public $idSexo;

    public function listarEstadosCiviles() {

        $item = "idSexo";
        $valor = $this->idSexo;

        $respusta = EmployeeController::listarEstadoCiviles($item, $valor);
        echo json_encode($respusta);
    }
}

/*=============================================
CONSEGUIR LISTA DE SEXO
=============================================*/	
if(isset($_POST["idSexo"])){

	$categoria = new EstadoCivilAjax();
	$categoria -> idSexo = $_POST["idSexo"];
    $categoria -> listarEstadosCiviles();
}
