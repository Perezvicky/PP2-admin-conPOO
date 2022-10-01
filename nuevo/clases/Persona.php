<?php
class Persona{
    protected static $nombre_tabla;
    protected static $campos_tabla;



	public function propiedad_existe($propiedad)
	{
		$propiedades = get_object_vars($this);
		return array_key_exists($propiedad, $propiedades);
	}

}
?>