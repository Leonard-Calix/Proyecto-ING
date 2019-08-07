<?php 
	include_once('../../Modelo/ControllerUsuario.php');
	include_once('../../Modelo/clase-Profiles.php');
	
	/*
	include_once('../../Modelo/clase-Usuario.php');
	include_once('../../Modelo/clase-Persona.php');
	include_once('../../Modelo/ControllerPersona.php');
	include_once('../../Modelo/ControllerUsuario.php');
	
	$nombre = "maria leonela";
	$apellido = "fajardo guillen";
	$identidad = "";
	$telefono = "";
	$genero = "";
	$direccion = "";
	$correo = "fajardomaria@gmail.com";
	$username = "leonela";
	$contra = "turist.007";

	$persona = new Persona($nombre, $apellido, $identidad, $direccion, $telefono, $genero);
	$idPersona = ControllerPersona::agregarPersona($persona);
		
	echo $idPersona;
	if($idPersona != NULL){
		
		$usuario = new Usuario($username, $correo,$contra,$idPersona);

		$usuario_insertado = ControllerUsuario::agregarUsuario($usuario);

		echo $usuario_insertado;
	}else{
		echo "Fallo";
	}
	
	Tours::tours();


	include_once('../../Modelo/clase-Usuario.php');

	Usuario::obtenerUsuario(1);

	include_once('../../Modelo/ControllerUsuario.php');

	$u = ControllerUsuario::login("bcalixvelasquez@gmail.com", "admin.451");
	echo $u;

	include_once('../../Modelo/clase-Tours.php');

	$fechaI = date("Y-m-d", strtotime("2011-02-01") );

	$fechaF = date("Y-m-d", strtotime("2011-01-01") );

	$estado = 1;
	$tours = 20;

	
	echo TOURS::removeTours(30);*/

	//$tours = new TOURS(null,"Sula 10","Lindo Lugar",$fechaI,$fechaF,25,25,5,1,1);

	//echo $tours->agregar();

	//echo "IDTours" . $id;

	//echo date('Y-m-d H:m:s', strtotime("2019/12/12"))

	//echo $tours->toString();

	//echo Tours::asignarHotel($tours,$estado);
	$id = 26;
	$nombre =  "pruebanombre";
	$apellido = "pruebaapellido";
	$identidad = "pruebaidentidad";
	$telefono = "pruebatelefono";
	$genero = "pruebagenero";
	$direccion = "pruebadireccion";
	$nombreUsuario = "pruebausername";
	$email = "pruebaemail";
	//$contrasena = "pruebacontra";
	$tipoUser = 2;

	$profiles = new Profiles($id, $nombre, $apellido, $identidad, $direccion, $telefono, $genero, 
							$nombreUsuario, $email, $tipoUser);

	$nombre = $profiles->getNombre();
	$apellido = $profiles->getApellidos();
	$numeroId = $profiles->getIdentidad();
	$telefono = $profiles->getTelefono();
	$genero = $profiles->getGenero();
	$direccion = $profiles->getDireccion();
	$nombreU = $profiles->getNombreUsuario();
	$email = $profiles->getCorreo();
	$tipoUsuario = $profiles->getTypeUser();
	$idUpdate = $profiles->getId();

	echo $nombre . " " .$apellido . " " . $idUpdate;
					

	$result = ControllerUsuario::editarUsuario($profiles);
			
	echo $result;
	/*
	$idBorrar = 20;

	$result = ControllerUsuario::borrarUsuario($idBorrar);

	echo $result;*/
<<<<<<< HEAD

	ControllerUsuario::obtenerGuias_D();
	
=======
>>>>>>> 58ea2e2c720f237324dea63108b8d124b388dfd1
 ?>