<?php



class contactoController extends Controller {
	
	public function index(){
		
		# Carga la vista con el formulario de contacto
		$this->loadView('Contacto');
	}
	
	public function send() {
		
		if (empty($this->request->post('enviar')))
			throw new FormException('No se recibió el formulario de contacto.');
		
			# Toma los datos del formulario de contacto
			$from 		= $this->request->post('email');
			$name		= $this->request->post('nombre');
			$subject	= $this->request->post('asunto');
			$message	= $this->request->post('mensaje');
			
			try{
				
				# Preparamos y enviamos el mensaje al email de contacto que figura en config.php
				$email = new Email(ADMIN_EMAIL, $from, $name, $subject, $message);
				$email ->send();
				
				Session::success("Mensaje enviado, en breve recibirás una respuesta.");
				redirect('/');
			}catch (Emailxcpetion $e){
			
				Session::error("No se pudo enviar el email.");
				
				if(DEBUG)
					throw new Exception($e->getMessage());
				else 
					redirect("/Contacto");
			}
			
	}
}

