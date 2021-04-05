<?php 

require_once "Conection.php";


class ProductoModel { 

    static public function getData($table, $item, $value) {
        $data = null;
        if($item != null) {
			$data = Conection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
            $data -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $data -> execute();
            return $data -> fetchAll();
            

		} else {
			$data = Conection::connect()->prepare("SELECT * FROM $table");
            $data -> execute();
            
			return $data -> fetchAll();
        }
		$data = null;
    }

	static public function eliminarProducto($tabla, $datos){

		$stmt = Conection::connect()->prepare("DELETE FROM $tabla WHERE idProducto = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        return ($stmt -> execute()) ? true : false;
		$stmt = null;
	}

    static public function registrarProducto($datos) {

        $request = null;

        if(isset($data["idProducto"])) {
            $request = Conection::connect()->prepare("CALL registrarProducto(?,?,?,?,?,?,?)");

            $request->bindParam("1", $datos["idProducto"], PDO::PARAM_INT);
            $request->bindParam("2", $datos["idCategoria"], PDO::PARAM_INT);
            $request->bindParam("3", $datos["idTipoProducto"], PDO::PARAM_INT);
            $request->bindParam("4", $datos["idSubTipo"], PDO::PARAM_INT);
            $request->bindParam("5", $datos["Producto"], PDO::PARAM_STR);
            $request->bindParam("6", $datos["Descripcion"], PDO::PARAM_STR);
            $request->bindParam("7", $datos["idEstado"], PDO::PARAM_INT);

        } else {
            $request = Conection::connect()->prepare("CALL registrarProducto(NULL,?,?,?,?,?,?)");

            $request->bindParam("1", $datos["idCategoria"], PDO::PARAM_INT);
            $request->bindParam("2", $datos["idTipoProducto"], PDO::PARAM_INT);
            $request->bindParam("3", $datos["idSubTipo"], PDO::PARAM_INT);
            $request->bindParam("4", $datos["producto"], PDO::PARAM_STR);
            $request->bindParam("5", $datos["descripcion"], PDO::PARAM_STR);
            $request->bindParam("6", $datos["idEstado"], PDO::PARAM_INT);
        }
        
        $request->execute();
        return $request -> fetch();
    }
}