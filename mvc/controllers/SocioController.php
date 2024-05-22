<?php

class SocioController extends Controller
{


	#---------------------------------------------------------------------#
	#--------------> MÉTODO DE REDIRECCIÓN A LISTAR DATOS <---------------#
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
	#--------------------->      LISTAR SOCIOS    <-----------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	public function list(int $page = 1)
	{

		$filtro = Filter::apply('socios');
		$limit = RESULTS_PER_PAGE;

		# Si hay filtro
		if ($filtro) {

			$total = Socio::filteredResults($filtro);

			# Crea el objeto paginador
			$paginator = new Paginator('/Socio/list', $page, $limit, $total);

			# Recupera la lista de libros con el filtro aplicado
			$socios = Socio::filter($filtro, $limit, $paginator->getOffset());

		} else {

			# Recupera el total de Socios
			$total = Socio::total();

			# Crea el objeto paginador para introducir el listado de socios
			$paginator = new Paginator('/Socio/list', $page, $limit, $total);

			# Recupera todos los Socios
			$socios = Socio::orderBy('id', 'DESC', $limit, $paginator->getOffset());
		}


		# Carga la vista para mostrar
		$this->loadView('socio/list', [
			'socios' => $socios,
			'paginator' => $paginator,
			'filtro' => $filtro
		]);
	}



	#---------------------------------------------------------------------#
	#--------------->     MOSTRAR DETALLES DE UN SOCIO   <----------------#
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
			throw new NothigToFindException('No se indicó el socio a buscar.');

		$socio = Socio::findOrFail($id, "No se encontró el socio seleccionado");
		$prestamos = $socio->hasMany('Prestamo');

		# Carga la vista y le pasa el socio recuperado
		view('socio/show', [
			'socio' => $socio,
			'prestamos' => $prestamos
		]);


	}


	#---------------------------------------------------------------------#
	#-------------------->      CREAR UN SOCIO     <----------------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      

	# Creamos el método de redirección al formulario.

	public function create()
	{

		view('socio/create');
	}

	# Creamos el método para guardar el nuevo socio.
	public function store()
	{


		if (!$this->request->has('guardar'))
			throw new FormException('No se recibió el formulario');

		#------- Recogemos los datos del formulario

		$socio = new Socio(); # Creamos el objeto donde almacenaremos los datos del form.

		$socio->dni = $this->request->post('dni');
		$socio->nombre = $this->request->post('nombre');
		$socio->apellidos = $this->request->post('apellidos');
		$socio->nacimiento = $this->request->post('nacimiento');
		$socio->email = $this->request->post('email');
		$socio->direccion = $this->request->post('direccion');
		$socio->cp = $this->request->post('cp');
		$socio->poblacion = $this->request->post('poblacion');
		$socio->provincia = $this->request->post('provincia');
		$socio->telefono = $this->request->post('telefono');

		
		

		#Probamos a introducir al nuevo socio a la base de datos
		try {
			$socio->save();
			#------ Si llega la portada------------------

			if (UploadedFile::check('foto')) {
				# Genera el guardado de la imagen
				$file = new UploadedFile(
					'foto', 	#Nombre de la imagen de perfil de usuario.
					8000000,			# Tamaño máximo de la imagen de perfil.
					['image/png', 'image/jpeg', 'image/gif', 'image/jpg']

				);

				# Guarda el fichero
				$socio->foto = $file->store('../public/' . MEMBER_IMAGE_FOLDER, 'member__');
			}

			$socio->update();
			
			#---------------------------------------------
			Session::success("Guardado del socio $socio->nombre $socio->apellidos correcto.");

			# Si se cumple la condición redirecciona a los detalles del nuevo socio.
			redirect("/Socio/show/$socio->id");

		} catch (SQLException $e) {	# Si la condición no se cumple mandamos error

			Session::error(" No se han enviado los datos del socio $socio->nombre $socio->apellidos .");

			# Estando en modo debug. Nos envia a la vista del error

			if (DEBUG)
				throw new Exception($e->getMessage());

			# Si no estamos en modo DEBUG nos redirecciona nuevamente a la creación del socio.

			redirect('/socio/create');


		} catch (UploadException $e) {

			Session::warning("El socio se guardo correctamente, pero no se subió la imagen de perfil.");

			if (DEBUG)
				throw new Exception($e->getMessage());
			redirect("/Socio/edit/$socio->id");
		}
	}

	#---------------------------------------------------------------------#
	#----------------->     ACTUALIZAR UN SOCIO         <-----------------#
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

		$socio = Socio::findOrFail($id, "No se encontró el socio");
		$prestamos = $socio->hasMany('Prestamo');
		#Carga la vista con el formulario de edición de socio

		view('socio/edit', [
			'socio' => $socio,
			'prestamos' => $prestamos
		]);
	}


	# Función para actualizar el socio
	public function update()
	{
		if (!$this->request->has('actualizar'))
			throw new FormException('No se recibieron datos');

		$id = intval($this->request->post('id')); # Recuperamos el ID del socio via POST

		$socio = Socio::findOrFail($id, "No se ha encontrado el socio seleccionado");

		# Recuperamos el resto de campos
		$socio->dni = $this->request->post('dni');
		$socio->nombre = $this->request->post('nombre');
		$socio->apellidos = $this->request->post('apellidos');
		$socio->nacimiento = $this->request->post('nacimiento');
		$socio->email = $this->request->post('email');
		$socio->direccion = $this->request->post('direccion');
		$socio->cp = $this->request->post('cp');
		$socio->poblacion = $this->request->post('poblacion');
		$socio->provincia = $this->request->post('provincia');
		$socio->telefono = $this->request->post('telefono');
		$socio->alta = $this->request->post('alta');

		# Intenta actualizar el SOCIO

		try {

			# Actualiza la fotografía de perfil del socio 
			if (UploadedFile::check('foto')) {
				$file = new UploadedFile(
					'foto',
					8000000,
					['image/png', 'image/jpeg', 'image/gif', 'image/jpg']
				);

				if ($socio->perfil)
					File::remove('../public/' . MEMBER_IMAGE_FOLDER . '/' . $socio->foto); # Elimina el fichero anterio si existe
				$socio->foto = $file->store('../public' . MEMBER_IMAGE_FOLDER, 'member__');
			}



			$socio->update();
			Session::success("Actualización del socio $socio->nombre $socio->apellidos Correcto");
			redirect("/Socio/edit/$id");


			#Si se produce un error en la base de datos
		} catch (SQLException $e) {
			Session::error("No se pudo actualizar el socio $socio->nombre $socio->apellidos");


			# Si estamos en modo DEBUG, nos redirigirá a la página de error
			if (DEBUG)
				throw new Exception($e->getMessage());

			#Si no, volveremos de nuevo a la operacion de editar socio

			redirect("/Socio/edit/$id");

		} catch (UploadException $e) {

			Session::warning("Cambios guardados pero no se modificó la portada");

			if (DEBUG)
				throw new Exception($e->getMessage());
			redirect("/Socio/edit/$id ");

		}
	}



	#---------------------------------------------------------------------#
	#----------------->     	BORRAR UN SOCIO		    <-----------------#
	#---------------------------------------------------------------------#
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      
	#                                                                      



	# Busca el socio y muestra la vista
	public function delete(int $id = 0)
	{
		$socio = Socio::findOrFail($id, "No existe el Socio");

		view('socio/delete', [
			'socio' => $socio
		]);
	}

	# Elimina el Socio desde la vista de confimación 
	public function destroy()
	{
		if (!$this->request->has('borrar'))
			throw new FormExeption('No se recibio confirmación de borrado.');

		$id = intval($this->request->post('id')); 		# Recupera el identificador.
		$socio = Socio::findOrFail($id);					# Recupera el socio

		# Si el socio tiene prestamos, no permitimos el borrado
		if ($socio->hasAny('Prestamo'))
			throw new Exception("No se puede eliminar el socio ya que posee ejemplares");

		# Intenta borrar el libro
		try {

			$socio->delete($socio->id);

			if ($socio->foto)
		        File::remove('../public/' . MEMBER_IMAGE_FOLDER . '/' . $socio->foto , true);
			Session::success("Se ha borrado el socio $socio->nombre $socio->apellidos correctamente.");
			redirect("/Socio/list");

			# Si no lo Borrra produce un error y lo registra en ERRORES 
		} catch (SQLException $e) {
			Session::error("No se ha ejecutado el borrado de $socio->nombre");

			# Si estamos en modo DEBUG, nos llevará a la vista del error
			if (DEBUG)
				throw new Exception($e->getMessage);

			# Redireccionamos al confirmado de borrado en caso contrario
			redirect("/Socio/delete/$id");
		}
	}

#---------------------------------------------------------------------#
#----------------->     BORRAR FOTO DE PERFIL       <-----------------#
#---------------------------------------------------------------------#
#                                                                      
#                                                                      
#                                                                      
#                                                                      
#                                                                      
#        

public function dropPhoto(){
	if (!$this->request->has("borrar"))
	throw new FormExeption("Faltan datos para completar la operación");

	# Recupera el ID y el socio
	$id = intval($this->request->post("id"));
	$socio = Socio::findOrFail($id, "No se ha encontrado el socio");

	$tmp = $socio->foto;
	$socio->foto = NULL;

	try {
		$socio->update();
			File::remove("../public/" . MEMBER_IMAGE_FOLDER. "/" . $tmp, true);

			Session::success("Borrado de la foto de perfil de $socio->nombre realizada");
			redirect("/Socio/edit/$id");

		} catch (SQLException $e) {
			Session::error("No se pudo eliminar la foto de perfil del socio");

			if (DEBUG)
			throw new Exception($e->getMessage);
		
		}catch (FileException $e) {
			Session::warning("No se pudo eliminar el fichero del disco");

			if (DEBUG)
			throw new Exception($e->getMessage);
		redirect("/Socio/edit/$socio->id");
	}
}

}

