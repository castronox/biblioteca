<?php

#[\AllowDynamicProperties]

class Libro extends Model{
	
	public function getEjemplares():array{
		
		$consulta = "SELECT * FROM ejemplares WHERE idlibro=$this->id";
		
		return DB::selectAll($consulta, 'Ejemplar');
	}
	
	public function hasAnyEjemplar(string $related, string $foreignKey = null, string $localKey = 'id'): bool
	{
		$table = $related::$table ?? strtolower($related) . 'es'; // cálculo del nombre de la tabla
		
		$foreignKey = $foreignKey ?? 'id' . strtolower(get_called_class()); // cálculo foranea
		
		$query = "SELECT COUNT(*) AS total
                     FROM $table
                     WHERE $foreignKey = " . $this->$localKey; // consulta
		
		$result = (DB_CLASS)::select($query);
		
		return $result->total;
	}
	
	
#----------------------MÉTODO PARA AÑADIR UN TEMA A UN LIBRO-------------------------------------------
	public function addTema(int $idtema):int{
		
		#Preparamos la consulta
		$consulta = "INSERT INTO temas_libros(idlibro, idtema) VALUES($this->id, $idtema)";

		# Ejecuta la consulta
		return (DB_CLASS)::insert($consulta);
		
	}
	
#----------------------MÉTODO PARA ELIMINAR UN TEMA DE UN LIBRO-------------------------------------------	
	
	public function removeTema(int $idtema):int{
		
		# Preparamos la consulta 
		$consulta = "DELETE FROM temas_libros WHERE idlibro = $this->id AND idtema= $idtema";
		
		#Ejecuta la consulta
		return (DB_CLASS)::delete($consulta);
	}
	
	
}

