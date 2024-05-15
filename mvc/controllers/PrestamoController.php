<?php 


#----------------------------- CONTROLADOR PARA TRABAJAR CON PRESTAMOS -------------------


class PrestamoController extends Controller{
	
	# ------ Método (CREATE) -----------------------
	
	public function create (int $idsocio = 0){  #--- Recibe por parametro su ID
		
		$socio = Socio::findOrFail ($idsocio, "No se encontro el socio seleccionado");
		
		view('prestamo/create',
				[
				'socio' => $socio		
				]);
				
		
	}
	
	# Guarda el nuevo prestamo
	
	public function store() {
		// Verifica si se enviaron los datos del formulario
		if(!$this->request->has('guardar')) {
			throw new FormException('No se recibieron los datos del préstamo');
		}
		
		// Crea una nueva instancia de Prestamo
		$prestamo = new Prestamo();
		
		// Recupera los datos del formulario
		
		$prestamo->idsocio = $this->request->post('idsocio');
		$prestamo->idejemplar = $this->request->post('idejemplar');
		
		// Calcula la fecha límite (7 días después de la fecha actual)
		# $fecha_actual = new DateTime();
		# $fecha_limite = $fecha_actual->modify('+7 days')->format('Y-m-d');
		
		// Asigna la fecha límite al campo 'limite' del préstamo
		$prestamo->limite = $this->request->post('limite');
		
		// Guarda el préstamo en la base de datos
		try {
			$prestamo->save();
			
			// Recupera los datos del socio para mostrar en el mensaje de éxito
			$socio = Socio::findOrFail($prestamo->idsocio);
			
			// Muestra un mensaje de éxito y redirige a la página de edición del socio
			Session::success("Guardado del préstamo $prestamo->id del socio $socio->nombre $socio->apellidos CORRECTO.");
			redirect("/Socio/edit/$prestamo->idsocio");
		} catch (SQLExcpetion $e) {
			// En caso de error, muestra un mensaje de error y redirige nuevamente a la creación del préstamo
			Session::error("No se pudieron guardar los datos del préstamo.");
			if(DEBUG) {
				throw new Exception($e->getMessage());
			} else {
				redirect("Prestamo/create/$prestamo->idsocio");
			}
		}
			
			}

#--------------- MÉTODO DEVOLVER PRESTAMO ------------------------------------------------------------				
			
	public function devolucion(int $id = 0){
			
			# Recupera el préstamo 
			$prestamo = Prestamo::findOrFail($id);	
			
			
			# Pone la fecha de devolución
			$prestamo->devolucion = date('Y-m-d');
			
			# Intenta actualizar
			
			try{
				
				
				$prestamo->update();
				Session::success("La devolución del prestamo $prestamo->id ha sido regitrada correctamente.");
				redirect("/Socio/edit/$prestamo->idsocio");
				
			# Si falla..	
			}catch (SQLExcpetion){
				
				Session::error('No se ha podido registrar la devolución.');
				
				if(DEBUG)
					throw new Exception ($e->getMessage());
				
					redirect("/Socio/edit/$prestamo->idsocio");
			}
			
			
	}
	

	
	
}





























?>