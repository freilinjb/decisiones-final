<?php

class DecisionController {
    static public function plantas($item, $value) {
        $table = "planta";
        $respuesta = DecisionModel::plantas($table, $item, $value);
        return $respuesta;
    }

    static public function sectores($item, $value) {
        $table = "sector";
        $respuesta = DecisionModel::sectores($table, $item, $value);
        return $respuesta;
    }
}