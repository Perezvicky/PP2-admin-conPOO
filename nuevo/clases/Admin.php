<?php
require_once('DataBase.php');
require_once('Persona.php');
class Admin extends Persona{
    //propiedades
	public $id;
	public $username;
	public $password;
	protected static $nombre_tabla = "admin";
	//protected static $campos_tabla = array("id","username","password");
    

	//Método que permite instanciar un objeto administrador con sus correspondientes propiedades
	public static function instanciar($registro)
	{
		$admin = new Admin();
		foreach ($registro as $propiedad => $valor) 
		{
			if ($admin->propiedad_existe($propiedad)) 
			{
				$admin->$propiedad = $valor;
			}
		}
		return $admin;
	}

   //Método que chequea los datos del inicio de sesión en la BDD. 
   //de no ser correctos lo redirecciona a la pagina de inicio de sesión
   //--valor devuelto, booleano--
	public function checkloginadmin()
   {
	if(strlen($_SESSION['login'])==0)
		{	
			$host = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');		
			$_SESSION["login"]="";
			$extra = "localhost/probando-poo/nuevo/hms/admin/index-admin.php";
			return header("Location: http://$host$uri/$extra");
		}
	
   }

   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de usuarios registrados (No manejan el sistema interno, son pacientes)
   public function CantidadUsuarios()
   {
		$bd = new Base();
		$con = $bd->abrir_conexion();
		$result = mysqli_query($con, "SELECT * FROM admin ");
		$num_rows = mysqli_num_rows($result);
		return $num_rows;
   }

   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de doctores registrados
   public function CantidadProf()
   {
		$bd = new Base();
		$con = $bd->abrir_conexion();
		$result1 = mysqli_query($con, "SELECT * FROM doctors");
		$num_rows1 = mysqli_num_rows($result1);
		return $num_rows1;
   }

   
   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de pacientes registradas
   public function CantidadPac()
   {
		$bd = new Base();
		$con = $bd->abrir_conexion();
		$result2 = mysqli_query($con, "SELECT * FROM tblpatient");
		$num_rows2 = mysqli_num_rows($result2);
		return $num_rows2;
   }

   //Método que hace una consulta en la BDD, donde en el resultado final esta le devuelve la cantidad de 
   //filas del resultado en un string, y luego mediante una función dentro del otro archivo (dashboardadmin)
   // son transcriptas a entidades HTML. 
   //-- valor devuelto es un int-- busca la cantidad de concultas nuevas realizadas
   public function CantidadCons()
   {
		$bd = new Base();
		$con = $bd->abrir_conexion();
		$resultado3 = mysqli_query($con, "SELECT * FROM tblcontactus where  IsRead is null");
		$num_rows3 = mysqli_num_rows($resultado3);
		return $num_rows3;
   }

   //Método que inserta un doctor en la BDD
   public function insertaDoc()
   {
	$bd = new Base();
	$con = $bd -> abrir_conexion();
   	if (isset($_POST['submit'])) {
		$docspecialization = $_POST['Doctorspecialization'];
		$docname = $_POST['docname'];
		$docaddress = $_POST['clinicaddress'];
		$docfees = $_POST['docfees'];
		$doccontactno = $_POST['doccontact'];
		$docemail = $_POST['docemail'];
		$password = md5($_POST['npass']);
		$sql = mysqli_query($con, "insert into doctors(specilization,doctorName,address,docFees,contactno,docEmail,password) values('$docspecialization','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password')");
		return $sql;
		}
	}
}

?>