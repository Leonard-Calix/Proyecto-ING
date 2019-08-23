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