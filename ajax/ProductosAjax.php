<?php

require_once "../Models/ProductoModel.php";

class ProductosAjax {
    public $idProducto;
    public $idCategoria;
    public $idTipoProducto;
    public $idSubTipoProducto;

    public function getCategorias() {

        $tabla = "categoria";

        $respuesta = ProductoModel::getData($tabla, null, null);
        echo  json_encode($respuesta);
    }

    public function getTipo()
    {

        $item = "idCategoria";
        $valor = $this->idCategoria;

        $respusta = ProductoModel::getData("tipo_categoria_v",$item, $valor);
        echo json_encode($respusta);
    }
    public function getSubTipo()
    {

        $item = "idTipo";
        $valor = $this->idTipoProducto;

        $respusta = ProductoModel::getData("subtipo",$item, $valor);
        echo json_encode($respusta);
    }
}

/*=============================================
Comprobamos que el valor no venga vacío
=============================================*/	
if(isset($_POST['exec']) && !empty($_POST['exec'])) {

    $funcion = $_POST['exec'];
    $ejecutar = new ProductosAjax();
    //En función del parámetro que nos llegue ejecutamos una función u otra
    switch($funcion) {

        case 'getCategorias': 
            $ejecutar -> getCategorias();
            break;
        case 'getTipo': 
            if(isset($_POST['idCategoria'])) {

                $ejecutar->idCategoria = $_POST['idCategoria'];
                $ejecutar -> getTipo();
            } else {
                print_r("error");
            }
            break;
        case 'getSubTipo': 
            if(isset($_POST['idTipo'])) {

                $ejecutar->idTipoProducto = $_POST['idTipo'];
                $ejecutar -> getSubTipo();
            } else {
                print_r("error");
            }
            break;
    }
}