<?php

class Ejemplar extends Model {

	public function saveEjemplares():bool{
		
		$consulta = "INSERT INTO ejemplares (idlibro, anyo, precio, estado
					)VALUES(
					$this->idlibro,$this->anyo,$this->precio,'$this->estado')";
		
		return DB::insert($consulta, 'Ejemplar');
	}
}

