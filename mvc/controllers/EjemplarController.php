<?php

# ---------------CONTROLADOR PARA TRABAJAR CON EJEMPLARES-----------------------

class EjemplarController extends Controller {
	
# ----------- Método (CREATE) -------------------
	

	
	# Método para trabajar con ejemplares
	
	public function create (int $idlibro=0){ #  <----- Recibe el id del libro por parámetro
		
		# Carga la vista con el formulario y le pasa el filtro.
		
		$this->loadView('ejemplar/create', [
				
				'libro' => Libro::findOrFail($idlibro)			
		]);
		
		
	}
	
	
}

