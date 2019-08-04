<?php 
	
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
*/
	include_once('../../Modelo/clase-Tours.php');

	$fechaI = date("Y-m-d", strtotime("2011-02-01") );

	$fechaF = date("Y-m-d", strtotime("2011-01-01") );

	
	$tours = new TOURS(null,"Tegus","Lindo Lugar",$fechaI,$fechaF,25,25,5,1,1);

	$id = $tours->agregar();

	//echo date('Y-m-d H:m:s', strtotime("2019/12/12"))

	//echo $tours->toString();

	echo Tours::asignarHotel($id,1);
	
 ?>