<?php

	class Usuario{

		private $nombreUsuario;
		private $correo;
		private $contrasenia;
		private $idPersona;

		public function __construct($nombreUsuario, $correo, $contrasenia, $idPersona){
			$this->nombreUsuario = $nombreUsuario;
			$this->correo	 = $correo	;
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

		public static function agregarUsuario(){
			$conexion = new PDO("mysql:host=localhost;dbname=toursindia", "root", "");
			
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$identidad = "";
			$telefono = "";
			$genero = "";
			$direccion = "";
			$correo = $_POST["correo"];
			$usuario = $_POST["usuario"];
			$contrasenia = $_POST["contrasenia"];
			
			/*TIPO DE USUARIO 
			(1) ADMIN 
			(2) TURISTA
			(3) GUIA*/ 
			$tipoUsuario = 2;
		
			$sql = 'CALL SP_ADD_USER(:in_nombre, :in_apellido, :in_identidad, :in_telefono, :in_genero, :in_direccion, :in_correo, :in_usuario, :in_contrasena, in_tipo, @pMensaje)';
			$resultado = $conexion->prepare($sql);
		
			$resultado->bindParam(':in_nombre', $nombre, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_apellido', $apellido, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_identidad', $identidad, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_telefono', $telefono, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_genero', $genero, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_direccion', $apellido, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_correo', $correo, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_usuario', $usuario, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_contrasena', $contrasena, PDO::PARAM_STR, 100);
			$resultado->bindParam(':in_tipo', $tipoUsuario, PDO::PARAM_INT);
			
			$resultado->execute();
			$resultado->closeCursor(); 

			$salida = $conexion->query('select @mensaje');
			$mensaje = $salida->fetchColumn();
			
			return $mensaje;
			
		}

	}
?>