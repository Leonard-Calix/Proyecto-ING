<?php
class Conexion {
  private static $conexion;

  public static function abrirConexion() {
      if (!isset(self::$conexion)) {
        try {
          $usuario = "root";
          $contrasena = ""; /*contrasena del servidor: X8ezdMc2dceSFT*/
          $dsn = 'mysql:host=localhost;dbname=toursindia';
          self::$conexion = new PDO($dsn, $usuario, $contrasena);
          self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          self::$conexion -> exec("SET CHARACTER SET utf8");
        } catch (PDOException $ex) {
          print "ERROR: " . $ex -> getMessage() . "<br>";
          die();
        }
      }
    }

    public static function cerrarConexion() {
      if (isset(self::$conexion)) {
        self::$conexion = null;
      }
    }

    public static function obtenerConexion() {
      return self::$conexion;
    }
}
 ?>