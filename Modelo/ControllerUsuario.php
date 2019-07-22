<?php
    include_once 'clase-conexionPDO.php';
class ControllerUsuario{

    public static function agregarUsuario($usuario){
        
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
          
        $sql = 'CALL SP_ADD_USER(:in_nombreU, :in_email, :in_contrasena, :in_tipoUsuario, @id, @mensaje)';
        $resultado = $conexion->prepare($sql);

        $nombreU = $usuario->getNombreUsuario();
        $email = $usuario->getCorreo();
        $contrasena = $usuario->getContrasenia();
        $tipoUsuario = 2; /*TURISTA*/ 
    
        // enviando parametros al procedimiento
        $resultado->bindParam(':in_nombreU', $nombreU, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_email', $email, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_contrasena', $contrasena, PDO::PARAM_STR, 255);
        $resultado->bindParam(':in_tipoUsuario', $tipoUsuario, PDO::PARAM_INT);
       
        // ejecutando la consulta
        $resultado->execute();
        $resultado->closeCursor(); 

        // recuperando el parametro de salida del procedimiento
        $salida = $conexion->query('select @id');
        $id = $salida->fetchColumn();
        

        if ($id!=null) {
           return $id;
        }else{
            $id = 0;
            return $id;
        }
    }

    public static function obtenerUsuario($id){
            Conexion::abrirConexion();
            $conexion = Conexion::obtenerConexion();

            $sql = "SELECT * FROM usuario WHERE idusuario= :id";

            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(array("id" => $id));
            $data = array();

            foreach ($sentencia as $fila) {
                $data[] = $fila; 
            }

            echo json_encode($data);
    }

    public static function login($email, $contrasena){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = 'CALL SP_LOGIN(:in_pemail, :in_pcontrasena, @tipoUsuario, @usuarioID)';
        $resultado = $conexion->prepare($sql);
        $resultado->bindParam(':in_pemail', $email, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_pcontrasena', $contrasenia, PDO::PARAM_STR, 100);

        $resultado->execute();
        $resultado->closeCursor(); 

        $salida = $conexion->query('select @tipoUsuario');
        $tipo = $salida->fetchColumn();

        $salida = $conexion->query('select @usuarioID');
        $usuario = $salida->fetchColumn();

       

        $data = array("usuario" => $usuario, "tipo" => $tipo);

        return json_encode($data);


    }
}
?>