<?php
	
	class Usuario{

		private $nombreUsuario;
		private $correo;
		private $contrasenia;
		private $idPersona;

		public function __construct($nombreUsuario, $correo, $contrasenia, $idPersona){
			$this->nombreUsuario = $nombreUsuario;
			$this->correo = $correo	;
			$this->contrasenia = $contrasenia;
			$this->idPersona = $idPersona;
		}

		public function getNombreUsuario(){
			return $this->nombreUsuario;
		}

		public function setNombreUsuario($nombreUsuario){
			$this->nombreUsuario = $nombreUsuario;
		}

		public function getCorreo(){
			return $this->correo;
		}

		public function setCorreo($correo){
			$this->correo = $correo	;
		}

		public function getContrasenia(){
			return $this->contrasenia;
		}

		public function setContrasenia($contrasenia){
			$this->contrasenia = $contrasenia;
		}

		public function getIdPersona(){
			return $this->idPersona;
		}

		public function setIdPersona($idPersona){
			$this->idPersona = $idPersona;
		}

		public static function obtenerUsuario($id){
			$conexion = new PDO("mysql:host=localhost;dbname=toursindia", "root", "");

            $sql = "SELECT * FROM usuario WHERE idUsuario=:id";

            $resultado = $conexion->prepare($sql);
            $resultado->execute(array("id" => $id));

            $usuario = array();

            foreach ($resultado as $fila) {
                $usuario[] = $fila; 
            }

            echo json_encode($usuario);
    }
		


	}
?>