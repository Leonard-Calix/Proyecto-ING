<?php 

	include_once('../../Modelo/clase-Usuario.php');
	include_once('../../Modelo/clase-Persona.php');

	switch ($_GET["accion"]) {
		
		case 'agregar':


			$persona = new Persona(null, $_POST["nombre"], $_POST["apellidos"], $_POST["identidad"], $_POST["direccion"], $_POST["telefono"]);

			$idPersona = $carpeta->agregarPersona();

			if ($idPersona!=null) {
				
				$usuario = new Usuario($_POST["nombreUsuario"], $_POST["correo"], $_POST["contrasenia"], $idPersona);
				$usuario->agregarUsuario();

			}else{
				echo '{"salida": "Error" }';
			}


		break;
		
		case 'login':
			echo '{"Opcion": "Login" }';
		break;

		default:
			echo '{"Opcion": "No valida" }';
			break;
	}

	
	













 ?>