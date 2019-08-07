<?php 

class Profiles {
    private $id;
    private $nombre;
	private $apellidos;
	private $identidad;
	private $direccion;
	private $telefono;
    private $genero;
    private $nombreUsuario;
    private $correo;
    private $contrasena;
    private $typeUser;
    
    public function __construct($id, $nombreC, $apellidos, $identidad, $direccion, $telefono, $genero,
                                $nombreUser, $correo, $contrasena, $typeUser)
    {
        $this->id = $id;
        $this->nombre = $nombreC;
        $this->apellidos = $apellidos;
        $this->identidad = $identidad;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->genero = $genero;
        $this->nombreUsuario = $nombreUser;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
        $this->typeUser = $typeUser;
    }

    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getIdentidad(){
        return $this->identidad;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getGenero(){
        return $this->genero;
    }

    public function getNombreUsuario(){
		return $this->nombreUsuario;
	}

	public function getCorreo(){
		return $this->correo;
	}

    public function getContrasena(){
        return $this->contrasena;
    }
    public function getTypeUser(){
        return $this->typeUser;
    }

}
?>