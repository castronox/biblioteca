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
	
	public function store(){
		
				
		
		# Comprueba que llega el formulario con los datos
		
		if(!$this->request->has('guardar'))
			throw new FormException ('No se recibieron los datos del prestamo');
		
			$prestamo = new Prestamo();
			
			# Recupera los datos del formulario de creación de prestamo que llegan por POST
			$prestamo->id			=$this->request->post('idprestamo');
			$prestamo->idsocio		=$this->request->post('idsocio');
			$prestamo->idejemplar	=$this->request->post('idejemplar');
			$prestamo->limite		=$this->request->post('limite');
			$prestamo->incidencia	=$this->request->post('incidencias');
			
			
			
			# Probamos a introducir los datos
			
			try{
				
				$prestamo->save();
				
				$socio = Socio::findOrFail($prestamo->idsocio);
				
				Session::success ("Guardado del prestamo $prestamo->id del socio $socio->nombre $socio->apellidos CORRECTO. ");
				#redirect("/Socio/edit/$prestamo->idsocio");
			}catch (SQLExcpetion $e){
				
				Session::error("No se han enviado los dato del prestamo $this->id del socio $socio->nombre $socio->apellidos");
				
				if(DEBUG)
					throw new Exception ( $e->getMessage ());
				
					# Si no estamos en debug nos redirecciona nuevamonete a la creacion del prestamo.
					else
					redirect("Prestamo/create/$socio->id");
			}
	}
	
	
	
}





























?>