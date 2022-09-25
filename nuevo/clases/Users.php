<?php
require_once('Persona.php');
class User extends Persona{
    //propiedades
	public $id_user;
	public $fullname;
    public $adress;
    public $city;
    public $gender;
    public $email;
	public $password;
	protected static $nombre_tabla = "users";
	//protected static $campos_tabla = array("id","fullname","adress","city","gender", "email", "password");
    //Método que instancia un contacto
	public static function instanciar($registro)
	{
		$user = new User();
		foreach ($registro as $propiedad => $valor) 
		{
			if ($user->propiedad_existe($propiedad)) 
			{
				$user->$propiedad = $valor;
			}
		}
		return $user;
	}

	#check_login es un método que permite chequear en la BDD si, en este caso, el usuario es el correcto
    public function checkloginuser()
    {
        if(strlen($_SESSION["login"])==0)
	    {	
		    $host = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra="user-login.php";		
			$_SESSION["login"]="";
			return header("Location: http://$host$uri/$extra");
		
	    }
    }
    
	
}

?>