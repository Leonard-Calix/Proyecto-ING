<?php
    
class ControllerUsuario{

    public static function agregarUsuario($usuario){
        $conexion = new PDO("mysql:host=localhost;dbname=toursindia", "root", "");
        
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

   


   
}
?>