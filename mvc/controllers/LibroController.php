<?php

# Controlador para las operaciones con libros
# cada método implementará una operación o un paso de la misma

    class LibroController extends Controller{
        
#---------------------------v- Operación por defecto -v----------------------------------------
        
        
        public function index(){
            $this->list();          # Redirige al método list()
        }
        
        
        
#---------------------------v- Operación para listar los libros -v-----------------------------
        
        
        public function list(){
            
            $libros = Libro::all();     # Recupera todos los libros       
            
            # Carga la vista que los muestra
            view('libro/list', [
                'libros' => $libros                
            ]);
        }
    
       
#--------------------------v- Método que muestra los detalles de un libro -v------------------

        
        public function show(int $id=0){
            
            # Comprueba que llega el ID
            if(!$id)
                throw new NothigToFindException('No se indicó el libro a buscar.');
            
            $libro = Libro::findOrFail($id, "No se encontró el libro seleccionado");
            
            # Carga la vista y le pasa el libro recuperado
            view('libro/show', [
                'libro' => $libro                
            ]);                
        }
        

#-------------------------v- Método que muestra el formulario del nuevo libro -v--------------

        
        public function create(){
            view('libro/create');
        }
        
        
           
#------------------------v- GUARDAR UN LIBRO (Método) -v-------------------------------------- 
 
        
        public function store(){
            
         # Comprobamos que la peticion venga del formulario --------------------
            
            if(!$this->request->has('guardar'))
                throw new FormException('No se recibió el formulario');
            
         #-----------------------------------------------------------------------
            $libro = new Libro(); # Creamos un objeto LIBRO en el que 
                                  # introduciremos los datos del formulario
            
            $libro->isbn                = $this->request->post('isbn');
            $libro->titulo              = $this->request->post('titulo');
            $libro->editorial           = $this->request->post('editorial');
            $libro->autor               = $this->request->post('autor');
            $libro->idioma              = $this->request->post('idioma');
            $libro->edicion             = $this->request->post('edicion');
            $libro->edadrecomendada     = $this->request->post('edadrecomendada');
            
         #------------------------------------------------------------------------
         
            # Con TRY/CATCH local evitaremos ir directamente a la página de error
            
            try{
                #----------------------------------------------------
                
                $libro->save();             #------Guardamos el libro
                
                #----------------------------------------------------
                
                
                # Flashea un mensaje que VERIFICA LA CORRECTA subida del libro por sesión (para que no se borre al redireccionar)
                
                Session::success("Guardado del libro $libro->titulo correcto.");
                
                # Una vez cumplida la condición, redirecciona a los detalles del libro que hemos creado
                redirect("/Libro/show/$libro->id");
                
                
               
            }catch(SQLException $e){ # Si la condición de save(); no se cumple, Indicamos un error
                
                # Flashea el mensaje de error por sesión
                Session::error("No se pudo guardar el libro $libro->titulo.");
                
                
                #--------------------------------------------------------------
                
                # Si estamos en modo DEBUG, iremos a la página de ERROR.
                if(DEBUG)
                    throw new Exception($e->getMessage());
                
                # Si no, volveremos al formulario de creación del libro.
                
                    redirect("/Libro/create");    
                
            }
        }
    }

