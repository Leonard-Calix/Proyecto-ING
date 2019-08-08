
<?php 
include_once('../../Modelo/class-guia.php');

	switch ($_GET["accion"]) {

		case 'obtener':
			Guia::obtenerTours_por_Guia();
			
		break;

		
		default:
			
			break;
	}




























 ?>