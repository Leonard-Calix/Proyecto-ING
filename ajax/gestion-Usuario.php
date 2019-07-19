<?php 

	include("../clases/clase-Usuario.php");
	include("../clases/clase-Persona.php");

	switch ($_GET["accion"]) {
		
		case 'agregar':
			echo '{"Opcion": "Agregar" }';
		break;
		
		case 'login':
			echo '{"Opcion": "Login" }';
		break;

		default:
			
			break;
	}

	
	













 ?>