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

		case 'agregarTours':
		/*
			$tours = new Tours();
			$resultado = $tours->agregar(null, $_POST["nombre"], 
											   $_POST["descripcion"], 
											   $_POST["fechaF"], 
											   $_POST["fechaF"], 
											   $_POST["precio"],
										       $_POST["cupos"], 
										       $_POST["calificacion"],
										       (int)$_POST["estado"],
										       (int)$_POST["guia"] 
										   );
*/
			
		break;

		default:
			
		break;
	}

 ?>