	
<?php 
	
	include_once('../../Modelo/clase-Usuario.php');
	include_once('../../Modelo/clase-Persona.php');
	include_once('../../Modelo/ControllerPersona.php');
	include_once('../../Modelo/ControllerUsuario.php');
	
	switch ($_GET["accion"]) {
		
		case 'getProfiles':
			ControllerUsuario::obtenerProfiles();
			break;
		
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
				$usuario = new Usuario($_POST["usuario"], $_POST["correo"], $_POST["contrasenia"],$idPersona);

				$usuario_insertado = ControllerUsuario::agregarUsuario($usuario);
				$salida = array("resultado" =>"Agregado exitosamente", "codigo" => $usuario_insertado);
				echo json_encode($salida);

			}else{
				$salida = array("resultado" =>"Error. Verfique los datos", "codigo" => 0);
				echo json_encode($salida);
			}
			break;
		
		
		case 'delete':
			$id = $_POST['id'];
			ControllerUsuario::borrarUsuario($id);
			break;

		
		case 'login':
			$email = $_POST['correo'];
			$contrasena = $_POST['contrasenia'];

			$login = ControllerUsuario::login($email, $contrasena);
			echo $login;
		break;

		case 'obtenerUsuario':
			 ControllerUsuario::obtenerUsuario((int)$_POST["id"]);
		break;

		case 'obtenerGuias':
			 ControllerUsuario::obtenerGuias();
		break;

		default:
			
			break;
	}

	
	













 ?>