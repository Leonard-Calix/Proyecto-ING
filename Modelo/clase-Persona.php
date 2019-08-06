<?php
	include 'clase-conexionPDO.php';

	class Persona{

		private $nombre;
		private $apellidos;
		private $identidad;
		private $direccion;
		private $telefono;
		private $genero;

		public function __construct($nombre, $apellidos, $identidad, $direccion, $telefono, $genero){
			$this->nombre = $nombre;
			$this->apellidos = $apellidos;
			$this->identidad = $identidad;
			$this->direccion = $direccion;
			$this->telefono = $telefono;
			$this->genero = $genero;
		}

		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getApellidos(){
			return $this->apellidos;
		}

		public function setApellidos($apellidos){
			$this->apellidos = $apellidos;
		}

		public function getIdentidad(){
			return $this->identidad;
		}

		public function setIdentidad($identidad){
			$this->identidad = $identidad;
		}

		public function getDireccion(){
			return $this->direccion;
		}

		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}

		public function getTelefono(){
			return $this->telefono;
		}

		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function getGenero(){
			return $this->genero;
		}

		public function setGenero($genero){
			$this->genero = $genero;
		}

		public function toString(){
			return "Nombre: " . $this->nombre . 
				" Apellido: " . $this->apellidos . 
				" Identidad: " . $this->identidad . 
				" Direccion: " . $this->direccion . 
				" Telefono: " . $this->telefono . 
				" Genero: " . $this->genero;
		}

		public static function datos(){
			
			Conexion::abrirConexion();
  			$conexion = Conexion::obtenerConexion();

			$sql = "SELECT * FROM view_contacto";
			$sentencia = $conexion->prepare($sql);
			$resultado = $sentencia ->execute();
			
			$registo = array();

			foreach($resultado as $row) {
				$registo[] = $row; 
			}

			echo json_encode($registo);
		}

	}
?>