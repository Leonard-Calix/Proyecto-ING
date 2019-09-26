
<?php 
include_once('../../Modelo/clase-turista.php');

	switch ($_GET["accion"]) {

		case 'tours_turista':
			$id = $_POST['id'];
			Turista::obtenerTours_por_Turista($id);
		break;
		
		case 'turistaPorTours':
			$id = $_POST['idguia'];
			Turista::turistaPorTours($id);
		break;

		default:
			
		break;
	}

 ?>