<?php 
include_once('clase-conexionPDO.php');

class Guia{
    
    public static function notificaciones($email,$info){
        $asunto = "Notificacion de los tours Asignados";

        $message = "De: Administracion ToursIndia \n";
        $message .= "Tours: $info";

        $header = "From: noreply@example.com". "\r\n";
        $header .= "Reply-To: noreply@example.com". "\r\n";
        $header .= "X-Mailer: PHP/". phpversion();

        $msgJSON = array();
        if(mail($email, $asunto, $message, $header)){
            $msgJSON = array("mensaje"=>"Envio de correo Exitoso", "codigo"=>1);
            echo json_encode($msgJSON);
        }else{
            $msgJSON = array("mensaje"=>"Envio de correo Fallo", "codigo"=>0);
            echo json_encode($msgJSON);
        }
    }

    public static function obtenerTours_por_Guia(){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT * FROM vw_tours_guia";
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

        $sql = "SELECT * FROM vw_tours_guia WHERE idGuia='$id'";
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

		$sql = "SELECT * FROM view_perfil_usuario_guia";
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

    public static function toursAsignadosPorGuia($idUsuario){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT t.idtours, t.nombre, t.descripcion, e.nombre estado, t.calificacion, t.precio, t.cupos, DATEDIFF( t.fechaFin, t.fechaInicio ) dias,    CONVERT(t.fechaInicio, DATE) fechaInicio, CONVERT(t.fechaFin, DATE) fechaFin 
            FROM tours t 
            INNER JOIN estados e ON e.idEstados=t.idEstados WHERE idGuia = ( SELECT idGuia FROM guia WHERE idUsuario='$idUsuario')";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $tours = array();
        foreach ($sentencia as $row){
            $tours[] = $row;
        }
        echo json_encode($tours);
    }

    public static function informacionGuia($Usuario){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT p.nombreCompleto, p.Apellidos, p.numeroIdentidad, p.telefono, p.genero, p.direccion, u.nombreUsuario, u.email FROM guia g
                INNER JOIN usuario u ON u.idUsuario=g.idUsuario
                INNER JOIN persona p ON p.idPersona=u.idPersona
                WHERE g.idUsuario='$Usuario'";
                

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $guia = array();

        foreach ($sentencia as $row){
            $guia[] = $row;
        }

        echo json_encode($guia);


    }
    
}

?>