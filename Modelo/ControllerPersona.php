<?php
class ControllerPersona {

    public static function agregarPersona($persona){
        include_once 'clase-conexionPDO.php';
        Conexion::abrirConexion();
        $conexion = Conexion::obtenerConexion();
          
        $sql = 'CALL SP_ADD_PERSON(:in_nombre, :in_apellido, :in_numeroId, :in_telefono, :in_genero, :in_direccion, @id, @mensaje)';
        $resultado = $conexion->prepare($sql);

        $nombre = $persona->getNombre();
        $apellido = $persona->getApellidos();
        $numeroId = $persona->getIdentidad();
        $telefono = $persona->getTelefono();
        $genero = $persona->getGenero();
        $direccion = $persona->getDireccion();

        // enviando parametros al procedimiento
        $resultado->bindParam(':in_nombre', $nombre, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_apellido', $apellido, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_numeroId', $numeroId, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_telefono', $telefono, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_genero', $genero, PDO::PARAM_STR, 100);
        $resultado->bindParam(':in_direccion', $direccion, PDO::PARAM_STR, 100);
        // ejecutando la consulta
        $resultado->execute();
        $resultado->closeCursor(); 

        // recuperando el parametro de salida del procediiento
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