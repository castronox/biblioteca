<?php

class SocioController extends Controller {
	
	
	# ---------------------------v- Operación por defecto -v----------------------------------------
	public function index() {
		$this->list (); # Redirige al método list()
	}
	
	
	# ---------------------------v- Operación para listar los Socios -v-----------------------------
	public function list() {
		$socios = Socio::all (); # Recupera todos los socios
		
		# Carga la vista que los muestra la lista Socios
		view ( 'Socio/list', [
				'socios' => $socios
		] );
	}
	
	# --------------------------v- Método que muestra los detalles de un socio -v------------------
	public function show(int $id = 0) {
		
		# Comprueba que llega el ID
		if (! $id)
			throw new NothigToFindException ( 'No se indicó el socio a buscar.' );
			
			$socio = Socio::findOrFail ( $id, "No se encontró el socio seleccionado" );
			#$socio = $socio->get('Prestamos');
			
			# Carga la vista y le pasa el socio recuperado
			view ( 'socio/show', [
					'socio' => $socio,
					'prestamos' =>$prestamos
			] );
	}
	
	
	#--------------------v--------ACTUALIZAR SOCIO -----------------------------------------
	
	# Esta función muestra la vista del formulario de edición 
	
	public function edit(int $id = 0){
		
		$socio = Socio::findOrFail($id, "No se encontró el socio");
		
		#Carga la vista con el formulario de edición de socio
		
		view( 'socio/edit', [
			'socio' => $socio	
		]);
	}
	
	
	# Función para actualizar el socio
	public function update(){
		if(! $this->request->has ('actualizar'))
			throw new FormException ('No se recibieron datos');
		
		$id = intval( $this->request->post ('id')); # Recuperamos el ID del socio via POST
		
		$socio = Socio::findOrFail ($id , "No se ha encontrado el socio seleccionado");
		
		# Recuperamos el resto de campos
		$socio->dni 				= $this->request->post ( 'dni' );
		$socio->nombre  			= $this->request->post ( 'nombre' );		
		$socio->apellidos			= $this->request->post ( 'apellidos' );		
		$socio->nacimiento			= $this->request->post ( 'nacimiento' );
		$socio->email 				= $this->request->post ( 'email' );
		$socio->direccion 			= $this->request->post ( 'direccion' );		
		$socio->cp 					= $this->request->post ( 'cp' );		
		$socio->poblacion			= $this->request->post ( 'poblacion' );		
		$socio->provincia			= $this->request->post ( 'provincia' );		
		$socio->telefono 			= $this->request->post ( 'telefono' );		
		$socio->alta				= $this->request->post ( 'alta' );
		
		# Intenta actualizar el SOCIO
		
		try{
			$socio->update ();
			Session::success ("Acutalización del socio $socio->nombre $socio->apellidos correcto");
			redirect ("/Socio/edit/$id");
			
			#Si se produce un error en la base de datos
		}catch(SQLException $e){
			Session::error("No se pudo actualizar el socio $socio->nombre $socio->apellidos");
			
			
			# Si estamos en modo DEBUG, nos redirigirá a la página de error
			if(DEBUG)
				throw new Exception ($e->getMessage());
			
				#Si no, volveremos de nuevo a la operacion de editar socio
				
				redirect ("/Socio/edit/$id");
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}

