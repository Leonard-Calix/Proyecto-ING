<?php

include 'clase-conexionPDO.php';

class Comentarios{

    //Funcion que devuelve todos los comentarios
    public static function obtenerComentarios(){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = 'SELECT * FROM view_comentarios';
        $resultado = $conexion ->prepare($sql);
        $resultado -> execute();

        $comentarios = array();

        foreach($resultado as $comentario){
            $comentarios[] = $comentario;
        }

        echo json_encode($comentarios);

        Conexion::cerrarConexion();
    }

    //Funcion para obtener un comentario especifico
    public static function obtenerComentario($tour, $usuario){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT * FROM view_comentarios WHERE idTours='$tour' AND idUsuario='$usuario'";
        $resultado = $conexion ->prepare($sql);
        $resultado -> execute();

        $comentarios = array();

        foreach($resultado as $comentario){
            $comentarios[] = $comentario;
        }

        echo json_encode($comentarios);

        Conexion::cerrarConexion();
    }

    //Funcion para obtener comentarios por tour
   public static function obtenerComentarioTour($tourID){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT * FROM view_comentarios WHERE idTours='$tourID'";
        $resultado = $conexion ->prepare($sql);
        $resultado -> execute();

        $comentariosTour = array();

        foreach($resultado as $comentario){
            $comentariosTour[] = $comentario;
        }

        echo json_encode($comentariosTour);

        Conexion::cerrarConexion();
   }
    //Funcion para buscar un comentario especifico
    public static function searchComentario($search){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
        $sql = "SELECT * FROM view_comentarios WHERE Comentario LIKE :Comentario 
                                               OR nombreUsuario LIKE :nombreUsuario
                                               OR nombre LIKE :nombreTour";
        $resultado = $conexion ->prepare($sql);
        $param = array(
            ':Comentario' => '%'.$search.'%',
            ':nombreUsuario' => '%'.$search.'%',
            ':nombreTour' => '%'.$search.'%'
        );
        $resultado -> execute($param);

        $comentarios = array();

        foreach($resultado as $comentario){
            $comentarios[] = $comentario;
        }

        echo json_encode($comentarios);

        Conexion::cerrarConexion();
    }

    //Funcion para agregar comentarios
    public static function addComentarios($idUsuario, $idTour, $comentario){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = 'CALL ADD_COMENTARIOS(:comentario, :idusuario, :idtour, @mensaje)';
        $resultado = $conexion -> prepare($sql);
        
        $resultado -> bindParam(':comentario',$comentario, PDO::PARAM_STR,600);
        $resultado -> bindParam(':idusuario',$idUsuario, PDO::PARAM_INT);
        $resultado -> bindParam(':idtour',$idTour, PDO::PARAM_INT);

        $resultado -> execute();
        $resultado -> closeCursor();

        $salida = $conexion -> query('SELECT @mensaje');
        $mensaje = $salida -> fetchColumn();

        if($mensaje != 0){
            return 1;
        }else{
            return 0;
        }

    }

    //Funcion para eliminar comentarios
    public static function deleteComentario($id){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = 'CALL DELETE_COMENTARIOS(:id, @mensaje)';
        $resultado = $conexion -> prepare($sql);
        $resultado -> bindParam(':id', $id, PDO::PARAM_INT);

        $resultado -> execute();
        $resultado -> closeCursor();

        $salida = $conexion ->query('SELECT @mensaje');
        $mensaje = $salida -> fetchColumn();

        if($mensaje!=null){
            return 1;
        }else{
            return 0;
        }
    }
}