<?php

class Ejemplar extends Model {

	#
	# protected static string $table = "ejemplares" ;
		
	# -- Ya que el método save() de la base de datos la mágia lo guarda como Ejemplars
	
	public function saveEjemplares():bool{
		
		$consulta = "INSERT INTO ejemplares (idlibro, anyo, precio, estado
					)VALUES(
					$this->idlibro,$this->anyo,$this->precio,'$this->estado')";
		
		return DB::insert($consulta, 'Ejemplar');
	}
	
	
	# Método destroy Ejemplares-------------------------------
	public function destroyEjemplar(int $id): int{

		
		
		
		$consulta = "DELETE FROM ejemplares WHERE id=$id";

		return DB::delete($consulta, 'Ejemplar');
	}
	
	public static function findEjemplares(int $id = 0, ?string $message = NULL): object{
		
		$consulta = "SELECT * FROM ejemplares WHERE id=$id";
		
		if (! $id)
			throw new NothingToException ("No se ha encontrado el ejemplar");
		
		return DB::select($consulta, 'Ejemplar');
		
	}
}

