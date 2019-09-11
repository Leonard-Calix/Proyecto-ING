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

	public function __construct($idTours,$nombre,$descripcion,$fechaInicio,$fechaFin,$precio,$cupos,$calificacion,$IdEstados,$idGuia){
		$this->idTours	 = $idTours	;
		$this->nombre	 = $nombre	;
		$this->descripcion = $descripcion;
		$this->fechaInicio = $fechaInicio;
		$this->fechaFin = $fechaFin;
		$this->precio = $precio;
		$this->cupos = $cupos	;
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


	public static function obtenerToursEstados($idEstado){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT * FROM view_populares WHERE estado='$idEstado'";
		$resultado = $conexion->prepare($sql);
		$resultado ->execute();

		$tours = array();

		foreach ($resultado as $tour) {
			$tours[] = $tour; 
		}

		echo json_encode($tours);
	}



	public static function obtenerHoteles($id){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT h.nombreHotel, h.idHotel FROM hotel h 
				WHERE h.idEstados = (SELECT t.idEstados FROM tours t WHERE t.idTours='$id' )";
				
		$resultado = $conexion->prepare($sql);
		$resultado ->execute();

		$tours = array();

		foreach ($resultado as $tour) {
			$tours[] = $tour; 
		}

		echo json_encode($tours);
	}

	public static function obtenerTourSinHotel(){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT idTours, nombre FROM tours t WHERE t.idTours NOT IN ( SELECT h.idTours FROM hotel h )";
		$resultado = $conexion->prepare($sql);
		$resultado ->execute();

		$tours = array();

		foreach ($resultado as $tour) {
			$tours[] = $tour; 
		}

		echo json_encode($tours);
	}

	public static function tours(){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT t.idtours id, t.nombre Nombre_Tour, t.precio Precio_Tours FROM tours t 
				INNER JOIN estados e ON e.idEstados=t.idestados;";
		$resultado = $conexion->prepare($sql);
		$resultado ->execute();

		$tours = array();

		foreach ($resultado as $tour) {
			$tours[] = $tour; 
		}

		echo json_encode($tours);
	}

	public static function detalleTours($id){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT * FROM detalles_tours WHERE id='$id'";
		$resultado = $conexion->prepare($sql);
		$resultado ->execute();

		$tours = array();

		foreach ($resultado as $tour) {
			$tours[] = $tour; 
		}

		echo json_encode($tours);
	}

	public static function obtenerTours_editar($id){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT * FROM detalles_tours  WHERE id='$id'";
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

	public function agregar(){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = 'CALL ADD_TOURS(:pnombre, :pdescripcion, :pfechaInicio, :pfechaFin, :pprecio, :pcupos, :pcalificacion, :pidEstados, :pidGuia, @pidInsertado, @pMensaje)';
		
		$resultado = $conexion->prepare($sql);

        // enviando parametros al procedimiento
		$resultado->bindParam(':pnombre', $this->nombre, PDO::PARAM_STR,45);
		$resultado->bindParam(':pdescripcion', $this->descripcion, PDO::PARAM_STR,255);
		$resultado->bindParam(':pfechaInicio', $this->fechaInicio, PDO::PARAM_STR );
		$resultado->bindParam(':pfechaFin',$this->fechaFin, PDO::PARAM_STR);
		$resultado->bindParam(':pprecio', $this->precio, PDO::PARAM_INT);
		$resultado->bindParam(':pcupos', $this->cupos, PDO::PARAM_INT);
		$resultado->bindParam(':pcalificacion', $this->calificacion, PDO::PARAM_INT);
		$resultado->bindParam(':pidEstados', $this->IdEstados, PDO::PARAM_INT);
		$resultado->bindParam(':pidGuia', $this->idGuia, PDO::PARAM_INT);

		$resultado->execute();
		$resultado->closeCursor(); 

		//":date"=>date("Y-m-d H:i:s", strtotime($date)), PDO::PARAM_STR)
      
        $salida = $conexion->query('select @pidInsertado, @pMensaje')->fetch();
        $id = $salida['@pidInsertado'];
        $mensaje = $salida['@pMensaje'];

        
        if ($mensaje!= null && $id!=null) {
        	return $id;
        }else{
        	return 0;
        }

     
	}

	public function editarTours(){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = 'CALL EDITAR_TOURS(:pidActualizar, :pnombre, :pdescripcion, :pfechaInicio, :pfechaFin, :pprecio, :pcupos, :pcalificacion, :pidEstados, :pidGuia, @pres, @pMensaje)';
		
		$resultado = $conexion->prepare($sql);

        // enviando parametros al procedimiento
		$resultado->bindParam(':pidActualizar', $this->idTours, PDO::PARAM_INT);
		$resultado->bindParam(':pnombre', $this->nombre, PDO::PARAM_STR,45);
		$resultado->bindParam(':pdescripcion', $this->descripcion, PDO::PARAM_STR,255);
		$resultado->bindParam(':pfechaInicio', $this->fechaInicio, PDO::PARAM_STR );
		$resultado->bindParam(':pfechaFin',$this->fechaFin, PDO::PARAM_STR);
		$resultado->bindParam(':pprecio', $this->precio, PDO::PARAM_INT);
		$resultado->bindParam(':pcupos', $this->cupos, PDO::PARAM_INT);
		$resultado->bindParam(':pcalificacion', $this->calificacion, PDO::PARAM_INT);
		$resultado->bindParam(':pidEstados', $this->IdEstados, PDO::PARAM_INT);
		$resultado->bindParam(':pidGuia', $this->idGuia, PDO::PARAM_INT);

		$resultado->execute();
		$resultado->closeCursor(); 

		//":date"=>date("Y-m-d H:i:s", strtotime($date)), PDO::PARAM_STR)
      
        $salida = $conexion->query('select @pres, @pMensaje')->fetch();
        $pres = $salida['@pres'];
        $mensaje = $salida['@pMensaje'];
     
        if ($mensaje!= null && $pres!=null) {
        	return $pres;
        }else{
        	return 0;
        }
     
	}

	public static function removeTours($id){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = 'CALL DELETE_TOURS(:pidBorrar, @pMensaje)';
		
		$resultado = $conexion->prepare($sql);

		$resultado->bindParam(':pidBorrar', $id, PDO::PARAM_INT);
		$resultado->execute();
		$resultado->closeCursor(); 
		
		$salida = $conexion->query('select @pMensaje');
        $mensaje = $salida->fetchColumn();

         if ($mensaje!=null ) {
        	return 1;
        }else{
        	return 0;
        }

	}


	public static function asignarHotel($idHotel, $idTours){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = 'CALL SP_ASIGNA_HOTEL(:_idHotel, :_idTours, @_mensaje)';
		$resultado = $conexion->prepare($sql);

		$resultado->bindParam(':_idHotel', $idHotel, PDO::PARAM_INT);
		$resultado->bindParam(':_idTours', $idTours, PDO::PARAM_INT);

		$resultado->execute();
		$resultado->closeCursor(); 

		$salida = $conexion->query('select @_mensaje');
        $mensaje = $salida->fetchColumn();
   

        if ($mensaje!=null) {
        	return $mensaje;
        }else{
        	return -1;
        }
		
	} 

	public static function obtenerGuiasT(){
		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT * FROM VIEW_Perfil_Usuario_Guia";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
		
		$guias = array();

		foreach ($sentencia as $guia) {
			$guias[] = $guia; 
		}

		echo json_encode($guias);
	}

	public static function validarFecha($fechaInicio, $fechafin){
		$todayh = getdate();

		$d = $todayh["mday"];
		$m = $todayh["mon"];
		$y = $todayh["year"];
	
		$fechaActual = date( "Y-m-d", strtotime($d-$m-$y) );
		$fecha1 = date( "Y-m-d", strtotime($fechaInicio) );
		$fecha2 = date( "Y-m-d", strtotime($fechafin) );

		if ( $fecha1 > $fechaActual && $fecha2 > $fecha1 ) {
			return 1;
		}else{
			return 0;
		}

	}


	public static function obtenerToursDetalle($id){

		Conexion::abrirConexion();
		$conexion = Conexion::obtenerConexion();

		$sql = "SELECT t.idtours, T.nombre tours, T.descripcion, T.cupos, DATEDIFF(T.fechaFin, T.fechaInicio) duracion, CONVERT(t.fechaInicio, DATE) fecha1,      CONVERT(t.fechaFin, DATE) fecha2, T.precio, T.calificacion, 
		E.nombre estado, H.idHotel, H.nombreHotel, P.nombreCompleto nombreGuia, P.Apellidos  		
		FROM TOURS T 
		INNER JOIN hotel H ON H.idTours = T.idTours
		INNER JOIN guia G ON G.idGuia = T.idGuia 
		INNER JOIN estados E ON E.idEstados = T.idEstados
		INNER JOIN usuario U ON U.idUsuario = G.idUsuario
		INNER JOIN persona P ON P.idPersona = U.idPersona
		WHERE t.idtours='$id'";

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
		
		$tour = array();

		foreach ($sentencia as $row) {
			$tour[] = $row; 
		}

		echo json_encode($tour);

	}

	public function toString(){
			return "IdTours: " . $this->idTours . 
				" Nombre: " . $this->nombre . 
				" Descripcion: " . $this->descripcion . 
				" FechaInicio: " . $this->fechaInicio . 
				" FechaFin: " . $this->fechaFin . 
				" Precio: " . $this->precio . 
				" Cupos: " . $this->cupos . 
				" Calificacion: " . $this->calificacion . 
				" iDEstados: " . $this->IdEstados . 
				" iDGuia: " . $this->idGuia;
		}

}


	


?>