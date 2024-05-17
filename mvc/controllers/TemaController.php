<?php



class TemaController extends Controller
{


	#---------------------------------------------------------------------#
	#----------------------->Operación por defecto<-----------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#  


	public function index()
	{
		$this->list(); 		# Redirige al método list
	}








	#-------------------------------------------------------------------------#
	#-------------->  Operación para listar/ mostrar   TEMAS  <---------------#
	#-------------------------------------------------------------------------#	
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#  
	public function list(int $page = 1)
	{

		$filtro = Filter::apply('temas');

		$limit = RESULTS_PER_PAGE;

		# Si hay filtro
		if ($filtro) {

			$total = Tema::filteredResults($filtro);

			# Crea el objeto PAGINADOR
			$paginator = new Paginator('/Tema/list', $page, $limit, $total);

			# Recupera la lista de temas con el filtro aplicado
			$temas = Tema::filter($filtro, $limit, $paginator->getOffset());

		} else {

			# Recupera el total de libros.
			$total = Tema::total();

			# Crea el objeto PAGINADOR.
			$paginator = new Paginator('/Tema/list', $page, $limit, $total);

			# Recupera todos los libros
			$temas = Tema::orderBy('descripcion', 'ASC', $limit, $paginator->getOffset());
		}


		# Carga la VISTA que los muestra 
		$this->loadView('tema/list', [

			'temas' => $temas,
			'paginator' => $paginator,
			'filtro' => $filtro
		]);

	}






	#---------------------------------------------------------------------#
	#---------------->   MÉTODO PARA CREAR NUEVO TEMA   <-----------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	# 


	public function create()
	{
		view('tema/create');	# Apuntamos a la vista del método			
	}

	public function store()
	{

		if (!$this->request->has('guardar'))
			throw new FormException('No se recibió el formulario');

		# Recogemos datos del formulario

		$tema = new Tema();		# Generamos el objeto tema.

		$tema->tema = $this->request->post('tema');
		$tema->descripcion = $this->request->post('descripcion');


		# Probamos a introducir al nuevo socio a la base de datos
		try {

			$tema->save();

			Session::success("Guarado del tema $this->tema $this->descripcion correcto.");

			# Si se cumple la condición redirecciona a los detalles del nuevo tema.
			redirect("/tema/show/$tema->id");

		} catch (Exception $e) {
			Session::error(" No se han enviado los datos del tema $this->tema");

			#Si estamos en modo debug nos redirecciona a la vista del <error>
			if (DEBUG) {
				throw new Exception($e->getMessage());

				# Si no lo estamos no enviara nuevamente al formulario de creación de tema

				redirect("/Tema/create");
			}
		}
	}





	#---------------------------------------------------------------------#
	#-------------->      MOSTRAR DETELLES DE UN TEMA      <--------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      

	public function show($id = 0)
	{

		if (!$id)
			throw new NothingToFindException('No se indicó el tema a buscar');
		$tema = Tema::findOrFail($id, "No se encontró el tema seleccionado");

		view('tema/show', [
			'tema' => $tema
		]);

	}


	#---------------------------------------------------------------------#
	#----------------------->   ACTUALIZAR TEMA   <-----------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      


	# Muestra la vista del método de edición.
	public function edit(int $id = 0)
	{

		$temas = Tema::findOrFail($id, 'No se encontró el TEMA');



		view('tema/edit', [
			'tema' => $temas
		]);

	}


	# Método que actualiza el tema.

	public function update()
	{

		if (!$this->request->has('actualizar'))
			throw new FormException('No se recibieron datos');

		$id = intval($this->request->post('id'));		# Recupera el id via POST

		$tema = Tema::findOrFail($id, 'No se ha encontrado el tema deseado.');

		# Recuperamos los campos del formulario.

		$tema->tema = $this->request->post('tema');
		$tema->tema = $this->request->post('descripcion');

		try {

			$tema->update();
			Session::success("Actualización del tema $tema->tema correcto.");

			redirect("/Tema/edit/$id");
		} catch (Exception $e) {

			Session::error("No se ha podido actualizar el tema $tema->tema");

			# Si produce error
			if (DEBUG)
				throw new Exception($e->getMessage());

			# En caso contrario redirige a la operación de edición
			redirect("/Tema/edit/$id");
		}
	}


	#---------------------------------------------------------------------#
	#----------------------->     BORRAR TEMA     <-----------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      

	# Recupera el id del tema para trabajar con el.
	public function delete(int $id = 0)
	{

		$tema = Tema::findOrFail($id, "No existe el tema");

		view('Tema/delete', [

			'tema' => $tema
		]);

	}

	# Intentamos destruir el libro


	public function destroy()
	{
		# Comprueba que llega el formulario
		if (!$this->request->has('borrar'))
			throw new FormException('No se recibió el formulario');

		# Toma el ID necesario.
		$id = intval($this->request->post('id'));

		$tema = Tema::findOrFail($id);

		# Intenta borrar el tema

		try {
			$tema->delete($tema->id);

			Session::success("Se ha eliminado el $tema->tema correctamente.");
			redirect("/Tema/list/");
		} catch (SQLException $e) {

			Session::error("No se pudo eliminar el tema $tema->tema");

			if (DEBUG)
				throw new Exception($e->getMessage());
			else {
				redirect("/Tema/list/");
			}




		}

	}

}
