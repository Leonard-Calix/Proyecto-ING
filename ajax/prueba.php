<?php 

	include("../clases/clase-conexion.php");

	$conexion = new Conexion();

			$sql = "SELECT * FROM estados";

			$resultado = $conexion->ejecutarConsulta($sql);

			$estados = array();

			while ( $estado = $conexion->obtenerFila($resultado) ) {
				$estados[] = $estado; 
			}

			echo json_encode($estados);








 ?>