<?php 

	include_once('../../Modelo/clase-Tours.php');

	switch ($_GET["accion"]) {
		
		case 'mostrar':
			Tours::mostrarTours();
		break;
		
		case 'obtenerTour':
			Tours::obtenerTours($_POST["id"]);
		break;

		case 'obtenerImagenes':
			Tours::obtenerImg($_POST["id"]);
		break;

		case 'obtenerEstado':
			Tours::obtenerEstados();
		break;

		case 'tours':
			Tours::tours();
		break;

		case 'obtenerHoteles':
			Tours::obtenerHoteles();
		break;

		case 'detalleTours':
			Tours::detalleTours($_POST["id"]);
		break;

		case 'infoTours':
			Tours::obtenerTours_editar($_POST["id"]);
		break;

		case 'agregarTours':
			$nombre = $_POST["nombre"];
			$descripcion = $_POST["descripcion"];
			$precio = intval($_POST["precio"]);
			$cupos = intval($_POST["cupos"]);
			$calificacion = intval($_POST["calificacion"]);
			$estado = intval($_POST["estado"]);
			$guia = intval($_POST["guia"]);
			$fechaI = date("Y-m-d", strtotime( $_POST["fechaI"] ));
			$fechaF = date("Y-m-d", strtotime( $_POST["fechaF"] ));
		
			$tours = new Tours(null, $nombre, $descripcion, $fechaI, $fechaF, $precio, $cupos, $calificacion, $estado, $guia ); 
											  
			$idtours = $tours->agregar();

			if ($idtours!=null) {
				echo json_encode(array("respuesta" => $idtours));
			}else{
				echo '{ "respuesta" :  0 }';
			}
			
		break;

		case 'editarTours':

			$id = $_POST["id"];
			$nombre = $_POST["nombre"];
			$descripcion = $_POST["descripcion"];
			$precio = intval($_POST["precio"]);
			$cupos = intval($_POST["cupos"]);
			$calificacion = intval($_POST["calificacion"]);
			$estado = intval($_POST["estado"]);
			$guia = intval($_POST["guia"]);
			$fechaI = date("Y-m-d", strtotime( $_POST["fechaI"] ));
			$fechaF = date("Y-m-d", strtotime( $_POST["fechaF"] ));
		
			$tours = new Tours($id, $nombre, $descripcion, $fechaI, $fechaF, $precio, $cupos, $calificacion, $estado, $guia ); 
											  
			$res = $tours->editarTours();

			if ($res!=null) {
				echo '{ "respuesta" :  1 }';
			}else{
				echo '{ "respuesta" :  0 }';
			}
			
		break;

		case 'eliminarTours':

			$id = intval($_POST["id"]);

			$res = Tours::removeTours($id);

			echo json_encode(array("respuesta" => $res));

		break;

		default:
			
		break;
	}

 ?>