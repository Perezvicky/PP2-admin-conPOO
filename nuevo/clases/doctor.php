<?php
require_once('Persona.php');
class Doctor extends Persona{
    //propiedades
	public $id_doctor;
	public $doctoName;
    public $adress;
    public $doc_Fees;
    public $contactno;
    public $docEmail;
	public $password;
	public $doc_esp;
	public $id_log;
	protected static $nombre_tabla = "doctors";
	//protected static $campos_tabla = array("id","fullname","adress","city","gender", "email", "password");
    //Método que instancia un contacto
	public static function instanciar($registro)
	{
		$doctor = new Doctor();
		foreach ($registro as $propiedad => $valor) 
		{
			if ($doctor->propiedad_existe($propiedad)) 
			{
				$doctor->$propiedad = $valor;
			}
		}
		return $doctor;
	}
	
	public function checklogindoc()
	{
		if(strlen($_SESSION['dlogin'])==0)
		{	
			$host = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra="./index.php";		
			return header("Location: http://$host$uri/$extra");
		}
}
	
}
?>