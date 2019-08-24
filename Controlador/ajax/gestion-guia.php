
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
			$email = $_POST['email'];
			$info = $_POST['info'];
			Guia::notificaciones($email,$info);
		break;


		case 'toursPorGuia':
			$id = $_POST['idguia'];
			Guia::toursAsignadosPorGuia($id);
		break;
		
		
		default:
			
		break;
	}

 ?>