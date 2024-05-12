<?php

class SocioController extends Controller {
	
	
	# ---------------------------v- Operación por defecto -v----------------------------------------
	public function index() {
		$this->list (); # Redirige al método list()
	}
	
	
	# ---------------------------v- Operación para listar los libros -v-----------------------------
	public function list() {
		$socios = Socio::all (); # Recupera todos los libros
		
		# Carga la vista que los muestra
		view ( 'Socio/list', [
				'socios' => $socios
		] );
	}
}

