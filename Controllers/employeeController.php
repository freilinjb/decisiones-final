<?php

class EmployeeController {

    static public function showEmployee($item, $value) {
        $table = "empleados_v";
        $request = EmployeeModel::showEmployee($table, $item, $value);

        return $request;
    }

    static public function registrarEmpleado($re) {

        if(isset($_POST["nombre"])) {
            if(
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["apellido"]) &&
                preg_match('/^[0-9]+$/', $_POST["idSexo"]) &&
                preg_match('/^[0-9]+$/', $_POST["idEstadoCivil"]) &&
                preg_match('/^[0-9]+$/', $_POST["idTipoIdentificacion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Identificacion"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["celular"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["correo"]) &&
                preg_match('/^[-.\/-0-9]+$/', $_POST["fechaNacimiento"]) &&
                preg_match('/^[-.\/-0-9]+$/', $_POST["fechaIngreso"])){

                $datos = array("nombre"=>$_POST["nombre"],
                                "apellido"=>$_POST["apellido"],
                                "nombidSexore"=>$_POST["idSexo"],
                                "idEstadoCivil"=>$_POST["idEstadoCivil"],
                                "idTipoIdentificacion"=>$_POST["idTipoIdentificacion"],
                                "Identificacion"=>$_POST["Identificacion"],
                                "telefono"=>$_POST["telefono"],
                                "celular"=>$_POST["celular"],
                                "correo"=>$_POST["correo"],
                                "fechaNacimiento"=>$_POST["fechaNacimiento"],
                                "fechaIngreso"=>$_POST["fechaIngreso"]);         
            }
        }
    }

    static public function listarEstadoCiviles($item, $valor) {
        $tabla = "estadoCivil";
        $respuesta = EmployeeModel::listarEstadoCiviles($tabla, $item, $valor);

        return $respuesta;
    }

    static public function listarPuestroTrabajo($item, $valor) {
        $tabla = "puestotrabajo";
        $respuesta = EmployeeModel::listarPuestroTrabajo($tabla, $item, $valor);

        return $respuesta;
    }

    static public function listarSexo() {
        $tabla = "sexo";
        $respuesta = EmployeeModel::listarSexo($tabla);

        return $respuesta;
    }
    
    static public function listarTipoIdentificacion() {
        $tabla = "TipoIdentificacion";
        $respuesta = EmployeeModel::listarTipoIdentificacion($tabla);

        return $respuesta;
    }

    static public function listarCentro() {
        $tabla = "centro";
        $respuesta = EmployeeModel::listarCentro($tabla);

        return $respuesta;
    }

    static public function listarDepartamento() {
        $tabla = "departamento";
        $respuesta = EmployeeModel::listarDepartamento($tabla);

        return $respuesta;
    }

}