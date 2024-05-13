<?php

# Controlador para las operaciones con libros
# cada método implementará una operación o un paso de la misma
class LibroController extends Controller {
	
	# ---------------------------v- Operación por defecto -v----------------------------------------
	public function index() {
		$this->list (); # Redirige al método list()
	}
	
	# ---------------------------v- Operación para listar los libros -v-----------------------------
	public function list() {
		$libros = Libro::all (); # Recupera todos los libros
		                         
		# Carga la vista que los muestra
		view ( 'libro/list', [ 
				'libros' => $libros
		] );
	}
	
	# --------------------------v- Método que muestra los detalles de un libro -v------------------
	public function show(int $id = 0) {
		
		# Comprueba que llega el ID
		if (! $id)
			throw new NothigToFindException ( 'No se indicó el libro a buscar.' );
		
		$libro = Libro::findOrFail ( $id, "No se encontró el libro seleccionado" );
		$ejemplares = $libro->getEjemplares('Ejemplar');
		
		# Carga la vista y le pasa el libro recuperado
		view ( 'libro/show', [ 
				'libro' => $libro,
				'ejemplares' =>$ejemplares
		] );
	}
	
	# -------------------------v- Método que redirecciona la vista el formulario del nuevo libro -v--------------
	public function create() {
		view ( 'libro/create' );
	}
	
	# ------------------------v- CREAR / GUARDAR UN LIBRO (Método) -v--------------------------------------
	public function store() {
		
		# Comprobamos que la peticion venga del formulario --------------------
		if (! $this->request->has ( 'guardar' ))
			throw new FormException ( 'No se recibió el formulario' );
		
		# -----------------------------------------------------------------------
		$libro = new Libro (); # Creamos un objeto LIBRO en el que
		                       # introduciremos los datos del formulario
		
		$libro->isbn = 				$this->request->post ( 'isbn' );
		$libro->titulo = 			$this->request->post ( 'titulo' );
		$libro->editorial = 		$this->request->post ( 'editorial' );
		$libro->autor = 			$this->request->post ( 'autor' );
		$libro->idioma = 			$this->request->post ( 'idioma' );
		$libro->edicion = 			$this->request->post ( 'edicion' );
		$libro->edadrecomendada = 	$this->request->post ( 'edadrecomendada' );
		
		# ------------------------------------------------------------------------
		
		# Con TRY/CATCH local evitaremos ir directamente a la página de error
		
		try {
			# ----------------------------------------------------
			
			$libro->save (); # ------Guardamos el libro
			                 
			# ----------------------------------------------------
			
			# Flashea un mensaje que VERIFICA LA CORRECTA subida del libro por sesión (para que no se borre al redireccionar)
			
			Session::success ( "Guardado del libro $libro->titulo correcto." );
			
			# Una vez cumplida la condición, redirecciona a los detalles del libro que hemos creado
			redirect ( "/Libro/show/$libro->id" );
		} catch ( SQLException $e ) { # Si la condición de save(); no se cumple, Indicamos un error
		                              
			# Flashea el mensaje de error por sesión
			Session::error ( "No se pudo guardar el libro $libro->titulo." );
			
			# --------------------------------------------------------------
			
			# Si estamos en modo DEBUG, iremos a la página de ERROR.
			if (DEBUG)
				throw new Exception ( $e->getMessage () );
			
			# Si no, volveremos al formulario de creación del libro.
			
			redirect ( "/Libro/create" );
		}
	}
	
	# -----------------------------v- ACTUALIZAR UN LIBRO -v---------------------------------------------------------------------
	
	# Esta función muestra la vista del formulario de edición
	public function edit(int $id = 0) {
		$libro = Libro::findOrFail ( $id, "No se encontró el libro." );
		$ejemplares = $libro->getEjemplares('Ejemplar');
		# Carga la vista con el formulario de edición
		
		view ( 'libro/edit', [ 
				'libro' => $libro,
				'ejemplares' =>$ejemplares
		] );
	}
	
	# Funcion para actualizar el libro
	public function update() {
		if (! $this->request->has ( 'actualizar' ))
			throw new FormException ( 'No se recibieron datos' );
		
		$id = intval ( $this->request->post ( 'id' ) ); # Recuperar el id via POST
		
		$libro = Libro::findOrFail ( $id, "No se ha encontrado el libro deseado." );
		
		
		# Recuperar el resto de campos
		$libro->isbn = $this->request->post ( 'isbn' );
		$libro->titulo = $this->request->post ( 'titulo' );
		$libro->editorial = $this->request->post ( 'editorial' );
		$libro->autor = $this->request->post ( 'autor' );
		$libro->idioma = $this->request->post ( 'idioma' );
		$libro->edicion = $this->request->post ( 'edicion' );
		$libro->edadrecomendada = $this->request->post ( 'edadrecomendada' );
		
		# Intenta actualizar el libro
		
		try {
			$libro->update ();
			Session::success ( "Actualización del libro $libro->titulo correcta." );
			redirect ( "/Libro/edit/$id" );
			
			# Si se produce un error en la BDD
		} catch ( SQLException $e ) {
			
			Session::error ( "No se pudo actualizar el libro $libro->titulo." );
			
			# Si estamos en modo debug, si que iremos a la página de error
			if (DEBUG)
				throw new Exception ( $e->getMessage () );
			
			# Si no , volveremos de nuevo a la operación de edición.
			
			redirect ( "/Libro/edit/$id" );
		}
	}
	
	#------------------------V-- BORRAR UN LIBRO --V--------------------------------------
	public function delete(int $id=0){
		
		$libro = Libro::findOrFail($id,"No existe el libro");
		
		view ('libro/delete',[
				
				'libro' => $libro
		]);
	}	
	
	
	
	
	public function destroy(){
		
		# Comprueba que llega el formulario
		
		if(!$this->request->has('borrar'))
			throw new FormException('No se recibio la confirmación');
		
		$id = intval ($this->request->post('id'));		# Recupera el identificador
		$libro = Libro::findOrFail($id);				# Recupera el libro
		
		# Si el libro tiene ejemplares, no permitiremos su borrado
		if($libro->hasAnyEjemplar('Ejemplar'))
			throw new Exception("No se puede borrar el libro mientras tenga ejemplares");
		
			
		# Intenta borrar el libro	
			try{
				$libro->delete($libro->id);
				Session::success("Se ha borrado el $libro->titulo correctamente.");
				redirect("/Libro/list");
				
				# Si no lo borra produce un error en la operación con la BDD
							
			}catch(SQLExcpetion $e){
				Session::error("No se pudo borrar el libro $libro->titulo de la BDD");
				
				# Si estamos en DEBUG vamos a la vista "ERROR"
				if(DEBUG)
					throw new Exception ($e->getMessage());
				
					# Si no retornamos al formulario de confirmación de borrado.
					
					redirect("/Libro/delete/$id");
			}
	}
	
	
	
	
	

	
}

