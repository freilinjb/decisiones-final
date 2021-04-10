<?php

require_once "Conection.php";

class DecisionModel
{

    static public function plantas($table, $item, $value)
    {
        $data = null;
        if ($item != null) {
            $data = Conection::connect()->prepare("SELECT idSector, descripcion FROM $table WHERE $item = :$item");
            $data->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $data->execute();
            return $data->fetch();
        } else {
            $data = Conection::connect()->prepare("SELECT * FROM $table");
            $data->execute();

            return $data->fetchAll();
        }
    }

    static public function sectores($table, $item, $value)
    {
        $data = null;
        if ($item != null) {
            $data = Conection::connect()->prepare("SELECT idSector, descripcion FROM $table WHERE $item = :$item");
            $data->bindParam(":" . $item, $value, PDO::PARAM_STR);
            $data->execute();
            return $data->fetch();
        } else {
            $data = Conection::connect()->prepare("SELECT * FROM $table");
            $data->execute();

            return $data->fetchAll();
        }
    }

    static public function getCumplimientoPorFecha($datos)
    {
        // die;
        $condicion = "";
        $condicion .= $datos->sector == 0 ? "" : " AND s.idSector IN ( $datos->sector )";
        $condicion .= $datos->planta == 0 ? "" : " AND p.idPlanta = ( $datos->planta )";

        $sql = "SELECT t.idTiempoProduccion, date(t.fechaInicio) AS fecha, s.descripcion AS sector, t.meta, t.cumplimiento, ROUND((t.cumplimiento/t.meta) * 100,2) AS porcentaje FROM tiempoproduccion t
                    INNER JOIN  consecuencia c ON c.idConsecuencia = t.idConsecuencia
                    INNER JOIN planta p ON p.idPlanta = t.idPlanta 
                    INNER JOIN sector s ON s.idSector = p.idSector
                    INNER JOIN causa c1 ON c1.idCauda = t.idCausa
                    INNER JOIN problema p1 ON p1.idProblema = t.idProblema
                    WHERE UNIX_TIMESTAMP(t.fechaInicio) BETWEEN UNIX_TIMESTAMP('" . $datos->fechaInicio ."') AND UNIX_TIMESTAMP('" . $datos->fechaFinal ."') $condicion
                    ORDER BY 1";


        $respuesta = Conection::connect()->prepare($sql);

        $respuesta->bindParam("1", $datos->fechaInicio, PDO::PARAM_STR);
        $respuesta->bindParam("2", $datos->fechaFinal, PDO::PARAM_STR);

        $respuesta->execute();

        return $respuesta->fetchAll();
    }
}
