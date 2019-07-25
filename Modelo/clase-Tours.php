<?php
	include 'clase-conexionPDO.php';
	
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
			Conexion::abrirConexion();
			$conexion = Conexion::obtenerConexion();
			  
			$sql = "SELECT * FROM view_populares";
			$resultado = $conexion->prepare($sql);
			$resultado ->execute();
			
			$tours = array();

			foreach ($resultado as $tour) {
				$tours[] = $tour; 
			}

			echo json_encode($tours);
		}

		public static function obtenerTours($id){
			Conexion::abrirConexion();
			$conexion = Conexion::obtenerConexion();

			$sql = "SELECT t.cupos, t.calificacion, t.fechaInicio, t.fechafin, t.nombre, t.descripcion, t.precio, c.comentario, 
					p.nombreCompleto, p.Apellidos FROM comentarios c 
					INNER JOIN usuario u ON u.idUsuario=c.idUsuario 
					INNER JOIN tours t ON t.idTours=c.idTours 
					iNNER JOIN persona p ON p.idPersona=u.idPersona
					WHERE idComentarios= :id";

			$sentencia = $conexion->prepare($sql);
			$sentencia -> bindParam(':id', $id, PDO::PARAM_INT);
			$sentencia -> execute();
			
			$tours = array();

			foreach ($sentencia as $tour) {
				$tours[] = $tour; 
			}

			echo json_encode($tours);
		}

		public static function obtenerEstados(){
			Conexion::abrirConexion();
			$conexion = Conexion::obtenerConexion();

			$sql = "SELECT * FROM estados";
			$sentencia = $conexion->prepare($sql);
			$sentencia -> execute();

			$estados = array();

			foreach ($sentencia as $estado) {
				$estados[] = $estado; 
			}

			echo json_encode($estados);
		}

		public static function obtenerImg($id){
			Conexion::abrirConexion();
			$conexion = Conexion::obtenerConexion();

			$sql = "SELECT * FROM imagenes WHERE idtours= :id";

			$sentencia = $conexion->prepare($sql);
			$sentencia->execute(array("id" => $id));
			$imagenes = array();

			foreach ($sentencia as $img) {
				$imagenes[] = $img; 
			}

			echo json_encode($imagenes);
		}

	}
?>