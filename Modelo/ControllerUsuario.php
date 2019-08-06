<?php
    include_once 'clase-conexionPDO.php';
    session_start();

class ControllerUsuario{

    public static function agregarUsuario($usuario,$tipoUsuario){
        
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
          
        $sql = 'CALL SP_ADD_USER(:in_nombreU, :in_email, :in_contrasena, :in_tipoUsuario, @id, @mensaje)';
        $resultado = $conexion->prepare($sql);

        $nombreU = $usuario->getNombreUsuario();
        $email = $usuario->getCorreo();
        $contrasena = $usuario->getContrasenia();
        #$tipoUsuario = 2; /*TURISTA*/ 
    
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

            $_SESSION["usuario"] = $usuario;
            $_SESSION["tipo"] = 2;

            
            return $id;

        }else{
            $id = 0;
            return $id;
        }
    }

    public static function obtenerProfiles(){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
        
        $sql = 'SELECT * FROM VIEW_Perfil_Usuarios';
        
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        
        $json = array();

        foreach ($sentencia as $fila) {
            $json[] = $fila; 
        }

        echo json_encode($json);

    }

    public static function editarUsuario($usuario){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
          
        $sql = 'CALL SP_UPDATE_PERSON_USER(:in_nombreU, :in_email, :in_contrasena, :in_tipoUsuario, @id, @mensaje)';
        $resultado = $conexion->prepare($sql);


    }

    public static function borrarUsuario($idUsuario){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = 'CALL SP_DELETE_USER(:id, @mensaje)';
        
        $resultado = $conexion->prepare($sql);
        $resultado->bindParam(':id',$idUsuario,PDO::PARAM_INT);

        $resultado->execute();

        $resultado->closeCursor(); 
        
        $salida = $conexion->query('select @mensaje');
        $mensaje = $salida['@mensaje'];

        return json_encode($mensaje);

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

        $sql = 'CALL SP_LOGIN(:pemail, :pcontrasena, @tipo, @id)';
        $resultado = $conexion->prepare($sql);
        $resultado->bindParam(':pemail', $email, PDO::PARAM_STR, 45);
        $resultado->bindParam(':pcontrasena', $contrasena, PDO::PARAM_STR, 255);
        $resultado->execute();

        $resultado->closeCursor(); 
      
        $salida = $conexion->query('select @tipo, @id')->fetch();
        $tipo = $salida['@tipo'];
        $usuario = $salida['@id'];

        if ( $tipo!=null && $usuario != null ) {
           $_SESSION["usuario"] = $usuario;
           $_SESSION["tipo"] = $tipo;
        }

        $data = array("usuario" => $usuario, "tipo" => $tipo);

        return json_encode($data);
    }

    public static function obtenerGuias(){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT * FROM view_guia";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $guias = array();
        
        foreach ($sentencia as $guia) {
            $guias[] = $guia; 
        }

        echo json_encode($guias);
    }
}
?>