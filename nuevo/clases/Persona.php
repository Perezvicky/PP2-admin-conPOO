<?php
class Persona{
    protected static $nombre_tabla;
    protected static $campos_tabla;

    public static function buscar_por_sql($sql)
	{
		global $bd;
		$resultado = $bd->enviar_consulta($sql);
		$matriz = array();
		while($registro = $bd->fetch_array($resultado)) 
		{
			array_push($matriz,static::instanciar($registro));
		}
		return $matriz;
	}

    public static function buscar_todos()
	{
		global $bd;
		return static::buscar_por_sql("SELECT * FROM  ". static::$nombre_tabla);
	}

	public function propiedad_existe($propiedad)
	{
		$propiedades = get_object_vars($this);
		return array_key_exists($propiedad, $propiedades);
	}

}
?>