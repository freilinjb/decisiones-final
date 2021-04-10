<?php

require_once "../Models/DecisionModel.php";

class DecisionAjax {

    public function getPlanta() {
        $tabla = "planta";
        $respuesta = DecisionModel::plantas($tabla, null, null);
        echo  json_encode($respuesta);
    }

    public function getSectores() {
        $tabla = "sector";
        $respuesta = DecisionModel::sectores($tabla, null, null);
        echo  json_encode($respuesta);
    }

    public function getCumplimientoPorFecha($datos) {
        $respuesta = new stdClass();
        $respuesta->cumplimientoPorFecha = DecisionModel::getCumplimientoPorFecha($datos);
        $respuesta->sectorCumplimientoPorFecha = DecisionModel::getSectorCumplimientoPorFecha($datos);

        if($datos->sector == 0) {
            $respuesta->sectoresList = DecisionModel::getSectoresPorRango($datos);
        } else {
            $sectores = explode(",", $datos->sector);

            $tempSector = array();
            foreach($sectores as $index => $key) {
                 $datos->sector = $key;
                 $resultado = DecisionModel::getCumplimientoPorMesCliente($datos);

                 array_push($tempSector, $resultado);
            }
            $respuesta->cumplimientoPorMesCliente = $tempSector;
        }


        echo json_encode($respuesta);
    }
}

/*=============================================
Comprobamos que el valor no venga vacío
=============================================*/

if (isset($_POST['exec']) && !empty($_POST['exec'])) {

    $funcion = $_POST['exec'];
    $ejecutar = new DecisionAjax();
    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch ($funcion) {
        case 'getPlanta':
            $ejecutar->getPlanta();
            break;
        case 'getSectores':
            $ejecutar->getSectores();
            break;
        case 'getCumplimientoPorFecha';
            $data = new stdClass();
            $data->fechaInicio = $_POST["fechaInicio"];
            $data->fechaFinal = $_POST["fechaFinal"];
            $data->sector = $_POST["sector"];
            $data->planta = $_POST["planta"];
            $ejecutar->getCumplimientoPorFecha($data);
            break;
    }
}
