<?php

#[\AllowDynamicProperties]

class Libro extends Model{
	
	public function getEjemplares():array{
		
		$consulta = "SELECT * FROM ejemplares WHERE idlibro=$this->id";
		
		return DB::selectAll($consulta, 'Ejemplar');
	}
}

