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
		
			$tours = new Tours(null, $_POST["nombre"], 
											   $_POST["descripcion"], 
											   date("Y-m-d", strtotime($_POST["fechaI"])), 
											   date("Y-m-d", strtotime($_POST["fechaF"])), 
											   (int)$_POST["precio"],
										       (int)$_POST["cupos"], 
										       (int)$_POST["calificacion"],
										       (int)$_POST["estado"],
										       (int)$_POST["guia"] 
										   );

			$id = $tours->agregar();

			if ($id!=null) {
				$res = Tours::asignarHotel($id, (int)$_POST["estado"] );

				$data = array("res" => $res);

				echo json_encode($data);

			}else{
				echo "{'Resultado ' : 'Fallo'}";
			}
			

			
		break;

		default:
			
		break;
	}

 ?>