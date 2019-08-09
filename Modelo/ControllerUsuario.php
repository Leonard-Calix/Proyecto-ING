<?php
    include_once 'clase-conexionPDO.php';
    session_start();

class ControllerUsuario{

    public static function nombre_existe($nombreU){
        $nombre_existe = true;
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE nombreUsuario = :nombre";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':nombre', $nombreU, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $nombre_existe = true;
                } else {
                    $nombre_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $nombre_existe;
    }

    public static function email_existe($email){
        $email_existe = true;
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM usuario WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)) {
                    $email_existe = true;
                } else {
                    $email_existe = false;
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $email_existe;
    }

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

    public static function obtenerProfile_id($id){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
        
        $sql = "SELECT * FROM VIEW_Perfil_Usuarios WHERE idUsuario ='$id'";
        
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        
        $json = array();

        foreach ($sentencia as $fila) {
            $json[] = $fila; 
        }

        echo json_encode($json);
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

    public static function editarUsuario($profiles){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
          
        $sql = 'CALL SP_UPDATE_PERSON_USER(:in_nombreC, :in_apellidos, :in_identidad, :in_telefono, :in_genero, :in_direccion,
                :in_nombreU,:in_email,:in_tipoUsuario,:idUpdate,@mensaje)';
        $resultado = $conexion->prepare($sql);

        $nombre = $profiles->getNombre();
        $apellido = $profiles->getApellidos();
        $numeroId = $profiles->getIdentidad();
        $telefono = $profiles->getTelefono();
        $genero = $profiles->getGenero();
        $direccion = $profiles->getDireccion();
        $nombreU = $profiles->getNombreUsuario();
        $email = $profiles->getCorreo();
        $tipoUsuario = $profiles->getTypeUser();
        $idUpdate = $profiles->getId();

        $resultado->bindParam(':in_nombreC',$nombre, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_apellidos',$apellido, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_identidad',$numeroId, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_telefono',$telefono, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_genero',$genero, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_direccion',$direccion, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_nombreU', $nombreU, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_email',$email, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_tipoUsuario',$tipoUsuario, PDO::PARAM_INT);
        $resultado->bindParam(':idUpdate', $idUpdate, PDO::PARAM_INT);

        $resultado->execute();
        $resultado->closeCursor(); 
        
        $salida = $conexion->query('select @mensaje');
        $mensaje = $salida->fetchColumn();

       if($mensaje!=NULL){
           return $mensaje;
       }else{
           return 0;
       }

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
        $mensaje = $salida->fetchColumn();

        if($mensaje!=NULL){
            return 1;
        }else{
            return 0;
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

        $sql = 'CALL SP_LOGIN(:pemail, :pcontrasena, @tipo, @id)';
        $resultado = $conexion->prepare($sql);
        $resultado->bindParam(':pemail', $email, PDO::PARAM_STR, 45);
        $resultado->bindParam(':pcontrasena', $contrasena, PDO::PARAM_STR, 255);
        $resultado->execute();

        $resultado->closeCursor(); 
      
        $salida = $conexion->query('select @tipo, @id')->fetch();
        $tipo = $salida['@tipo'];
        $usuario = $salida['@id'];

        if ($tipo!=null && $usuario != null ) {
           $_SESSION["usuario"] = $usuario;
           $_SESSION["tipo"] = $tipo;
        }

        $data = array("usuario" => $usuario, "tipo" => $tipo);

        return json_encode($data);
    }

    public static function ObtenerGuias_D(){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT u.nombreUsuario,  p.nombreCompleto, p.Apellidos, u.email, idGuia, p.idPersona, p.direccion FROM guia g
                INNER JOIN usuario u ON u.idUsuario=g.idUsuario
                INNER JOIN persona p ON p.idPersona=u.idPersona;";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $guias = array();
        
        foreach ($sentencia as $guia) {
            $guias[] = $guia; 
        }

        echo json_encode($guias);
    } 

    public static function obtenerGuias(){
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();

        $sql = "SELECT g.idGuia, p.nombreCompleto FROM guia g
        INNER JOIN usuario u ON u.idUsuario=g.idUsuario 
        INNER JOIN persona p ON p.idPersona=u.idUsuario";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();

        $guias = array();
        
        foreach ($sentencia as $guia) {
            $guias[] = $guia; 
        }

        echo json_encode($guias);
    }

    public static function agregarGuia($usuario){
        
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
          
        $sql = 'CALL SP_ADD_USER(:in_nombreU, :in_email, :in_contrasena, :in_tipoUsuario, @id, @mensaje)';
        $resultado = $conexion->prepare($sql);

        $nombreU = $usuario->getNombreUsuario();
        $email = $usuario->getCorreo();
        $contrasena = $usuario->getContrasenia();
        $tipoUsuario = 3; /*TURISTA*/ 
    
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
}
?>