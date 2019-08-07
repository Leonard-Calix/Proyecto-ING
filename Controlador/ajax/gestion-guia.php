<?php 


	switch ($_GET["accion"]) {

		case 'agregar':

			$nombre =  $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$identidad = isset($_POST["identidad"]) ? $_POST["identidad"] : "null";
			$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "null";
			$genero = isset($_POST["genero"]) ? $_POST["genero"] : "null";
			$direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : "null";

			$persona = new Persona($nombre, $apellido, $identidad, $direccion, $telefono, $genero);
			
			$idPersona = ControllerPersona::agregarPersona($persona);

			if($idPersona != NULL){

				$usuario = new Usuario($_POST["usuario"], $_POST["email"], $_POST["contrasenia"],$idPersona);
				$typeUser = isset($_POST['typeUser']) ? $_POST['typeUser'] : 3;
				$usuario_insertado = ControllerUsuario::agregarUsuario($usuario, $typeUser);
				$salida = array("resultado" =>"Agregado exitosamente", "codigo" => $usuario_insertado);
				echo json_encode($salida);

			}else{
				$salida = array("resultado" =>"Error. Verfique los datos", "codigo" => 0);
				echo json_encode($salida);
			}

		break;

		case 'abtener':
			
		break;

		case 'infoGuia':
			
		break;

		case 'agregar':
			
		break;
		
		default:
			
			break;
	}




























 ?>