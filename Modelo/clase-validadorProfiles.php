<?php 
include_once('ControllerUsuario.php');

class ValidadorProfiles{
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
    private $error_nombre;
	private $error_apellidos;
	private $error_identidad;
	private $error_direccion;
	private $error_telefono;
    private $error_genero;
    private $error_nombreUsuario;
    private $error_correo;
    private $error_contrasena;
    private $error_typeUser;

    public function __construct($nombreC, $apellidos, $identidad, $direccion, $telefono, $genero,
                                $nombreUser, $correo, $contrasena, $typeUser)
    {
        $this->nombre = "";
        $this->apellidos = "";
        $this->identidad = "";
        $this->direccion = "";
        $this->telefono = "";
        $this->genero = "";
        $this->nombreUsuario = "";
        $this->correo = "";
        $this->contrasena = "";
        $this->typeUser = "";
        $this -> error_nombre = $this -> validar_nombreC($nombreC);
        $this -> error_apellidos = $this -> validar_apellidos($apellidos);
        $this -> error_identidad = $this -> validar_identidad($identidad);
        $this -> error_direccion = $this -> validar_direccion($direccion);
        $this -> error_telefono = $this -> validar_telefono($telefono);
        $this -> error_genero = $this -> validar_genero($genero);
        $this -> error_nombreUsuario = $this -> validar_nombreUsuario($nombreUser);
        $this -> error_correo = $this -> validar_correo($correo);
        $this -> error_contrasena = $this -> validar_contrasena($contrasena);
        $this -> error_typeUser = $this -> validar_typeUser($typeUser);
    }

    private function variable_iniciada($variable) {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validar_nombreC($nombre) {
        if (!$this -> variable_iniciada($nombre)) {
            return "Debes escribir un nombre.";
        } else {
            $this -> nombre = $nombre;
        }

        if(is_numeric($nombre)){
            return "Debes escribir un nombre sin numeros";
        }

        if (strlen($nombre) < 2) {
            return "El nombre debe ser más largo que 2 caracteres.";
        }

        if (strlen($nombre) > 24) {
            return "El nombre no puede ocupar más de 24 caracteres.";
        }

        return "";
    }

    private function validar_apellidos($apellidos) {
        if (!$this -> variable_iniciada($apellidos)) {
            return "Debes escribir apellidos.";
        } else {
            $this -> apellidos = $apellidos;
        }

        if(is_numeric($apellidos)){
            return "Debes escribir un apellidos sin numeros";
        }
        

        if (strlen($apellidos) < 3) {
            return "Los apellidos debe ser más largo que 3 caracteres.";
        }

        if (strlen($apellidos) > 55) {
            return "Los apellidos no puede ocupar más de 55 caracteres.";
        }

        return "";
    }

    private function validar_identidad($identidad){
        if (!$this -> variable_iniciada($identidad)) {
            return "Debes escribir numero de identidad.";
        } else {
            $this -> identidad = $identidad;
        }

        if (strlen($identidad) < 3) {
            return "El numero de identidad debe ser más largo que 3 caracteres.";
        }

        if (strlen($identidad) > 20) {
            return "El numero de identidad no puede ocupar más de 20 caracteres.";
        }

        return "";
    }

    private function validar_direccion($direccion) {
        if (!$this -> variable_iniciada($direccion)) {
            return "Debes escribir una direccion.";
        } else {
            $this -> direccion = $direccion;
        }
        
        if (strlen($direccion) < 3) {
            return "Las direcciones debe ser más largo que 3 caracteres.";
        }

        if (strlen($direccion) > 55) {
            return "Las direcciones no puede ocupar más de 55 caracteres.";
        }

        return "";
    }

    private function validar_telefono($telefono) {
        //$expresion = '/^(?:((?P<p1>(?:\( ?)?+)(?:\+|00)?(504)(?<p2>(?: ?\))?+)(?P<sep>(?:[-.]| (?:[-.] )?)?+)(?:(?&p1)(9)(?&p2)(?&sep))?|(?&p1)(0)(?&p2)(?&sep))?+(?&p1)(11|([23]\d{2}(\d)??|(?(-10)(?(-5)(?!)|[68]\d{2})|(?!))))(?&p2)(?&sep)(?(-5)|(?&p1)(15)(?&p2)(?&sep))?(?:([3-6])(?&sep)|([12789]))(\d(?(-5)|\d(?(-6)|\d)))(?&sep)(\d{4})|(1\d{2}|911))$/D';

        if (!$this -> variable_iniciada($telefono)) {
            return "Debes escribir un numero de telefono.";
        } else {
            $this -> telefono = $telefono;
        }
        
        /*if(preg_match($expresion, $telefono) != 1){
            return "Mal formato ejemplo: 504 0000 0000";
        }*/

        if (strlen($telefono) < 2) {
            return "Los numeros de telefono debe ser más largo que 2 numeros.";
        }

        if (strlen($telefono) > 15) {
            return "Los numeros de telefono no puede ocupar más de 12 numeros.";
        }

        return "";
    }

    private function validar_genero($genero) {
        if (!$this -> variable_iniciada($genero)) {
            return "Debes escribir tu genero. (F o M)";
        } else {
            $this -> genero = $genero;
        }

        if($genero === 'M' || $genero === 'm' || $genero === 'F' || $genero === 'f'){
            $this -> genero = $genero;
        }else{
            return "Debes escribir tu genero. (F o M)";
        }

        if(is_numeric($genero)){
            return "Debes escribir genero sin numeros";
        }
        
        if (strlen($genero) > 2) {
            return "El genero no puede ocupar más de 2 letras.";
        }

        return "";
    }

    private function validar_nombreUsuario($nombreUser) {
        if (!$this -> variable_iniciada($nombreUser)) {
            return "Debes escribir un nombre de usuario.";
        } else {
            $this -> nombreUsuario = $nombreUser;
        }

        if(is_numeric($nombreUser)){
            return "Debes escribir un nombre sin numeros";
        }
        
        if (strlen($nombreUser) < 3) {
            return "El nombre debe ser más largo que 3 caracteres.";
        }

        if (strlen($nombreUser) > 24) {
            return "El nombre no puede ocupar más de 24 caracteres.";
        }

        if (ControllerUsuario::nombre_existe($nombreUser)) {
            return "Este nombre de usuario ya está en uso. Por favor, prueba otro nombre.";
        }

        return "";
    }

    private function validar_correo($email) {
        if (!$this -> variable_iniciada($email)) {
            return "Debes proporcionar un email.";
        } else {
            $this -> email = $email;
        }
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return "Mal formato ejemplo@ejemplo.com";
        }

        if (ControllerUsuario::email_existe($email)) {
            return "Este email ya está en uso. Por favor, pruebe otro email";
        }
        return "";
    }

    private function validar_contrasena($contrasena) {
        if (!$this -> variable_iniciada($contrasena)) {
            return "Debes escribir una contraseña.";
        }
        
        return "";
    }

    private function validar_typeUser($typeUser) {
        if (!$this -> variable_iniciada($typeUser)) {
            return "Debes seleccionar un tipo de Usuario.";
        }

        return "";
    }

    public function obtener_nombre() {
        return $this -> nombre;
    }

    public function obtener_apellidos() {
        return $this -> apellidos;
    }
    
    public function obtener_identidad() {
        return $this -> identidad;
    }

    public function obtener_direccion() {
        return $this -> direccion;
    }

    public function obtener_telefono() {
        return $this -> telefono;
    }

    public function obtener_genero() {
        return $this -> genero;
    }
    public function obtener_nombreUsuario() {
        return $this -> nombreUsuario;
    }

    public function obtener_correo() {
        return $this -> correo;
    }
    
    public function obtener_clave() {
        return $this -> contrasena;
    }

    public function obtener_tipoUsuario() {
        return $this -> typeUser;
    }
    
    public function obtener_error_nombre() {
        return $this -> error_nombre;
    }

    public function obtener_error_apellido() {
        return $this -> error_apellidos;
    }

    public function obtener_error_identidad() {
        return $this -> error_identidad;
    }

    public function obtener_error_direccion() {
        return $this -> error_direccion;
    }

    public function obtener_error_telefono() {
        return $this -> error_telefono;
    }

    public function obtener_error_genero() {
        return $this -> error_genero;
    }

    public function obtener_error_nombreUsuario() {
        return $this -> error_nombreUsuario;
    }

    public function obtener_error_email() {
        return $this -> error_correo;
    }

    public function obtener_error_contrasena() {
        return $this -> error_contrasena;
    }

    public function obtener_error_tipoUsuario() {
        return $this -> error_typeUser;
    }
 
    public function registro_valido() {
        if ($this -> error_nombre === "" &&
            $this -> error_apellidos === "" &&
            $this -> error_identidad === "" &&
            $this -> error_direccion === "" &&
            $this -> error_telefono === "" &&
            $this -> error_genero === "" &&
            $this -> error_nombreUsuario === "" &&
            $this -> error_correo === "" &&
            $this -> error_contrasena === "" &&
            $this -> error_typeUser === "") {
            return true;
        } else {
            return false;
        }
    }
}
?>