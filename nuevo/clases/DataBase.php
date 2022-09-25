<?php
class Base{
    //propiedades: Características de los objetos
    const DB_SERVER = "localhost";
    const DB_NAME = "hms";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";

    private $conexion;
    private $ultima_consulta;
    private $login;
   
    //Métodos: Definen el comportamiento de los objetos.
    public function __construct()
    {
        $this -> abrir_conexion();
    }
    public function __destruct()
    {
        $this -> cerrar_conexion();
    }
    public function abrir_conexion()    
    {
        $con = mysqli_connect(Base::DB_SERVER, Base::DB_USERNAME,Base::DB_PASSWORD, Base::DB_NAME);
        if (!$con)
        {
            die("Failed to connect to MySQL: " . mysqli_connect_errno());
        }
        return $con;
    }
    public function cerrar_conexion()
    {
        if (isset ($this->conexion))
        {
            unset($this->conexion);
            return $this->conexion;
        }
        
    }
    
    public function enviar_consulta($sql)
    {
        $this->ultima_consulta = $sql;
        $resultado = mysqli_query($this->conexion, $sql);
        $this-> verificar_consulta($resultado);
        return $resultado;
    }

    private function verificar_consulta($consulta){
        if (!$consulta)
        {
            $salida= "No se ha podido realizar la consulta: ". mysqli_connect_errno(). "<br>";
            $salida = "Ultima consulta SQL: ". $this->ultima_consulta;
            die($salida);
        }
    }
    public function fetch_array($resultado)
    {
        return mysqli_fetch_array($resultado);
    }
    public function affected_rows($resultado)
    {
        return mysqli_affected_rows($this->conexion);
    }
    public function insert_id()
    {
        return mysqli_insert_id($this->conexion);
    }
    /*public function num_rows($resultado)
    {
        return mysqli_num_rows($this->conexion);
    }*/

}
$bd = new Base();


?>