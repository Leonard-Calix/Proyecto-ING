<?php 
	include_once('../../Modelo/clase-Usuario.php');
	include_once('../../Modelo/clase-Persona.php');
	include_once('../../Modelo/ControllerPersona.php');
	include_once('../../Modelo/ControllerUsuario.php');
	include_once('../../Modelo/clase-Profiles.php');
	include_once('../../Modelo/clase-validadorProfiles.php');

	switch ($_GET["accion"]) {
		
		case 'getProfiles':
			ControllerUsuario::obtenerProfiles();
		break;

		case 'agregar':
		$nombre =  $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$identidad = isset($_POST["identidad"]) ? $_POST["identidad"] : "null";
		$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "null";
		$genero = isset($_POST["genero"]) ? $_POST["genero"] : "n";
		$direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : "null";
		$nombreUsuario = $_POST["usuario"];
		$correo = $_POST["correo"];
		$contrasena = $_POST["contrasenia"];
		$typeUser = isset($_POST['typeUser']) ? $_POST['typeUser'] : 2;
		
		$validador = new ValidadorProfiles($nombre, $apellido, $identidad, $direccion, $telefono, $genero, 
										   $nombreUsuario, $correo, $contrasena, $typeUser);
		
		if($validador->registro_valido()){
			$persona = new Persona($nombre, $apellido, $identidad, $direccion, $telefono, $genero);
			$idPersona = ControllerPersona::agregarPersona($persona);
			
			if($idPersona != NULL){
				$usuario = new Usuario($nombreUsuario, $correo, $contrasena,$idPersona);
				
				$usuario_insertado = ControllerUsuario::agregarUsuario($usuario, $typeUser);
				$salida = array("resultado" =>"Agregado exitosamente", "codigo" => $usuario_insertado);
				echo json_encode($salida);
			}else{
				$salida = array("resultado" =>"Error. Verifique los datos", "codigo" => 0);
				echo json_encode($salida);
			}
		}else{
			$salida = array("resultado" =>"Error. Verifique los datos", "codigo" => 0);
			echo json_encode($salida);
		}
			
		break;
			
		case 'delete':
			$id = intval($_POST['idUser']);
			$salida = ControllerUsuario::borrarUsuario($id);
			echo json_encode(array("resp" => $salida));
		break;

		case 'infoProfiles':
			$id = $_POST['idEdit'];
			ControllerUsuario::obtenerProfile_id($id);
		break;
		
		case 'update':
			$idUpdate = $_POST['idUpdate'];
			$nombre =  $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$identidad = $_POST["identidadUser"];
			$telefono = $_POST["phone"];
			$genero = $_POST["genero"];
			$direccion = $_POST["direccion"];
			$nombreUsuario = $_POST['usuario'];
			$email = $_POST['correo'];
			$contrasena = $_POST['contrasenia'];
			$tipoUser = $_POST['typeUser'];

			$profiles = new Profiles($idUpdate, $nombre, $apellido, $identidad, $direccion, $telefono, $genero, 
									 $nombreUsuario, $email, $contrasena, $tipoUser);

			$result = ControllerUsuario::editarUsuario($profiles);
			
			if ($result!=null) {
				echo '{ "respuesta" :  1 }';
			}else{
				echo '{ "respuesta" :  0 }';
			}
			
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

		case 'getGuias':
			 ControllerUsuario::obtenerGuias();
		break;
	
	
	}

 ?>