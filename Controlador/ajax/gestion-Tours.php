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

		default:
			
			break;
	}

 ?>