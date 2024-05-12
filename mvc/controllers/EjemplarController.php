<?php

# ---------------CONTROLADOR PARA TRABAJAR CON EJEMPLARES-----------------------

class EjemplarController extends Controller {
	
# ----------- Método (CREATE) -------------------
	
	# Método para trabajar con ejemplares
	
	public function create (int $idlibro=0){ #  <----- Recibe el id del libro por parámetro
		
		# Carga la vista con el formulario y le pasa el filtro.
		
		$this->loadView('ejemplar/create', [
				
				'libro' => Libro::findOrFail($idlibro, "No se ha encontrado el libro seleccionado")			
		]);	
	}
	
	# Guarda el nuevo ejemplar
	public function store(){
		
		
		
		# Comprueba que llega el formulario con los datos
		if(!$this->request->has('guardar'))
			throw new FormException('No se recibieron los datos del ejemplar');
		
		$ejemplar = new Ejemplar();
		
		# Recupera los datos del formulario que llegan por POST
		$ejemplar->idlibro			=intval($this->request->post('idlibro'));
		$ejemplar->anyo				=intval($this->request->post('anyo'));
		$ejemplar->precio			=floatval($this->request->post('precio'));
		$ejemplar->estado			=strval($this->request->post('estado'));
		
		
		# Prueba a guardar el mensaje, si no lo hace, 
		# este apartado envía el mensaje de exito o error y los registra
		# en la tabla errores
		
		try{
			
			$ejemplar->saveEjemplares();	# Guarda el ejemplar.
			
			# Prepara el mensaje de éxito y redirecciona a la edición del libro
			Session::success('Ejemplar añadido correctamente.');
			redirect("/Libro/edit/$ejemplar->idlibro");
		}catch(SQLException $e){
			
			Session::error('No se puedo añadir el ejemplar');
			
			if(DEBUG)
				throw new Exception($e->getMessage());
			else
				redirect("/Ejemplar/create/$ejemplar->idlibro");
		}
	}
	
#------------------------------- Método para BORRAR un ejemplar libro --------------------------

	# Borra un ejemplar
	public function destroy(int $id = 0){
		
		# Recupera el ejemplar de la base de datos.
		
		$ejemplar = Ejemplar::findEjemplares($id, "No se encontro el ejemplar.");
		
		
		
		# Si hay préstamos no permitimos el borrado
		if ($ejemplar->hasAny('Prestamo','idejemplar'))
			throw new Exception('Este ejemplar no se puede borrar, tiene préstamos');
		
			
			try{
				$ejemplar->destroyEjemplar($id);
				
				# Flashea un mensaje de éxito y redirecciona
				Session::success('Ejemplar eliminado correctamente.');
				redirect("/Libro/edit/$ejemplar->idlibro");
			}catch(SQLException $e){
				Session::error('No se pudo eliminar el ejemplar');
				
				# Si estamos en modo debug nos llevara a los detalles de error 
				# y quedará un registro.
				
				if(DEBUG)
					throw new Exception($e->getMessage());
				else 
					redirect("/Libro/edit/$ejemplar->idlibro");
			}
		
	}
	
	
	
	
	
	
}

