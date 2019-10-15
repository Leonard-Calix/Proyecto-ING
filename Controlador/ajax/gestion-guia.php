
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

		case 'obtenerguia_id':
			$idguia = $_POST['guia'];
			Guia::obtenerTours_por_GuiaID($idguia);
		break;

		case 'datosCorreo':
			$email = $_POST['emailguia'];
			$info = $_POST['infotourguia'];
			$asunto = $_POST['asunto'];
			Guia::notificaciones($email, $asunto, $info);
		break;


		case 'toursPorGuia':
			$id = $_POST['idguia'];
			Guia::toursAsignadosPorGuia($id);
		break;

		case 'informacionGuia':
			$id = $_POST['idguia'];
			Guia::informacionGuia($id);
		break;
		
		
		
		default:
			
		break;
	}

 ?>