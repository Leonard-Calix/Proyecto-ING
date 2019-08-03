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

		case 'agregar':
			$tours = new Tours();
			$resultado = $tours->agregar(null, $_POST["nombre"], $_POST["descripcion"], $_POST["fechai"], $_POST["fechaf"], $_POST["precio"],
										$_POST["cupos"], $_POST["calificacion"],$_POST["estado"],$_POST["guia"] );

			$salida = new array("resultado" => $resultado);
			echo json_encode($salida);
		break;

		default:
			
			break;
	}

 ?>