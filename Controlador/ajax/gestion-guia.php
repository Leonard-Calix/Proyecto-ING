
<?php 
include_once('../../Modelo/class-guia.php');

	switch ($_GET["accion"]) {

		case 'obtener':
			Guia::obtenerTours_por_Guia();	
		break;

		case 'tours_id':
			$id = $_POST['idguia'];
			Guia::obtenerTours_por_GuiaID($id);
		break;

		case 'obtenerGuias':
			Guia::obtenerGuiasOption();
		break;
		
		case 'updateguia':
			
		break;
		default:
			
			break;
	}




























 ?>