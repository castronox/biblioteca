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
            
            $libro = Libro::find($id); # Busca el libro con ese ID
            
            # Comprueba que existe ese libro            
            if (!$libro)
                throw new NotFoundException('No se encontró el libro indicado');
            
            # Carga la vista y le pasa el libro recuperado
            view('libro/show', [
                'libro' => $libro                
            ]);                
        }

        
           
    
    }

