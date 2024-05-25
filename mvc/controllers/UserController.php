<?php

# Controlador de operaciones para usuarios.


class UserController extends Controller
{

    #---------------------------------------------------------------------#
#----->      Muestra los detalles del usuario identificado    <-------#
#---------------------------------------------------------------------#
#                                                                      
#                                                                      
#                                                                      
#                                                                      
#                                                                      
#                                                                      
    public function home()
    {

        Auth::check();  # Autorización (Solo identificados)

        # Carga la bvista home y le pasa el usuario identificado
        $this->loadView('user/home', [
            'user' => Login::user()
        ]);
    }


    #---------------------------------------------------------------------#
#----->  Crea un usuario con roles desde el rol administrador   <-----#
#---------------------------------------------------------------------#
#                                                                      
#                                                                      
#                                                                      
#                                                                      
#                                                                      
#                                                                      


    public function create()
    {
        Auth::admin();  # Solo para administradores

        $this->loadView('user/create');
    }

    public function store()
    {

        Auth::admin(); # Operación sólo para administradores.

        if (empty($_POST['guardar']))
            throw new Exception('No se recibió el formulario');

        $user = new User(); # Crea el nuevo usuario.

        # Comprobación de que los passwords coinciden
        $user->password = md5($_POST['password']);
        $repeat = md5($_POST['repeatpassword']);

        if ($user->password != $repeat)
            throw new Exception('Las claves no coinciden.');

        $user->displayname = $_POST['displayname'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $user->addRole('ROLE_USER', $_POST['roles']);

        try {
            dd($user);
            $user->save();

            if (Upload::arrive('picture')) {
                $user->picture = Upload::save(
                    'picture',
                    '../public/' . USER_IMAGE_FOLDER,
                    true,
                    8000000,
                    'image/*',
                    'user_'
                );
            }

            Session::success("Nuevo usuario $user->displayname creado con éxito.");
            redirect("/");
        } catch (SQLException $e) {
            Session::error("Se produjo un error al guardar el usuario $user->displayname.");

            if (DEBUG)
                throw new Exception($e->getMessage());
            else
                redirect("/User/create");

            # Si se produce un error en la subida del fichero (Sería despues de guardar)
        } catch (UploadException $e) {
            Session::warning("El usuario se guardó correctamente pero no se subió el archivo de imagen.");
            if (DEBUG)
                throw new Exception($e->getMessage());
            else
                redirect("/");
        }

    }


    #---------------------------------------------------------------------#
    #----------------->      Lista los usuarios    <----------------------#
    #---------------------------------------------------------------------#
    #                                                                      
    #                                                                      
    #                                                                      
    #   Muestra la lista de usuarios y sus respectivos roles                                                                   
    #                                                                      
    #    


    public function list(int $page = 1)
    {
        Auth::admin();


        $filtro = Filter::apply("users");
        $limit = RESULTS_PER_PAGE;

        if ($filtro) {
            $total = User::filteredResults($filtro);

            # Crea el objeto paginador
            $paginator = new Paginator('/User/list', $page, $limit, $total);

            # Recupera la lista de libros con el filtro aplicado
            $users = User::filter($filtro, $limit, $paginator->getOffset());
        } else {

            # Recupra el total de usuarios
            $total = User::total();

            # Crea el objeto paginador para introducir el listado de socios
            $paginator = new Paginator('/User/list', $page, $limit, $total);

            # Recupera todos los socios
            $users = User::orderBy('id', 'DESC', $limit, $paginator->getOffset());

            #dd($users);
        }

        # Carga la vista para mostrar

        $this->loadView('user/list', [

            'users' => $users,
            'paginator' => $paginator,
            'filtro' => $filtro
        ]);

    }



    #---------------------------------------------------------------------#
    #--------------------->     MOSTRAR USUARIO     <---------------------#
    #---------------------------------------------------------------------#
    #                                                                      
    #                                                                      
    #                                                                      
    #                                                                      
    #                                                                      
    #                                                                      
    public function show(int $id = 0)
    {

        Auth::admin();

        $user = User::findOrFail($id, 'No se encontró el usuario seleccionado');

        view('user/show', ['user' => $user]);
    }


    #---------------------------------------------------------------------#
    #--------------------->      ACTUALIZA USUARIO  <---------------------#
    #---------------------------------------------------------------------#
    #                                                                      
    #                                                                      
    #                                                                      
    #                                                                      
    #                                                                      
    #                                                                      



    public function edit(int $id = 0)
    {
        Auth::admin();

        $user = User::findOrFail($id, 'No se encontró el usuario');

        view('user/edit', ['user' => $user]);
    }

    public function update()
    {
        Auth::admin();
    
        if (!$this->request->has('actualizar')) {
            throw new FormException('No se recibieron los datos');
        }
    
        $id = intval($this->request->post('id'));  // Recuperamos el id via post
    
        $user = User::findOrFail($id, 'No se ha encontrado el usuario.');
    
        // Recuperamos los campos
        $user->displayname = $this->request->post('displayname');
        $user->email = $this->request->post('email');
        $user->phone = $this->request->post('phone');
        
        if ($this->request->post('password')) {
            $user->password = password_hash($this->request->post('password'), PASSWORD_BCRYPT);
        }

        try {
            if (UploadedFile::check('picture')) {
                $file = new UploadedFile(
                    'picture',
                    8000000,
                    ['image/png', 'image/jpeg', 'image/gif']
                );
    
                if ($user->picture) 
                    File::remove('../public/' . USER_IMAGE_FOLDER . '/' . $user->picture); // Elimina el fichero anterior si existe
                    $user->picture = $file->store('../public/' . USER_IMAGE_FOLDER, 'user__');
                
            
            }
        
            $user->update();
            
            Session::success("Actualización de $user->displayname correcta.");
            redirect("/User/edit/$id");
    
        } catch (UploadException $e) {
            Session::warning("Cambios guardados pero no se modificó la portada");
    
            if (DEBUG) {
                throw new Exception($e->getMessage());
            }
            redirect("User/edit/$id");
        }catch (UploadException $e) {

			Session::warning("Cambios guardados pero no se modificó la foto");

			if (DEBUG)
				throw new Exception($e->getMessage());
			redirect("/User/edit/$id ");

		}
    }
    


    


    #---------------------------------------------------------------------#
    #----------------->    BORRAR FOTO DE USUARIO    <-----------------#
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
        $user = User::findOrFail($id, "No se ha encontrado el socio");
    
        $tmp = $user->picture;
        $user->picture = NULL;
    
        try {
         
            $user->update();
                File::remove("../public/" . USER_IMAGE_FOLDER. "/" . $tmp, true);
    
                Session::success("Borrado de la foto de perfil de $user->displayname realizada");
                redirect("/User/edit/$id");
    
            } catch (SQLException $e) {
                Session::error("No se pudo eliminar la foto de perfil del socio");
    
                if (DEBUG)
                throw new Exception($e->getMessage);
            
            }catch (FileException $e) {
                Session::warning("No se pudo eliminar el fichero del disco");
    
                if (DEBUG)
                throw new Exception($e->getMessage);
            redirect("/User/edit/$user->id");
        }
    }
}