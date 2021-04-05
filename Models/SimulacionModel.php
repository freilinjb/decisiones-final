<?php 

require_once "Conection.php";

class SimulacionModel { 

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

	static public function eliminarEvento($dato){

        // echo "evento: " . $dato;
        // die;
		$stmt = Conection::connect()->prepare("DELETE FROM evento WHERE idEvento = :id");

		$stmt -> bindParam(":id", $dato, PDO::PARAM_INT);

        return ($stmt -> execute()) ? true : false;
		$stmt = null;
	}

    static public function registrarEvento($datos){

        if($datos["evento"]) {
            $stmt = Conection::connect()->prepare("INSERT INTO evento(idFase, idDistribucion, evento, descripcion, estado) 
            VALUES (:idFase, :idDistribucion, :evento, :descripcion, :estado)");

            $stmt->bindParam(":idFase", $datos["idFase"], PDO::PARAM_INT);
            $stmt->bindParam(":idDistribucion", $datos["idDistribucion"], PDO::PARAM_INT);
            $stmt->bindParam(":evento", $datos["evento"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        } else {
            // $stmt = Conection::connect()->prepare("INSERT INTO $tabla(nombre, documento, email, telefono, direccion, fecha_nacimiento) VALUES (:nombre, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");

            // $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            // $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
            // $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            // $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            // $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            // $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
        }

        return $stmt->execute() ? true : false;
    }

    static public function registrarProducto($datos){

        // print_r($datos);
        // die;

        if($datos["producto"]) {
            $stmt = Conection::connect()->prepare("INSERT INTO producto(producto, probabilidad, estado) 
            VALUES (:producto, :probabilidad, :estado)");

            $stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
            $stmt->bindParam(":probabilidad", $datos["probabilidad"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_BOOL);
        } else {
            // $stmt = Conection::connect()->prepare("INSERT INTO $tabla(nombre, documento, email, telefono, direccion, fecha_nacimiento) VALUES (:nombre, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");

            // $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            // $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
            // $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            // $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            // $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            // $stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
        }

        return $stmt->execute() ? true : false;
    }

    static public function eliminarProducto($dato){

        // echo "evento: " . $dato;
        // die;
		$stmt = Conection::connect()->prepare("DELETE FROM producto WHERE idProducto = :id");

		$stmt -> bindParam(":id", $dato, PDO::PARAM_INT);

        return ($stmt -> execute()) ? true : false;
		$stmt = null;
	}
}