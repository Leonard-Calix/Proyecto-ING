<?php 
	
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
	
 ?>