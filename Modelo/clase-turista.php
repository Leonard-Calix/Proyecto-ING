<?php 

include_once('clase-conexionPDO.php');
  
class Turista{
    
    public static function obtenerTours_por_Turista($id){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT tou.nombre nombreTours, tou.precio, CONVERT(tou.fechaInicio, DATE) fechaInicio, CONVERT(tou.fechaFin, DATE) fechaFin, 
                 DATEDIFF( tou.fechaFin, tou.fechaInicio ) dias, t.idUsuario idUsuario, tu.idTours idTours, tu.idTurista idTurista, p.nombreCompleto nombre, u.nombreUsuario usuario, tou.descripcion FROM toursturista tu
                INNER JOIN tours tou ON tou.idTours=tu.idTours
                INNER JOIN turista t ON t.idTurista=tu.idTurista
                INNER JOIN usuario u ON u.idUsuario=t.idUsuario
                INNER JOIN persona p ON p.idPersona=u.idPersona
                WHERE tu.idTurista=( SELECT idTurista FROM turista  WHERE idUsuario='$id')";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $toursGuias = array();

        foreach ($sentencia as $toursGuia){
            $toursGuias[] = $toursGuia;
        }

        echo json_encode($toursGuias);
    }

    public static function obtenerId($usuario){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
        $sql = "SELECT idTurista FROM turista  WHERE idUsuario='$usuario'";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $turista = array();

        foreach ($sentencia as $t){
            $turista[] = $t;
        }

       return json_encode($turista[0]["idTurista"]);
    }

    public static function informacion($id){
         Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT p.nombreCompleto, p.Apellidos, u.nombreUsuario, u.email FROM turista t
                INNER JOIN usuario u ON u.idUsuario=t.idUsuario
                INNER JOIN persona p ON p.idPersona=u.idPersona
                WHERE u.idUsuario='$id'";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $turista = array();

        foreach ($sentencia as $t){
            $turista[] = $t;
        }

        echo json_encode($turista);

    }

    public static function turistaPorTours($id){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT t.idTours, t.nombre, t.precio, h.nombreHotel, p.nombreCompleto, p.Apellidos FROM toursturista tt
                INNER JOIN tours t ON t.idTours = tt.idTours
                INNER JOIN hotel h ON h.idTours = t.idTours
                INNER JOIN turista tu ON tu.idTurista = tt.idTurista
                INNER JOIN usuario u ON u.idUsuario = tu.idUsuario
                INNER JOIN persona p ON p.idPersona = u.idPersona
                WHERE t.idGuia = (SELECT idGuia FROM guia WHERE idUsuario='$id')";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $turistas = array();

        foreach ($sentencia as $t){
            $turistas[] = $t;
        }

        echo json_encode($turistas);
    } 


}

?>