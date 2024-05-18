<?php

# Controlador para las operaciones con libros
# cada método implementará una operación o un paso de la misma
class LibroController extends Controller
{


	#---------------------------------------------------------------------#
	#------------->  MÉTODO DE REDIRECCIÓN A LISTAR DATOS  <--------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	public function index()
	{
		$this->list(); # Redirige al método list()
	}


	#---------------------------------------------------------------------#
	#-------------------->  MÉTODO PARA LISTAR LIBROS  <------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	public function list(int $page = 1)
	{

		$filtro = Filter::apply('libros');
		$limit = RESULTS_PER_PAGE;


		# Si hay filtro
		if ($filtro) {

			$total = Libro::filteredResults($filtro);

			# Crea el OBJETO paginador
			$paginator = new Paginator('/Libro/list', $page, $limit, $total);

			# Recupera la lista de libros con el filtro aplicado
			$libros = Libro::filter($filtro, $limit, $paginator->getOffset());
		} else {

			# Recupera el total de libros
			$total = Libro::total();

			# Crea el OBJETO paginador
			$paginator = new Paginator('/Libro/list', $page, $limit, $total);

			#Recupera todos los libros
			$libros = Libro::orderBy('titulo', 'DESC', $limit, $paginator->getOffset());
		}


		# Carga la vista que los muestra
		$this->loadView('libro/list', [
			'libros' => $libros,
			'paginator' => $paginator,
			'filtro' => $filtro
		]);
	}


	#---------------------------------------------------------------------#
	#----------------->  MOSTRAR DETALLED DE UN LIBRO  <------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	public function show(int $id = 0)
	{

		# Comprueba que llega el ID
		if (!$id)
			throw new NothigToFindException('No se indicó el libro a buscar.');

		#Recupera el libro
		$libro = Libro::findOrFail($id, "No se encontró el libro seleccionado");


		# Recupera los ejemplares
		$ejemplares = $libro->getEjemplares('Ejemplar');

		$temas = $libro->belongsToMany('Tema', 'temas_libros');


		# Carga la vista y le pasa el libro recuperado
		view('libro/show', [
			'libro' => $libro,
			'ejemplares' => $ejemplares,
			'temas' => $temas
		]);
	}




	#---------------------------------------------------------------------#
	#--------------->   CREAR / GUARDAR UN LIBRO (Método)   <-------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#     


	# Redirección a la vista del formulario para crear el libro
	public function create()
	{
		view('libro/create', [

			'listaTemas' => Tema::orderBy('tema')
		]);
	}


	public function store()
	{

		# Comprobamos que la peticion venga del formulario --------------------
		if (!$this->request->has('guardar'))
			throw new FormException('No se recibió el formulario');

		# -----------------------------------------------------------------------
		$libro = new Libro(); # Creamos un objeto LIBRO en el que
		# introduciremos los datos del formulario

		$libro->isbn = $this->request->post('isbn');
		$libro->titulo = $this->request->post('titulo');
		$libro->editorial = $this->request->post('editorial');
		$libro->autor = $this->request->post('autor');
		$libro->idioma = $this->request->post('idioma');
		$libro->edicion = $this->request->post('edicion');
		$libro->edadrecomendada = $this->request->post('edadrecomendada');

		# Añadimos para recoger el tema del libro
		$idtema = intval($this->request->post('idtema'));

		# ------------------------------------------------------------------------

		# Con TRY/CATCH local evitaremos ir directamente a la página de error

		try {
			# ----------------------------------------------------

			$libro->save(); # ------Guardamos el libro
			$libro->addTema($idtema);		# Le pone un tema principal



			# ---------SI LLEGA LA PORTADA-------------

			if (UploadedFile::check('portada')) {
				# Crea el nuevo UplodadedFile
				$file = new UploadedFile(
					'portada',		# Nombre del input
					800000,         # Asigna un tamaño máximo al archivo
					['image/png', 'image/jpeg', 'image/gif', 'image/jpg']
				);

				# Guarda el fichero
				$libro->portada = $file->store('../public/' . BOOK_IMAGE_FOLDER, 'book__');
			}

			$libro->update();					# Actualiza el libro para indicar la portada

			Session::success("Guardado del libro $libro->titulo correcto.");
			redirect("/Libro/show/$libro->id");


			# Flashea un mensaje que VERIFICA LA CORRECTA subida del libro por sesión (para que no se borre al redireccionar)

			Session::success("Guardado del libro $libro->titulo correcto.");

			# Una vez cumplida la condición, redirecciona a los detalles del libro que hemos creado
			redirect("/Libro/show/$libro->id");
		} catch (SQLException $e) { # Si la condición de save(); no se cumple, Indicamos un error

			# Flashea el mensaje de error por sesión
			Session::error("No se pudo guardar el libro $libro->titulo.");

			# --------------------------------------------------------------

			# Si estamos en modo DEBUG, iremos a la página de ERROR.
			if (DEBUG)
				throw new Exception($e->getMessage());

			# Si no, volveremos al formulario de creación del libro.

			redirect("/Libro/create");
		} catch (UploadException $e) {

			Session::warning("El libro se guardo correctamente, pero no se subió la imagen de portada.");

			if (DEBUG)
				throw new Exception($e->getMessage());

			redirect("/Libro/edit/$libro->id");
		}
	}


	#---------------------------------------------------------------------#
	#-----------------------> ACTUALIZAR UN LIBRO <-----------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      

	# Esta función muestra la vista del formulario de edición
	public function edit(int $id = 0)
	{
		$libro = Libro::findOrFail($id, "No se encontró el libro.");

		$ejemplares = $libro->getEjemplares('Ejemplar');			# Recoge los ejemplares del libro		
		$temas = $libro->getTemas();								# Recoge los temas de un libro


		$listaTemas = array_diff(Tema::orderBy('tema'), $temas);

		# Carga la vista con el formulario de edición			
		view('libro/edit', [
			'libro' => $libro,
			'ejemplares' => $ejemplares,
			'temas' => $temas,
			'listaTemas' => $listaTemas
		]);
	}

	# Funcion para actualizar el libro
	public function update()
	{
		if (!$this->request->has('actualizar'))
			throw new FormException('No se recibieron datos');

		$id = intval($this->request->post('id')); # Recuperar el id via POST

		$libro = Libro::findOrFail($id, "No se ha encontrado el libro deseado.");


		# Recuperar el resto de campos
		$libro->isbn = $this->request->post('isbn');
		$libro->titulo = $this->request->post('titulo');
		$libro->editorial = $this->request->post('editorial');
		$libro->autor = $this->request->post('autor');
		$libro->idioma = $this->request->post('idioma');
		$libro->edicion = $this->request->post('edicion');
		$libro->edadrecomendada = $this->request->post('edadrecomendada');

		# Intenta actualizar el libro

		try {
			# --------> ACTUALIZA LA PORTADA DEL LIBRO  <--------
			if (UploadedFile::check('portada')) {

				$file = new UploadedFile(
					'portada',		# Nombre del input
					800000,         # Asigna un tamaño máximo al archivo
					['image/png', 'image/jpeg', 'image/gif', 'image/jpg']
				);

				if ($libro->portada)

					File::remove('../public/' . BOOK_IMAGE_FOLDER . '/' . $libro->portada);	# Elimina el fichero anterior, si existe.
				$libro->portada = $file->store('../public' . BOOK_IMAGE_FOLDER, 'book__');
			}



			$libro->update();
			Session::success("Actualización del libro $libro->titulo correcta.");
			redirect("/Libro/edit/$id");

			# Si se produce un error en la BDD
		} catch (SQLException $e) {

			Session::error("No se pudo actualizar el libro $libro->titulo.");

			# Si estamos en modo debug, si que iremos a la página de error
			if (DEBUG)
				throw new Exception($e->getMessage());

			# Si no , volveremos de nuevo a la operación de edición.

			redirect("/Libro/edit/$id");
		} catch (UploadException $e) {
			Session::warning("Cambios guardados, pero no se modificó la portada.");

			if (DEBUG)
				throw new Exception($e->getMessage());
			redirect("/Libro/edit/$id");
		}

	}


	#---------------------------------------------------------------------#
	#----------------------->BORRAR UN LIBRO<-----------------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	public function delete(int $id = 0)
	{
		$libro = Libro::findOrFail($id, "No existe el libro");

		view('libro/delete', [
			'libro' => $libro
		]);
	}

	public function destroy()
	{

		# Comprueba que llega el formulario

		if (!$this->request->has('borrar'))
			throw new FormException('No se recibio la confirmación');

		$id = intval($this->request->post('id'));		# Recupera el identificador
		$libro = Libro::findOrFail($id);				# Recupera el libro


		# Si el libro tiene ejemplares, no permitiremos su borrado
		if ($libro->hasAnyEjemplar('Ejemplar'))
			throw new Exception("No se puede borrar el libro mientras tenga ejemplares");

		# Intenta borrar el libro	
		try {
			$libro->deleteObject($libro->id);

			if ($libro->portada)
				File::remove('../public' . BOOK_IMAGE_FOLDER . '/' . $libro->portada, true);

			Session::success("Se ha borrado el $libro->titulo correctamente.");
			redirect("/Libro/list");

			# Si no lo borra produce un error en la operación con la BDD							
		} catch (SQLExcpetion $e) {
			Session::error("No se pudo borrar el libro $libro->titulo de la BDD");

			# Si estamos en DEBUG vamos a la vista "ERROR"
			if (DEBUG)
				throw new Exception($e->getMessage());

			# Si no retornamos al formulario de confirmación de borrado.					
			redirect("/Libro/delete/$id");
		} catch (FileException $e) {
			Session::warning("Se eliminó el libro pero no la imagen");

			if (DEBUG)
				throw new Exception($e->getMessage());
			redirect("/Libro/list");
		}
	}

	#---------------------------------------------------------------------#
	#--------------------->  AÑADIR TEMA A UN LIBRO  <--------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      

	public function addtema()
	{

		if (empty($this->request->post('add')))
			throw new FormException("No se recibió el formulario");

		# Recupera los identificadores necesarios (idlibro e idtema)
		$idlibro = intval($this->request->post('idlibro'));
		$idtema = intval($this->request->post('idtema'));

		# Recupera las entidades (libro y tema)

		$libro = Libro::findOrFail($idlibro, "No se encontro el libro");
		$tema = Tema::findOrFail($idtema, "No se encontro el tema");



		# Probamos a añadir el nuevo tema

		try {
			$libro->addTema($idtema);
			Session::success(
				"Se ha añadido el tema $tema->tema al libro $libro->titulo."
			);

			# Una vez cumplido el registro, nos redirecciona a la pagina de edición nuevamente
			redirect("/Libro/edit/$idlibro");
		} catch (SQLException $e) {


			# Si estamos en modo debug nos mandará a la vista del ERROR.
			# Si no, nos redirige a la vista de edición nuevamente.
			if (DEBUG)
				throw new Exception($e->getMessage());
			else
				redirect("/Libro/edit/$idlibro");
		}
	}



	#---------------------------------------------------------------------#
	#------------------------->  ELIMINAR UN TEMA  <----------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      


	public function removetema()
	{

		# Comprueba que llega el formulario 
		if (empty($this->request->post('remove')))
			throw new FormException("Nose recibió el formulario");

		# toma los ID necesarios (idlibro e idtema)

		$idlibro = intval($this->request->post('idlibro'));
		$idtema = intval($this->request->post('idtema'));

		# Recupera las entidades implicadas (libro y tema)
		$libro = Libro::findOrFail($idlibro, "No se encontro el libro.");
		$tema = Tema::findOrFail($idtema, "No se encontro el tema.");


		try {

			$libro->removeTema($idtema);

			Session::success("Se ha eliminado el tema $tema->tema del libro $libro->titulo correctamente");
			redirect("/Libro/edit/$idlibro");
		} catch (SQLExcpetion $e) {

			Session::error("No se pudo eliminar el tema $tema->tema del libro $libro->titulo ");

			if (DEBUG)
				throw new Exception($e->getMessage());
			else
				redirect("/Libro/edit/$idlibro");
		}
	}

	#---------------------------------------------------------------------#
	#------>       MÉTODO PARA ELIMINAR LA PORTADA DE UN LIBRO      <-----#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#


	public function dropcover()
	{
		if (!$this->request->has("borrar"))
			throw new FormException("Faltan datos para completar la operación");

		# Recupera el id y el libro
		$id = $this->request->post("id");
		$libro = Libro::findOrFail($id, "No se ha encontrado el libro");

		$tmp = $libro->portada;
		$libro->portada = NULL;

		try {

			# Primero guardamos en la base de datos y luego eliminamos el fichero
			$libro->update();
			File::remove("../public/" . BOOK_IMAGE_FOLDER . '/' . $tmp, true);

			Session::success("Borrado de la portada de $libro->titulo realizada");
			redirect("/Libro/edit/$id");
		} catch (SQLExcpetion $e) {

			Session::error("No se puedo eliminar la portada");

			if (DEBUG)
				throw new Exception($e->getMessage());

		} catch (FileException $e) {
			Session::warning("No se pudo eliminar el fichero del disco");

			if (DEBUG)
				throw new Exception($e->getMessage());

			redirect("/Libro/edit/$libro->id");

		}


	}

}
