<?php
	include 'clase-conexion.php';
	
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
			$conexion = new Conexion();

			$sql = "SELECT * FROM view_populares";
			$resultado = $conexion->ejecutarConsulta($sql);

			$tours = array();

			while ( $tour = $conexion->obtenerFila($resultado) ) {
				$tours[] = $tour; 
			}

			echo json_encode($tours);
		}

		public static function obtenerTours($id){
			$conexion = new Conexion();

			$sql = "SELECT t.cupos, t.calificacion, t.fechaInicio, t.fechafin, t.nombre, t.descripcion, t.precio, c.comentario, 
					p.nombreCompleto, p.apellidos FROM comentarios c 
					INNER JOIN usuario u ON u.idUsuario=c.idUsuario 
					INNER JOIN tours t ON t.idTours=c.idTours 
					iNNER JOIN persona p ON p.idpersona=u.idpersona
					WHERE idComentarios='$id'";

			$resultado = $conexion->ejecutarConsulta($sql);

			$tours = array();

			while ( $tour = $conexion->obtenerFila($resultado) ) {
				$tours[] = $tour; 
			}

			echo json_encode($tours);
		}

		public static function obtenerEstados(){
			$conexion = new Conexion();

			$sql = "SELECT * FROM estados";

			$resultado = $conexion->ejecutarConsulta($sql);

			$estados = array();

			while ( $estado = $conexion->obtenerFila($resultado) ) {
				$estados[] = $estado; 
			}

			echo json_encode($estados);
		}





	}
?>