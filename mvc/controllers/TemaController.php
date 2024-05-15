<?php



class TemaController extends Controller {
	
	
#---------------------------------------------------------------------#
#				>	Operación por defecto	<						  #
#---------------------------------------------------------------------#	
	
	public function index(){		
		$this->list (); 			# Redirige al método list
	}

	
#---------------------------------------------------------------------#
#				>	Operación para lista TEMAS	 <					  #
#---------------------------------------------------------------------#	

	public function list( int $page = 1){
		
		$filtro = Filter::apply('temas');
		
		$limit = RESULTS_PER_PAGE;
		
			# Si hay filtro
			if ($filtro){
			
			$total = Tema::filteredResults($filtro);
			
			# Crea el objeto PAGINADOR
			$paginator = new Paginator ('/Tema/list', $page, $limit, $total);
			
			# Recupera la lista de temas con el filtro aplicado
			$temas = Tema::filter($filtro, $limit, $paginator->getOffset());			
			
			}else{
				
			# Recupera el total de libros.
			$total = Tema::total();
			
			# Crea el objeto PAGINADOR.
			$paginator = new Paginator('/Tema/list', $page, $limit, $total);
			
			# Recupera todos los libros
			$temas = Tema::orderBy('descripcion', 'ASC', $limit, $paginator->getOffset());
			}
			
		
		# Carga la VISTA que los muestra 
		$this->loadView('tema/list',[
				
				'temas' 	=> $temas,
				'paginator' => $paginator,
				'filtro'	=> $filtro
		]);
		
	}
	
}

