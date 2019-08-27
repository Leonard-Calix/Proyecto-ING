<?php 
	//include_once('../../Modelo/ControllerUsuario.php');
	//include_once('../../Modelo/clase-Profiles.php');
	//include_once('../../Modelo/class-guia.php');
	//include_once('../../Modelo/clase-Tours.php');

	//include_once('../../Modelo/clase-turista.php');

	//include_once('../../Modelo/clase-conexionPDO.php');
	//include_once('../../Modelo/clase-validadorProfiles.php');
	//$id = 16;
	//echo ControllerUsuario::obtenerProfile_id($id);
	include_once('../../Modelo/clase-Comentarios.php');
	//include_once('./gestionComentarios.php');
	//Turista::informacion(7);
	//var_dump($datos);
	/*$comentario = '';
	$idUsuario = 1000;*/
	//$accion = $_GET['ComentarioporTour'];
	//$idTours = 4;
	//echo Comentarios::obtenerComentarioTour($idTours);

	
	/*$salida = Comentarios::deleteComentario(7);
	echo $salida;
	*/


	/*
	
	$nombre =  "maria fernando";
		$apellido = "funez mori";
		$identidad = isset($_POST["identidad"]) ? $_POST["identidad"] : "camnulos";
		$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "camnulos";
		$genero = isset($_POST["genero"]) ? $_POST["genero"] : "n";
		$direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : "nulos";
		$nombreUsuario = "fer";
		$correo = "funezfer@gmail.com";
		$contrasena = "turist.000";
		$typeUser = isset($_POST['typeUser']) ? $_POST['typeUser'] : 2;
		
		$validador = new ValidadorProfiles($nombre, $apellido, $identidad, $direccion, $telefono, $genero, 
										   $nombreUsuario, $correo, $contrasena, $typeUser);
		
		echo $validador->registro_valido();
	Conexion::abrirConexion();
	$conexion = Conexion::obtenerConexion();
	echo ControllerUsuario::obtenerProfiles();
	
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
	/*
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
	*/
	/*
	$idBorrar = 20;

	$result = ControllerUsuario::borrarUsuario($idBorrar);

	echo $result;

	$todayh = getdate();


	$d = $todayh["mday"];
	$m = $todayh["mon"];
	$y = $todayh["year"];
	//echo "$d-$m-$y"; //getdate converted day

	$fechaActual = date( "Y-m-d", strtotime($d-$m-$y) ); 

	//echo $fechaActual;

	echo TOURS::validarFecha("2019-08-22","2019-08-25");

	*/

	/*ControllerUsuario::obtenerUsuario(16);*/

	//Guia::informacionGuia(15);

	Comentarios::obtenerComentarios();



