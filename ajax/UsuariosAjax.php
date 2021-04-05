<?php

require_once "../Controllers/UsuarioController.php";
require_once "../Models/UsuarioModel.php";

class UsuariosAjax {
    public $usuario;

    public function listarEstadosCiviles() {

        $item = "idSexo";
        $valor = $this->idSexo;

        $respusta = EmployeeController::listarEstadoCiviles($item, $valor);
        echo json_encode($respusta);
    }

    public function registrarUsuario()
    {
        $datos = array(
            "idEmpleado" => $_POST["idEmpleado"],
            "usuario" => $_POST["usuario"],
            "clave" => $_POST["clave"],
            "idEstado" => $_POST["idEstado"]);

        print_r($_POST);
        print_r($_FILES);

        $respuesta  = UsuarioModel::registrarUsuario($datos);
        
        echo json_encode($respuesta);
    }
}

/*=============================================
Comprobamos que el valor no venga vacío
=============================================*/	
if(isset($_POST['exec']) && !empty($_POST['exec'])) {
    $funcion = $_POST['exec'];
    $ejecutar = new UsuariosAjax();
    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch($funcion) {

        case 'registrarUsuario': 
            $ejecutar -> registrarUsuario();
            break;
        case 'funcion2': 
            $b -> accion2();
            break;
    }
}
