<?php
	
	class Tours	{

		private $idTours;
		private $nombre;
		private $descripcion;
		private $fechaInicio;
		private $fechaFin;
		private $precio;
		private $cupos;
		private $calificacion;
		private $IdEstados;
		private $idGuia;

		public function __construct($idTours,$nombre,$descripcio,$fechaInici,$fechaFi,$preci,$cupos,$calificacio,$IdEstado,$idGuia){
			$this->idTours	 = $idTours	;
			$this->nombre	 = $nombre	;
			$this->descripcion = $descripcion;
			$this->fechaInicio = $fechaInicio;
			$this->fechaFin = $fechaFin;
			$this->precio = $precio;
			$this->cupos	 = $cupos	;
			$this->calificacion = $calificacion;
			$this->IdEstados = $IdEstados;
			$this->idGuia = $idGuia;
		}

		public function getIdTours	(){
			return $this->idTours	;
		}
		public function setIdTours	($idTours	){
			$this->idTours	 = $idTours	;
		}
		public function getNombre	(){
			return $this->nombre	;
		}
		public function setNombre	($nombre	){
			$this->nombre	 = $nombre	;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getFechaInicio(){
			return $this->fechaInicio;
		}
		public function setFechaInicio($fechaInicio){
			$this->fechaInicio = $fechaInicio;
		}
		public function getFechaFin(){
			return $this->fechaFin;
		}
		public function setFechaFin($fechaFin){
			$this->fechaFin = $fechaFin;
		}
		public function getPrecio(){
			return $this->precio;
		}
		public function setPrecio($precio){
			$this->precio = $precio;
		}
		public function getCupos	(){
			return $this->cupos	;
		}
		public function setCupos	($cupos	){
			$this->cupos	 = $cupos	;
		}
		public function getCalificacion(){
			return $this->calificacion;
		}
		public function setCalificacion($calificacion){
			$this->calificacion = $calificacion;
		}
		public function getIdEstados(){
			return $this->IdEstados;
		}
		public function setIdEstados($IdEstados){
			$this->IdEstados = $IdEstados;
		}
		public function getIdGuia(){
			return $this->idGuia;
		}
		public function setIdGuia($idGuia){
			$this->idGuia = $idGuia;
		}

		public static function mostrarTours(){
			
			$conexion = new PDO("mysql:host=localhost;dbname=toursindia", "root", "");

			$resultado = $conexion->prepare("SELECT * FROM view_populares");
			$resultado->execute();

			$data = array();

			foreach ($resultado as $fila ) {
			 	$data[] = $fila; 
			} 
				
			echo json_encode($data);
		}

		public static function obtenerTours($id){

			$conexion = new PDO("mysql:host=localhost;dbname=toursindia", "root", "");

			$sql = "SELECT t.cupos, t.calificacion, t.fechaInicio, t.fechafin, t.nombre, t.descripcion, t.precio, c.comentario, 
					p.nombreCompleto, p.apellidos FROM comentarios c 
					INNER JOIN usuario u ON u.idUsuario=c.idUsuario 
					INNER JOIN tours t ON t.idTours=c.idTours 
					iNNER JOIN persona p ON p.idpersona=u.idpersona
					WHERE idComentarios=:id";

			$resultado = $conexion->prepare($sql);
			$resultado->execute(array("id" => $id));
			$data = array();

			foreach ($resultado as $fila ) {
				$data[] = $fila; 
			
			}

			echo json_encode($data);
		}

		public static function obtenerEstados(){
			$conexion = new PDO("mysql:host=localhost;dbname=toursindia", "root", "");
			
			$resultados = $conexion->prepare("SELECT * FROM estados");
			$resultados->execute();
			$datos = array();

			foreach ($resultados as $fila) {
				$datos[]=$fila;
			}

			echo json_encode($datos);
		}

		public static function obtenerImg($id){
			$conexion = new PDO("mysql:host=localhost;dbname=toursindia", "root", "");

			$sql = "SELECT * FROM imagenes WHERE idtours=:id";
			$resultado = $conexion->prepare($sql);
			$resultado->execute(array("id" => $id));

			$imagenes = array();

			foreach ($resultado as $fila) {
				$imagenes[]=$fila;
			}

			echo json_encode($imagenes);
		}






	}
?>