<?php 
include_once('clase-conexionPDO.php');

class Guia{
      
    public static function obtenerTours_por_Guia(){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT * FROM VW_TOURS_GUIA";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $toursGuias = array();

        foreach ($sentencia as $toursGuia){
            $toursGuias[] = $toursGuia;
        }

        echo json_encode($toursGuias);
    }

    
}

?>