<?php 
include_once('clase-conexionPDO.php');

class Guia{
    
    public static function notificaciones($email,$info){
        $asunto = "Notificacion de los tours Asignados";

        $message = "De: Administracion ToursIndia \n";
        $message .= "Tours: $info";

        mail($email, $asunto, $message);
    }

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

    public static function obtenerTours_por_GuiaID($id){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT * FROM VW_TOURS_GUIA WHERE idGuia='$id'";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $fila = array();

        foreach ($sentencia as $toursGuia){
            $fila[] = $toursGuia;
        }

        echo json_encode($fila);
    }

    public static function obtenerGuiasOption(){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT * FROM VIEW_Perfil_Usuario_Guia";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
		
		$guias = array();

		foreach ($sentencia as $guia) {
			$guias[] = $guia; 
		}

		echo json_encode($guias);
    }
    
    public static function obtenerGuia_ID($id){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT * FROM view_perfil_usuario_guia WHERE idGuia = '$id'";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $guide = array();
        foreach ($sentencia as $row){
            $guide[] = $row;
        }
        echo json_encode($guide);
    }

}

?>