<?php 

require_once "Conection.php";


class UsuarioModel {

    static public function showUsers($table, $item, $value) {
        if($item != null) {
            $data = Conection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
            $data -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $data -> execute();

			return $data -> fetch();
        } else {
            $data = Conection::connect()->prepare("SELECT * FROM $table");

			$data -> execute();

			return $data -> fetchAll();
        }
    }

    static public function registrarUsuario($datos) {

        $request = null;

        if(isset($data["idUsuario"])) {
            $request = Conection::connect()->prepare("CALL registrarUsuario(?,?,?,?,?)");

            $request->bindParam("1", $datos["idUsuario"], PDO::PARAM_INT);
            $request->bindParam("2", $datos["idEmpleado"], PDO::PARAM_INT);
            $request->bindParam("3", $datos["usuario"], PDO::PARAM_STR);
            $request->bindParam("4", $datos["clave"], PDO::PARAM_STR);
            $request->bindParam("5", $datos["idEstado"], PDO::PARAM_INT);

        } else {
            $request = Conection::connect()->prepare("CALL registrarUsuario(NULL,?,?,?,?)");

            $request->bindParam("1", $datos["idEmpleado"], PDO::PARAM_INT);
            $request->bindParam("2", $datos["usuario"], PDO::PARAM_STR);
            $request->bindParam("3", $datos["clave"], PDO::PARAM_STR);
            $request->bindParam("4", $datos["idEstado"], PDO::PARAM_INT);
        }
        
        $request->execute();
        return $request -> fetch();
    }
}